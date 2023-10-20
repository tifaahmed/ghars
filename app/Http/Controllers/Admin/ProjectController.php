<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Country;
use App\Models\Project;
use App\Models\ProjectReport;
use App\Http\Requests\StoreProject;
use App\Http\Requests\UpdateProject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProjectController extends Controller {

    function __construct(User $User, Category $Category, Country $Country, Project $Project, ProjectReport $ProjectReport) {
        $this->user = $User;
        $this->category = $Category;
        $this->country = $Country;
        $this->project = $Project;
        $this->project_report = $ProjectReport;
        $this->middleware('role:projects_all', ['only' => ['index']]);
        $this->middleware('role:projects_add', ['only' => ['create', 'store']]);
        $this->middleware('role:projects_edit', ['only' => ['edit', 'update']]);
        $this->middleware('role:projects_show', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بفتح صفحة المشاريع';
        $action->en_action = 'Open projects page';
        $action->ip = request()->ip();
        $action->save();

        $projects = $this->project->getAll();
        return view('admin.projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $categories = $this->category->getList();
        $categories = Arr::add($categories, '', trans('admin.choose_category'));
        $categories = array_reverse($categories, TRUE);

        $countries = $this->country->getList();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);

        $companies = $this->user->getList('company');
        $companies = Arr::add($companies, '', trans('admin.choose_company'));
        $companies = array_reverse($companies, TRUE);

        $users = $this->user->getList('user');
        $users = Arr::add($users, '', trans('admin.choose_user'));
        $users = array_reverse($users, TRUE);

        return view('admin.projects.create', ['categories' => $categories, 'countries' => $countries, 'companies' => $companies, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProject $request) {
        // die;
        $destinationPath = public_path('upload/projects/');
        $file = $request['image'];
        $filename = Str::random(5) . '.' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $id = $this->project->add($request, $filename);

        if (isset($request['files'])) {
            $destinationPath = public_path('upload/projects/');
            $i = 0;
            $files = $request['files'];
            $ar_names = $request['ar_names'];
            $en_names = $request['en_names'];
            foreach ($files as $file) {
                if ($file != "") {
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->project_report->add($id, $ar_names[$i], $en_names[$i], 'yes', $filename);
                }
                $i++;
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة مشروع جديد ' . $request['ar_name'];
        $action->en_action = 'Add new project ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.add_suc');
        return back()->with(['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $project = $this->project->getById($id);

        $categories = $this->category->getList();
        $categories = Arr::add($categories, '', trans('admin.choose_category'));
        $categories = array_reverse($categories, TRUE);

        $countries = $this->country->getList();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);

        $companies = $this->user->getList('company');
        $companies = Arr::add($companies, '', trans('admin.choose_company'));
        $companies = array_reverse($companies, TRUE);

        $users = $this->user->getList('user');
        $users = Arr::add($users, '', trans('admin.choose_user'));
        $users = array_reverse($users, TRUE);

        return view('admin.projects.edit', ['project' => $project, 'categories' => $categories, 'countries' => $countries, 'companies' => $companies, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProject $request, $id) {
        //
        $filename = FALSE;
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/projects/');
            $file->move($destinationPath, $filename);
        }

        $this->project->edit($id, $request, $filename);

        if (isset($request['files'])) {
            $destinationPath = public_path('upload/projects/');
            $i = 0;
            $files = $request['files'];
            $ar_names = $request['ar_names'];
            $en_names = $request['en_names'];
            foreach ($files as $file) {
                if ($file != "") {
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->project_report->add($id, $ar_names[$i], $en_names[$i], 'yes', $filename);
                }
                $i++;
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل مشروع حالي ' . $request['ar_name'];
        $action->en_action = 'Edit current project ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/projects')->with(['message' => $message]);
    }

    public function show($id) {
        $project = $this->project->getById($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بعرض تبرعات المشروع  ' . $project['ar_name'];
        $action->en_action = 'show donation of project of ' . $project['en_name'];
        $action->ip = request()->ip();
        $action->save();

        return view('admin.projects.show', ['project' => $project]);
    }
    
    public function projects_reports($id) {
        $active = request()->get('active');
        $report = $this->project_report->getById($id);

        $this->project_report->edit($id, $active);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل الموافقة علي تقرير مشروع  ' . $report['ar_name'];
        $action->en_action = 'Edit active of project report of ' . $report['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return back()->with(['message' => $message]);
    }

}

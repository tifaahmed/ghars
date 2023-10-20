<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Teacher;
use App\Models\TeacherReport;
use App\Http\Requests\StoreTeacher;
use App\Http\Requests\UpdateTeacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TeacherController extends Controller {

    function __construct(Country $Country, Teacher $Teacher, TeacherReport $TeacherReport) {
        $this->country = $Country;
        $this->teacher = $Teacher;
        $this->teacher_report = $TeacherReport;
        $this->middleware('role:teachers_all', ['only' => ['index']]);
        $this->middleware('role:teachers_add', ['only' => ['create', 'store']]);
        $this->middleware('role:teachers_edit', ['only' => ['edit', 'update','teachers_reports']]);
        $this->middleware('role:teachers_show', ['only' => ['show']]);
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
        $action->ar_action = 'قام بفتح صفحة كفالات الدعاة';
        $action->en_action = 'Open teachers sponsorships page';
        $action->ip = request()->ip();
        $action->save();

        $teachers = $this->teacher->getAll();
        return view('admin.teachers.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $countries = $this->country->getList();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);

        return view('admin.teachers.create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacher $request) {
        // die;
        $destinationPath = public_path('upload/teachers/');
        $file = $request['image'];
        $filename = Str::random(5) . '.' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $id = $this->teacher->add($request, $filename);

        if (isset($request['files'])) {
            $destinationPath = public_path('upload/teachers/');
            $i = 0;
            $files = $request['files'];
            $ar_names = $request['ar_names'];
            $en_names = $request['en_names'];
            foreach ($files as $file) {
                if ($file != "") {
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->teacher_report->add($id, $ar_names[$i], $en_names[$i], 'yes', $filename);
                }
                $i++;
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة كفالة داعية جديدة ' . $request['ar_name'];
        $action->en_action = 'Add new teacher sponsorship ' . $request['en_name'];
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
        $teacher = $this->teacher->getById($id);

        $countries = $this->country->getList();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);

        return view('admin.teachers.edit', ['teacher' => $teacher, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacher $request, $id) {
        //
        $filename = FALSE;
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/teachers/');
            $file->move($destinationPath, $filename);
        }

        $this->teacher->edit($id, $request, $filename);

        if (isset($request['files'])) {
            $destinationPath = public_path('upload/teachers/');
            $i = 0;
            $files = $request['files'];
            $ar_names = $request['ar_names'];
            $en_names = $request['en_names'];
            foreach ($files as $file) {
                if ($file != "") {
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->teacher_report->add($id, $ar_names[$i], $en_names[$i], 'yes', $filename);
                }
                $i++;
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل كفالة داعية حالية ' . $request['ar_name'];
        $action->en_action = 'Edit current teacher sponsorship ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/teachers')->with(['message' => $message]);
    }

    public function show($id) {
        $teacher = $this->teacher->getById($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بعرض تبرعات كفالة داعية  ' . $teacher['ar_name'];
        $action->en_action = 'show donation of teacher sponsorship of ' . $teacher['en_name'];
        $action->ip = request()->ip();
        $action->save();

        return view('admin.teachers.show', ['teacher' => $teacher]);
    }

    public function teachers_reports($id) {
        $report = $this->teacher_report->getById($id);
        $this->teacher_report->remove($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بحذف تقرير كفالة داعية  ' . $report['ar_name'];
        $action->en_action = 'Delete teacher sponsorship report of ' . $report['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

}

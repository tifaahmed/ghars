<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Country;
use App\Models\UserCategory;
use App\Models\UserFile;
use App\Http\Requests\StoreCompany;
use App\Http\Requests\UpdateCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CompanyController extends Controller {

    function __construct(User $User, Category $Category, Country $Country, UserCategory $UserCategory, UserFile $UserFile) {
        $this->user = $User;
        $this->category = $Category;
        $this->country = $Country;
        $this->user_category = $UserCategory;
        $this->user_file = $UserFile;
        $this->middleware('role:companies_all', ['only' => ['index']]);
        $this->middleware('role:companies_add', ['only' => ['create', 'store']]);
        $this->middleware('role:companies_edit', ['only' => ['edit', 'update']]);
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
        $action->ar_action = 'قام بفتح صفحة الشركات المنفذة';
        $action->en_action = 'Open companies page';
        $action->ip = request()->ip();
        $action->save();

        $companies = $this->user->getAll('company');
        return view('admin.companies.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $categories = $this->category->getList();

        $countries = $this->country->getList();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);

        return view('admin.companies.create', ['categories' => $categories, 'countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request) {
        // die;
        $request['type'] = 'company';
        $id = $this->user->add($request);

        if (isset($request['categories'])) {
            foreach ($request['categories'] as $category) {
                if ($category != "") {
                    $this->user_category->add($id, $category);
                }
            }
        }

        if (isset($request['files'])) {
            $destinationPath = public_path('upload/companies/');
            $i = 0;
            $files = $request['files'];
            $ar_names = $request['ar_names'];
            $en_names = $request['en_names'];
            foreach ($files as $file) {
                if ($file != "") {
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->user_file->add($id, $ar_names[$i], $en_names[$i], 'yes', $filename);
                }
                $i++;
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة شركة جديدة ' . $request['ar_name'];
        $action->en_action = 'Add new company ' . $request['en_name'];
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
        $company = $this->user->getById($id);

        $countries = $this->country->getList();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);

        $categories = $this->category->getList();

        return view('admin.companies.edit', ['company' => $company, 'categories' => $categories, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompany $request, $id) {
        //
        $this->user->edit($id, $request);

        $this->user_category->removeByUser($id);
        if (isset($request['categories'])) {
            foreach ($request['categories'] as $category) {
                if ($category != "") {
                    $this->user_category->add($id, $category);
                }
            }
        }

        if (isset($request['files'])) {
            $destinationPath = public_path('upload/companies/');
            $i = 0;
            $files = $request['files'];
            $ar_names = $request['ar_names'];
            $en_names = $request['en_names'];
            foreach ($files as $file) {
                if ($file != "") {
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->user_file->add($id, $ar_names[$i], $en_names[$i], 'yes', $filename);
                }
                $i++;
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل شركة تاحية ' . $request['ar_name'];
        $action->en_action = 'Edit current company ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/companies')->with(['message' => $message]);
    }

    public function show($id) {
        $active = request()->get('active');
        $file = $this->user_file->getById($id);

        $this->user_file->edit($id, $active);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل الموافقة علي الملف  ' . $file['ar_name'];
        $action->en_action = 'Edit active of file of ' . $file['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return back()->with(['message' => $message]);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Child;
use App\Models\ChildReport;
use App\Http\Requests\StoreChild;
use App\Http\Requests\UpdateChild;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ChildController extends Controller {

    function __construct(Country $Country, Child $Child, ChildReport $ChildReport) {
        $this->country = $Country;
        $this->child = $Child;
        $this->child_report = $ChildReport;
        $this->middleware('role:childern_all', ['only' => ['index']]);
        $this->middleware('role:childern_add', ['only' => ['create', 'store']]);
        $this->middleware('role:childern_edit', ['only' => ['edit', 'update','childern_reports']]);
        $this->middleware('role:childern_show', ['only' => ['show']]);
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
        $action->ar_action = 'قام بفتح صفحة كفالات الأيتام';
        $action->en_action = 'Open childern sponsorships page';
        $action->ip = request()->ip();
        $action->save();

        $childern = $this->child->getAll();
        return view('admin.childern.index', ['childern' => $childern]);
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

        return view('admin.childern.create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChild $request) {
        // die;
        $destinationPath = public_path('upload/childern/');
        $file = $request['image'];
        $filename = Str::random(5) . '.' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $filenamee = false;
        if ($request->hasFile('study_report')) {
            $filee = $request['study_report'];
            $filenamee = Str::random(5) . '.' . $filee->getClientOriginalName();
            $destinationPath = public_path('upload/childern/');
            $filee->move($destinationPath, $filenamee);
        }


        $id = $this->child->add($request, $filename, $filenamee);

        if (isset($request['files'])) {
            $destinationPath = public_path('upload/childern/');
            $i = 0;
            $files = $request['files'];
            $ar_names = $request['ar_names'];
            $en_names = $request['en_names'];
            foreach ($files as $file) {
                if ($file != "") {
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->child_report->add($id, $ar_names[$i], $en_names[$i], 'yes', $filename);
                }
                $i++;
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة كفالة طفل يتيم جديدة ' . $request['ar_name'];
        $action->en_action = 'Add new child sponsorship ' . $request['en_name'];
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
        $child = $this->child->getById($id);

        $countries = $this->country->getList();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);

        return view('admin.childern.edit', ['child' => $child, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChild $request, $id) {
        //
        $filename = FALSE;
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/childern/');
            $file->move($destinationPath, $filename);
        }

        $filenamee = false;
        if ($request->hasFile('study_report')) {
            $filee = $request['study_report'];
            $filenamee = Str::random(5) . '.' . $filee->getClientOriginalName();
            $destinationPath = public_path('upload/childern/');
            $filee->move($destinationPath, $filenamee);
        }

        $this->child->edit($id, $request, $filename, $filenamee);

        if (isset($request['files'])) {
            $destinationPath = public_path('upload/childern/');
            $i = 0;
            $files = $request['files'];
            $ar_names = $request['ar_names'];
            $en_names = $request['en_names'];
            foreach ($files as $file) {
                if ($file != "") {
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->child_report->add($id, $ar_names[$i], $en_names[$i], 'yes', $filename);
                }
                $i++;
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل كفالة طفل يتيم حالية ' . $request['ar_name'];
        $action->en_action = 'Edit current child sponsorship ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/childern')->with(['message' => $message]);
    }

    public function show($id) {
        $child = $this->child->getById($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بعرض تبرعات كفالة طفل يتيم  ' . $child['ar_name'];
        $action->en_action = 'show donation of child sponsorship of ' . $child['en_name'];
        $action->ip = request()->ip();
        $action->save();

        return view('admin.childern.show', ['child' => $child]);
    }

    public function childern_reports($id) {
        $report = $this->child_report->getById($id);
        $this->child_report->remove($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بحذف تقرير كفالة طفل يتيم  ' . $report['ar_name'];
        $action->en_action = 'Delete child sponsorship report of ' . $report['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Family;
use App\Models\FamilyReport;
use App\Http\Requests\StoreFamily;
use App\Http\Requests\UpdateFamily;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class FamilyController extends Controller {

    function __construct(Country $Country, Family $Family, FamilyReport $FamilyReport) {
        $this->country = $Country;
        $this->family = $Family;
        $this->family_report = $FamilyReport;
        $this->middleware('role:families_all', ['only' => ['index']]);
        $this->middleware('role:families_add', ['only' => ['create', 'store']]);
        $this->middleware('role:families_edit', ['only' => ['edit', 'update','families_reports']]);
        $this->middleware('role:families_show', ['only' => ['show']]);
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
        $action->ar_action = 'قام بفتح صفحة كفالات الإسر';
        $action->en_action = 'Open families sponsorships page';
        $action->ip = request()->ip();
        $action->save();

        $families = $this->family->getAll();
        return view('admin.families.index', ['families' => $families]);
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

        return view('admin.families.create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFamily $request) {
        // die;
        $destinationPath = public_path('upload/families/');
        $file = $request['image'];
        $filename = Str::random(5) . '.' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $id = $this->family->add($request, $filename);

        if (isset($request['files'])) {
            $destinationPath = public_path('upload/families/');
            $i = 0;
            $files = $request['files'];
            $ar_names = $request['ar_names'];
            $en_names = $request['en_names'];
            foreach ($files as $file) {
                if ($file != "") {
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->family_report->add($id, $ar_names[$i], $en_names[$i], 'yes', $filename);
                }
                $i++;
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة كفالة أسرة جديدة ' . $request['ar_name'];
        $action->en_action = 'Add new family sponsorship ' . $request['en_name'];
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
        $family = $this->family->getById($id);

        $countries = $this->country->getList();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);

        return view('admin.families.edit', ['family' => $family, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFamily $request, $id) {
        //
        $filename = FALSE;
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/families/');
            $file->move($destinationPath, $filename);
        }

        $this->family->edit($id, $request, $filename);

        if (isset($request['files'])) {
            $destinationPath = public_path('upload/families/');
            $i = 0;
            $files = $request['files'];
            $ar_names = $request['ar_names'];
            $en_names = $request['en_names'];
            foreach ($files as $file) {
                if ($file != "") {
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->family_report->add($id, $ar_names[$i], $en_names[$i], 'yes', $filename);
                }
                $i++;
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل كفالة أسرة حالية ' . $request['ar_name'];
        $action->en_action = 'Edit current family sponsorship ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/families')->with(['message' => $message]);
    }

    public function show($id) {
        $family = $this->family->getById($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بعرض تبرعات كفالة أسرة  ' . $family['ar_name'];
        $action->en_action = 'show donation of family sponsorship of ' . $family['en_name'];
        $action->ip = request()->ip();
        $action->save();

        return view('admin.families.show', ['family' => $family]);
    }

    public function families_reports($id) {
        $report = $this->family_report->getById($id);
        $this->family_report->remove($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بحذف تقرير كفالة أسرة  ' . $report['ar_name'];
        $action->en_action = 'Delete family sponsorship report of ' . $report['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

}

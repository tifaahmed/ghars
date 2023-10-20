<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Http\Requests\StoreFamilyMember;
use App\Http\Requests\UpdateFamilyMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FamilyMemberController extends Controller {

    function __construct(Family $Family, FamilyMember $FamilyMember) {
        $this->family = $Family;
        $this->family_member = $FamilyMember;
        $this->middleware('role:families_all', ['only' => ['index']]);
        $this->middleware('role:families_add', ['only' => ['create', 'store']]);
        $this->middleware('role:families_edit', ['only' => ['edit', 'update']]);
        $this->middleware('role:families_show', ['only' => ['show']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $family = $this->family->getById(request()->get('family_id'));

        return view('admin.families_members.create', ['family' => $family]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFamilyMember $request) {
        // die;
        $destinationPath = public_path('upload/families_members/');
        $file = $request['image'];
        $filename = Str::random(5) . '.' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $this->family_member->add($request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة عضو جديد بأسرة ' . $request['ar_name'];
        $action->en_action = 'Add new member at family ' . $request['en_name'];
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
        $family_member = $this->family_member->getById($id);

        return view('admin.families_members.edit', ['family_member' => $family_member]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFamilyMember $request, $id) {
        //
        $family_member = $this->family_member->getById($id);
        $filename = FALSE;
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/families_members/');
            $file->move($destinationPath, $filename);
        }

        $this->family_member->edit($id, $request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل عضو حالي بأسرة ' . $request['ar_name'];
        $action->en_action = 'Edit current member at family ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/families_members/'.$family_member['family_id'])->with(['message' => $message]);
    }

    public function show($id) {
        $family = $this->family->getById($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بعرض أفراد أسرة  ' . $family['ar_name'];
        $action->en_action = 'show members of family ' . $family['en_name'];
        $action->ip = request()->ip();
        $action->save();

        return view('admin.families_members.show', ['family' => $family]);
    }

}

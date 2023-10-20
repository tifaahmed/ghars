<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tutorial;
use App\Http\Requests\StoreTutorial;
use App\Http\Requests\UpdateTutorial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TutorialController extends Controller {

    function __construct(Tutorial $Tutorial) {
        $this->tutorial = $Tutorial;
        $this->middleware('role:tutorials_all', ['only' => ['index']]);
        $this->middleware('role:tutorials_add', ['only' => ['create', 'store']]);
        $this->middleware('role:tutorials_edit', ['only' => ['edit', 'update']]);
        $this->middleware('role:tutorials_delete', ['only' => ['destroy']]);
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
        $action->ar_action = 'قام بفتح صفحة التعريفات';
        $action->en_action = 'Open tutorials page';
        $action->ip = request()->ip();
        $action->save();

        $tutorials = $this->tutorial->getAll();
        return view('admin.tutorials.index', ['tutorials' => $tutorials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('admin.tutorials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTutorial $request) {
        $destinationPath = public_path('upload/tutorials/');
        $file = $request['image'];
        $filename = Str::random(5) . '.' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $this->tutorial->add($request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة تعريف جديد ' . $request['ar_name'];
        $action->en_action = 'Add new tutorial ' . $request['en_name'];
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
        $tutorial = $this->tutorial->getById($id);

        return view('admin.tutorials.edit', ['tutorial' => $tutorial]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTutorial $request, $id) {
        $filename = FALSE;
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/tutorials/');
            $file->move($destinationPath, $filename);
        }

        $this->tutorial->edit($id, $request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل  تعريف حالي ' . $request['ar_name'];
        $action->en_action = 'Edit current tutorial ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/tutorials')->with(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $tutorial = $this->tutorial->getById($id);
        $this->tutorial->remove($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بحذف تعريف حالي ' . $tutorial['ar_name'];
        $action->en_action = 'Delete current tutorial ' . $tutorial['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

}

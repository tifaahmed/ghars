<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherVideo;
use App\Http\Requests\StoreTeacherVideo;
use App\Http\Requests\UpdateTeacherVideo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeacherVideoController extends Controller {

    function __construct(Teacher $Teacher, TeacherVideo $TeacherVideo) {
        $this->teacher = $Teacher;
        $this->teacher_video = $TeacherVideo;
        $this->middleware('role:teachers_all', ['only' => ['index']]);
        $this->middleware('role:teachers_add', ['only' => ['create', 'store']]);
        $this->middleware('role:teachers_edit', ['only' => ['edit', 'update']]);
        $this->middleware('role:teachers_show', ['only' => ['show']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $teacher = $this->teacher->getById(request()->get('teacher_id'));

        return view('admin.teachers_videos.create', ['teacher' => $teacher]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherVideo $request) {
        // die;
        $destinationPath = public_path('upload/teachers_videos/');
        $file = $request['image'];
        $filename = Str::random(5) . '.' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $this->teacher_video->add($request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة محاضرة جديدة لداعية ' . $request['ar_name'];
        $action->en_action = 'Add new lecture for teacher ' . $request['en_name'];
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
        $teacher_video = $this->teacher_video->getById($id);

        return view('admin.teachers_videos.edit', ['teacher_video' => $teacher_video]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherVideo $request, $id) {
        //
        $teacher_video = $this->teacher_video->getById($id);
        $filename = FALSE;
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/teachers_videos/');
            $file->move($destinationPath, $filename);
        }

        $this->teacher_video->edit($id, $request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل محاضرة حالية لداعية ' . $request['ar_name'];
        $action->en_action = 'Edit current video for teacher ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/teachers_videos/'.$teacher_video['teacher_id'])->with(['message' => $message]);
    }

    public function show($id) {
        $teacher = $this->teacher->getById($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بعرض محاضرات الداعية  ' . $teacher['ar_name'];
        $action->en_action = 'show lectures of teacher ' . $teacher['en_name'];
        $action->ip = request()->ip();
        $action->save();

        return view('admin.teachers_videos.show', ['teacher' => $teacher]);
    }

}

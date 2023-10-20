<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Idea;
use App\Http\Requests\UpdateIdea;
use Mail;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller {

    //
    function __construct(Idea $Idea) {
        $this->idea = $Idea;

        $this->middleware('role:ideas_all', ['only' => ['index']]);
        $this->middleware('role:ideas_edit', ['only' => ['edit', 'update']]);
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
        $action->ar_action = 'قام بفتح صفحة الأفكار';
        $action->en_action = 'Open ideas page';
        $action->ip = request()->ip();
        $action->save();

        $ideas = $this->idea->getAll();
        return view('admin.ideas.index', ['ideas' => $ideas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بفتح  الفكرة رقم ' . $id;
        $action->en_action = 'Open idea No. ' . $id;
        $action->ip = request()->ip();
        $action->save();

        $idea = $this->idea->getById($id);
        $this->idea->update_seen($id);
        return view('admin.ideas.edit', ['idea' => $idea]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIdea $request, $id) {
        //
        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بالرد علي الفكرة رقم ' . $id;
        $action->en_action = 'Reply to idea No. ' . $id;
        $action->ip = request()->ip();
        $action->save();

        $idea = $this->idea->getById($id);
        $this->idea->edit($id, $request);
        if ($idea['reply'] != $request['reply']) {
//            Mail::send('emails.idea_reply', ['reply' => $request['reply'], 'name' => $request['name'], 'email' => $request['email'], 'phone' => $request['phone'], 'messagee' => $request['message']], function ($message) use($request) {
//                $message->to($request['email']);
//                $message->subject(trans('admin.idea_message_reply'));
//            });
        }
        $message = trans('admin.send_suc');
        return redirect('admin/ideas')->with(['message' => $message]);
    }

}

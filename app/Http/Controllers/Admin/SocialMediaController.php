<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use App\Http\Requests\UpdateSocialMedia;
use Illuminate\Support\Facades\Auth;

class SocialMediaController extends Controller {

    //
    function __construct(SocialMedia $SocialMedia) {
        $this->social_media = $SocialMedia;
        $this->middleware('role:social_media_all', ['only' => ['index']]);
        $this->middleware('role:social_media_edit', ['only' => ['edit', 'update']]);
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
        $action->ar_action = 'قام بفتح صفحة حسابات التواصل الإجتماعي';
        $action->en_action = 'Open Social Media page';
        $action->ip = request()->ip();
        $action->save();

        $social_media = $this->social_media->getAll();
        return view('admin.social_media.index', ['social_media' => $social_media]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $social_media = $this->social_media->getById($id);
        return view('admin.social_media.edit', ['social_media' => $social_media]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSocialMedia $request, $id) {
        //
        $this->social_media->edit($id, $request);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل حساب تواصل إجتماعي حالي ' . $request['link'];
        $action->en_action = 'Edit current social media account ' . $request['link'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/social_media')->with(['message' => $message]);
    }

}

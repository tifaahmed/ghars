<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Site;
use App\Http\Requests\UpdateSite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SiteController extends Controller {

    //
    function __construct() {
        $this->middleware('role:site_edit', ['only' => ['index', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بفتح صفحة إعدادات الموقع';
        $action->en_action = 'Open site settings page';
        $action->ip = request()->ip();
        $action->save();

        $site = \App\Models\Site::find(1);
        return view('admin.site.index', ['site' => $site]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSite $request) {
        $filename = $filenamee = $filenameee = FALSE;
        $destinationPath = public_path('upload/site/');
        if ($request->hasFile('childern')) {
            $file = $request['childern'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
        }
        if ($request->hasFile('families')) {
            $filee = $request['families'];
            $filenamee = Str::random(5) . '.' . $filee->getClientOriginalName();
            $filee->move($destinationPath, $filenamee);
        }
        if ($request->hasFile('teachers')) {
            $fileee = $request['teachers'];
            $filenameee = Str::random(5) . '.' . $fileee->getClientOriginalName();
            $fileee->move($destinationPath, $filenameee);
        }

        $site = \App\Models\Site::find(1);
        $site->edit($request, $filename, $filenamee, $filenameee);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل إعدادات الموقع';
        $action->en_action = 'Edit site settings ';
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return back()->with(['message' => $message]);
    }

}

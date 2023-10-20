<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Http\Requests\StoreAds;
use App\Http\Requests\UpdateAds;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdsController extends Controller {

    function __construct(Ads $Ads) {
        $this->ads = $Ads;
        $this->middleware('role:ads_all', ['only' => ['index']]);
        $this->middleware('role:ads_add', ['only' => ['create', 'store']]);
        $this->middleware('role:ads_edit', ['only' => ['edit', 'update']]);
        $this->middleware('role:ads_delete', ['only' => ['destroy']]);
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
        $action->ar_action = 'قام بفتح صفحة الإعلانات';
        $action->en_action = 'Open ads page';
        $action->ip = request()->ip();
        $action->save();

        $ads = $this->ads->getAll();
        return view('admin.ads.index', ['ads' => $ads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('admin.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAds $request) {
        $destinationPath = public_path('upload/ads/');
        $file = $request['image'];
        $filename = Str::random(5) . '.' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $this->ads->add($request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة صورة جديدة بالإعلانات ' . $request['ar_name'];
        $action->en_action = 'Add new ads ' . $request['en_name'];
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
        $ads = $this->ads->getById($id);

        return view('admin.ads.edit', ['ads' => $ads]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAds $request, $id) {
        $filename = FALSE;
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/ads/');
            $file->move($destinationPath, $filename);
        }

        $this->ads->edit($id, $request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل  صورة حالية بالإعلانات ' . $request['ar_name'];
        $action->en_action = 'Edit current ads ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/ads')->with(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $ads = $this->ads->getById($id);
        $this->ads->remove($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بحذف صورة حالية بالإعلانات ' . $ads['ar_name'];
        $action->en_action = 'Delete current ads ' . $ads['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

}

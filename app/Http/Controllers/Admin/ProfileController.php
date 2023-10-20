<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests\UpdateProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class ProfileController extends Controller {

    //
    function __construct(User $User,Country $Country) {
        $this->user = $User;
        $this->country = $Country;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $countries = $this->country->getList();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);
        
        return view('admin.profile.index',['countries'=>$countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfile $request, $id) {
        $this->user->edit($id, $request);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل  بيانات حسابه';
        $action->en_action = 'update his profile info';
        $action->ip = request()->ip();
        $action->save();

        $message = 'تم حفظ التعديل بنجاح';
        return back()->with(['message' => $message]);
    }

}

<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\UserFile;
use App\Http\Requests\UpdateProfileCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProfileController extends Controller {

    //
    function __construct(User $User,Country $Country,UserFile $UserFile) {
        $this->user = $User;
        $this->country = $Country;
        $this->user_file = $UserFile;
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
        
        return view('dashboard.profile.index',['countries'=>$countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileCompany $request, $id) {
        $this->user->edit($id, $request);
        
        if (isset($request['files'])) {
            $destinationPath = public_path('upload/companies/');
            $i = 0;
            $files = $request['files'];
            $ar_names = $request['ar_names'];
            $en_names = $request['en_names'];
            foreach ($files as $file) {
                if ($file != "") {
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->user_file->add($id, $ar_names[$i], $en_names[$i], 'yet', $filename);
                }
                $i++;
            }
        }

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

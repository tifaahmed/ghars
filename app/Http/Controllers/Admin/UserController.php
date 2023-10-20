<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class UserController extends Controller {

    //
    function __construct(User $User, Country $Country) {
        $this->user = $User;
        $this->country = $Country;
        $this->middleware('role:users_all', ['only' => ['index']]);
        $this->middleware('role:users_add', ['only' => ['create', 'store']]);
        $this->middleware('role:users_edit', ['only' => ['edit', 'update']]);
        $this->middleware('role:users_delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بفتح صفحة أعضاء التطبيقات';
        $action->en_action = 'Open application users page';
        $action->ip = request()->ip();
        $action->save();

        $users = $this->user->getAll('user');
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {        
        $countries = $this->country->getList();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);
        
        return view('admin.users.create',['countries'=>$countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request) {
        $request['type'] = 'user';
        $this->user->add($request);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة عضو جديد بالتطبيق ' . $request['name'];
        $action->en_action = 'Add new application user ' . $request['name'];
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
        $user = $this->user->getById($id);

        $countries = $this->country->getList();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);

        return view('admin.users.edit', ['user' => $user, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id) {
        $this->user->edit($id, $request);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل  عضو حالي بالتطبيق ' . $request['name'];
        $action->en_action = 'Edit current application user ' . $request['name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/users')->with(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $user = $this->user->getById($id);
        $this->user->remove($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بحذف عضو حالي بالتطبيق ' . $user['name'];
        $action->en_action = 'Delete current application user ' . $user['name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

}

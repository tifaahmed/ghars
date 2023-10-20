<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Http\Requests\UpdateCountry;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller {

    //
    function __construct(Country $Country) {
        $this->country = $Country;
        $this->middleware('role:countries_all', ['only' => ['index']]);
        $this->middleware('role:countries_edit', ['only' => ['edit', 'update']]);
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
        $action->ar_action = 'قام بفتح صفحة الدول';
        $action->en_action = 'Open countries page';
        $action->ip = request()->ip();
        $action->save();
        
        $countries = $this->country->getAll();
        return view('admin.countries.index', ['countries' => $countries]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $country = $this->country->getById($id);

        return view('admin.countries.edit', ['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountry $request, $id) {
        //
        $this->country->edit($id, $request);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل  دولة حالية ' . $request['ar_name'];
        $action->en_action = 'Edit current country ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/countries')->with(['message' => $message]);
    }

}

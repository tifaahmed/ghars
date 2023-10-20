<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Http\Requests\UpdateCurrency;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller {

    //
    function __construct(Currency $Currency) {
        $this->currency = $Currency;
        $this->middleware('role:currencies_all', ['only' => ['index']]);
        $this->middleware('role:currencies_edit', ['only' => ['edit', 'update']]);
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
        $action->ar_action = 'قام بفتح صفحة العملات';
        $action->en_action = 'Open currencies page';
        $action->ip = request()->ip();
        $action->save();

        $currencies = $this->currency->getAll();
        return view('admin.currencies.index', ['currencies' => $currencies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $currency = $this->currency->getById($id);

        return view('admin.currencies.edit', ['currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCurrency $request, $id) {
        //
        $this->currency->edit($id, $request);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل  عملة حالية ' . $request['ar_name'];
        $action->en_action = 'Edit current currency ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/currencies')->with(['message' => $message]);
    }

}

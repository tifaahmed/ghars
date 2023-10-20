<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller {

    //
    function __construct(Action $Action) {
        $this->action = $Action;
        $this->middleware('role:log_all', ['only' => ['index']]);
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
        $action->ar_action = 'قام بفتح صفحة عمليات النظام';
        $action->en_action = 'open log page';
        $action->ip = request()->ip();
        $action->save();

        $actions = $this->action->getAll();
        return view('admin.log.index', ['actions' => $actions]);
    }

}

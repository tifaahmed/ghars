<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller {

    //
    function __construct(Visitor $Visitor) {
        $this->visitor = $Visitor;
        $this->middleware('role:visitors_all', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بفتح صفحة الزائرين';
        $action->en_action = 'Open visitors page';
        $action->ip = request()->ip();
        $action->save();

        $visitors = $this->visitor->getAll();
        return view('admin.visitors.index', ['visitors' => $visitors]);
    }

}

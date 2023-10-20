<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller {

    function __construct(Donation $Donation) {
        $this->donation = $Donation;
        $this->middleware('role:donations_all', ['only' => ['index']]);
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
        $action->ar_action = 'قام بفتح صفحة التبرعات';
        $action->en_action = 'Open donations page';
        $action->ip = request()->ip();
        $action->save();

        $donations = $this->donation->getAll();
        return view('admin.donations.index', ['donations' => $donations]);
    }

    public function update(Request $request, $id) {
        //
        $this->donation->edit($id, $request['active']);
        $message = trans('admin.edit_suc');
        return back()->with(['message' => $message]);
    }

}

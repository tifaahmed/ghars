<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class DashboardController extends Controller {

    //
    function __construct() {
    }

    public function getLogin() {
        if (Auth::Check()) {
            return redirect('dashboard');
        }
        return view('dashboard.home.login');
    }

    public function postLogin() {
        $inputs = Request()->all();

        $remember = FALSE;
        if (isset($inputs['remember'])) {
            $remember = TRUE;
        }
        if (Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password'], 'type' => 'company', 'deleted_at' => null], $remember)) {
            $active = Auth::user()->active;
            if ($active == 'yes') {
                $action = new \App\Models\Action();
                $action->user_id = Auth::User()->id;
                $action->ar_action = 'قام بتسجيل الدخول للوحة التحكم';
                $action->en_action = 'Login to dashboard';
                $action->ip = request()->ip();
                $action->save();

                return redirect()->intended('dashboard');
            } else {
                Auth::logout();
                return back()->withInput()->withError(trans('admin.not_allow'));
            }
        } else {
            return back()->withInput()->withError(trans('admin.wrong_login'));
        }
    }

    public function logout() {
        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتسجيل الخرج من لوحة التحكم';
        $action->en_action = 'Logout from dashboard';
        $action->ip = request()->ip();
        $action->save();

        Auth::logout();
        return redirect('dashboard/login');
    }

    public function index() {
        if (!Auth::Check()) {
            return redirect('dashboard/login');
        }
        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بفتح الرئيسية للوحة التحكم';
        $action->en_action = 'Go to dashboard homepage';
        $action->ip = request()->ip();
        $action->save();

        return view('dashboard.home.index');
    }

    public function not_allow() {
        return view('dashboard.home.deny');
    }

    public function ajax_categories_steps($id) {
        $categories_steps = $this->category_step->getListCategory($id);
        $categories_steps = Arr::add($categories_steps, '', trans('admin.choose'));
        $categories_steps = array_reverse($categories_steps, TRUE);
        $value = request()->get('value');
        return view('dashboard.home.ajax_categories_steps', ['categories_steps' => $categories_steps, 'value' => $value]);
    }

}

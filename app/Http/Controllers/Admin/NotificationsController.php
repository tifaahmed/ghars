<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Http\Requests\StoreNotification;
use App\Http\Library\PushNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class NotificationsController extends Controller {

    //
    function __construct(Notification $Notification) {
        $this->notification = $Notification;
        $this->middleware('role:notifications_all', ['only' => ['index']]);
        $this->middleware('role:notifications_add', ['only' => ['store']]);
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
        $action->ar_action = 'قام بفتح صفحة الإشعارات';
        $action->en_action = 'Open notifications page';
        $action->ip = request()->ip();
        $action->save();

        $notifications = $this->notification->getAll();

        return view('admin.notifications.index', ['notifications' => $notifications]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotification $request) {
        $this->notification->add($request);
        $ios_data_ar = ['action' => 'open', 'title' => $request['ar_title'], 'alert' => $request['ar_message']];
        $ios_data_en = ['action' => 'open', 'title' => $request['ar_title'], 'alert' => $request['en_message']];
        $android_data_ar = ['action' => 'open', 'title' => $request['ar_title'], 'message' => $request['ar_message']];
        $android_data_en = ['action' => 'open', 'title' => $request['en_title'], 'message' => $request['en_message']];

        if ($request['platform'] == 'all' || $request['platform'] == 'ios') {
            PushNotifications::ios('IosAr', $ios_data_ar, 'topic');
            PushNotifications::ios('IosEn', $ios_data_en, 'topic');
        }

        if ($request['platform'] == 'all' || $request['platform'] == 'android') {
            PushNotifications::android('AndroidAr', $android_data_ar, 'topic');
            PushNotifications::android('AndroidEn', $android_data_en, 'topic');
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإرسال إشعار جديد ' . $request['ar_message'];
        $action->en_action = 'Send new notification ' . $request['en_message'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.notification_suc');
        return back()->with(['message' => $message]);
    }

}

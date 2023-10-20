<?php

namespace App\Http\Controllers;

use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreContact;
use App\Http\Requests\StoreIdea;
use App\Http\Requests\UpdateProfile;
use App\Http\Requests\StoreProjectIntro;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Http\Library\Payment;
use Session;

class HomeController extends Controller {

    public function __construct() {
        $site = \App\Models\Site::first();
        $social_media = \App\Models\SocialMedia::get();
        $pages = \App\Models\Page::get();
        $currencies = \App\Models\Currency::where('active', 'yes')->orderBy('sort', 'asc')->get();
        $currency_info = \App\Models\Currency::find(Session::get('currency'));
        if (!$currency_info) {
            $currency_info = \App\Models\Currency::find(1);
        }

        $codes = \App\Models\Country::orderBy('code', 'desc')->pluck('code', 'id')->toArray();
        $codes = Arr::add($codes, '', trans('admin.country_code'));
        $codes = array_reverse($codes, TRUE);

        view()->share('site', $site);
        view()->share('social_media', $social_media);
        view()->share('pages', $pages);
        view()->share('currencies', $currencies);
        view()->share('currency_info', $currency_info);
        view()->share('codes', $codes);
    }

    public function language() {
        $lang = Config::get('app.locale');
        if ($lang == "ar") {
            Request()->session()->put('locale', 'en');
        } else {
            Request()->session()->put('locale', 'ar');
        }
        return back();
    }

    public function currency($id) {
        Request()->session()->put('currency', $id);
        return back();
    }

    public function index() {
        $slider = \App\Models\Slider::where('active', 'yes')->orderBy('sort', 'asc')->get();
        return view('interface.index', ['slider' => $slider]);
    }

    public function subscribe(Request $request) {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
        ]);
        if (!$validator->passes()) {
            return response()->json(['response' => 'notValid']);
        }

        $check = \App\Models\Newsletter::where('email', '=', $request['email'])->first();
        if ($check != null) {
            return response()->json(['response' => 'exsits']);
        } else {
            $newsletter = new \App\Models\Newsletter();
            $newsletter->email = $request['email'];
            $newsletter->save();
            return response()->json(['response' => 'saved']);
        }
    }

    public function login() {
        $request = Request()->all();
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'deleted_at' => null], TRUE)) {
            if (Auth::user()->active) {
                return back()->withSuccess(trans('admin.login_suc'));
            } else {
                Auth::logout();
                return back()->withError(trans('admin.not_allow'));
            }
        } else {
            return back()->withError(trans('admin.wrong_login'));
        }
    }

    public function register() {
        $request = request()->all();
        $validator = Validator::make($request, [
                    "email" => "required|email|unique:users,email,null,id,deleted_at,NULL",
                    "name" => "required|unique:users,name,null,id,deleted_at,NULL",
                    "phone" => "required|numeric|unique:users,phone,null,id,deleted_at,NULL,country_id," . $request['country_id'],
                    "password" => "required|confirmed",
                    "password_confirmation" => "required",
                    "country_id" => "required",
        ]);

        if ($validator->fails()) {
            $message = "";
            foreach ($validator->errors()->all() as $one_error) {
                if ($message == "") {
                    $message = $one_error;
                } else {
                    $message = $message . ' , ' . $one_error;
                }
            }
            return back()->withError($message);
        } else {
            $new = new \App\Models\User();
            $new->name = $request['name'];
            $new->email = $request['email'];
            $new->country_id = $request['country_id'];
            $new->phone = $request['phone'];
            $new->whatsapp = $request['whatsapp'];
            $new->governate = $request['governate'];
            $new->city = $request['city'];
            $new->street = $request['street'];
            $new->password = Hash::make($request['password']);
            $new->token = Hash::make($request['email']);
            $new->type = 'user';
            $new->active = 'yes';
            $new->save();

            Auth::login($new, TRUE);

//            Mail::send('emails.welcome', ['name' => $request['name']], function ($message) use ($request) {
//                $message->to($request['email']);
//                $message->subject(trans('admin.welcome_message'));
//            });

            return back()->withSuccess(trans('admin.register_suc'));
        }
    }

    public function forget_password() {
        $request = request()->all();
        $validator = Validator::make($request, [
                    "email" => "required|email"
        ]);

        if ($validator->fails()) {
            $message = "";
            foreach ($validator->errors()->all() as $one_error) {
                if ($message == "") {
                    $message = $one_error;
                } else {
                    $message = $message . ' , ' . $one_error;
                }
            }
            return back()->withError($message);
        } else {
            $user_email = \App\Models\User::where('email', $request['email'])->where('active', '!=', 'delete')->first();
            if ($user_email) {
                \App\Models\PasswordReset::where('email', $user_email['email'])->delete();

                $random = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(24 / strlen($x)))), 1, 24);
                $token = $random . strtotime(now());
                $PasswordReset = new \App\Models\PasswordReset();
                $PasswordReset->email = $user_email['email'];
                $PasswordReset->token = $token;
                $PasswordReset->save();

//                Mail::send('emails.forget_password', ['token' => $token], function ($message) use ($user_email) {
//                    $message->to($user_email['email']);
//                    $message->subject(trans('admin.reset_password'));
//                });

                return back()->withSuccess(trans('admin.suc_reset'));
            } else {
                return back()->withError(trans('api.no_user'));
            }
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/')->withSuccess(trans('admin.logout_suc'));
    }

    public function page($id) {
        $page = \App\Models\Page::find($id);
        return view('interface.page', ['page' => $page]);
    }

    public function contact_get() {
        return view('interface.contact');
    }

    public function contact_post(StoreContact $request) {
        $new = new \App\Models\Contact();
        $new->name = $request['name'];
        $new->phone = $request['phone'];
        $new->email = $request['email'];
        $new->message = $request['message'];
        $new->save();

//        Mail::send('emails.contact', ['name' => $request['name'], 'email' => $request['email'], 'phone' => $request['phone'], 'messagee' => $request['message']], function ($message) use ($request) {
//            $message->to($request['email']);
//            $message->subject(trans('admin.contact_message'));
//        });

        return back()->withSuccess(trans('admin.send_suc'));
    }

    public function idea_get() {
        return view('interface.idea');
    }

    public function idea_post(StoreIdea $request) {
        $new = new \App\Models\Idea();
        $new->name = $request['name'];
        $new->phone = $request['phone'];
        $new->email = $request['email'];
        $new->message = $request['message'];
        $new->type = $request['type'];
        $new->save();

//        Mail::send('emails.contact', ['name' => $request['name'], 'email' => $request['email'], 'phone' => $request['phone'], 'messagee' => $request['message']], function ($message) use ($request) {
//            $message->to($request['email']);
//            $message->subject(trans('admin.contact_message'));
//        });

        return back()->withSuccess(trans('admin.send_suc'));
    }

    public function childern() {
        $lang = Config::get('app.locale');
        $request = request()->all();

        $countries = \App\Models\Country::where('active', 'yes')->orderBy($lang . '_name', 'desc')->whereExists(function ($query) {
                    $query->select(\DB::raw(1))->where('childern.active', 'yes')
                            ->from('childern')
                            ->whereRaw('childern.country_id = countries.id');
                })->pluck($lang . '_name', 'id')->toArray();
        $countries = Arr::add($countries, '', trans('admin.choose'));
        $countries = array_reverse($countries, TRUE);

        $childern = \App\Models\Child::where('active', 'yes')->orderBy('id', 'desc');
        if (isset($request['gender']) && $request['gender'] != '') {
            $childern = $childern->where('gender', $request['gender']);
        }
        if (isset($request['country']) && $request['country'] != '') {
            $childern = $childern->where('country_id', $request['country']);
        }
        if (isset($request['required']) && $request['required'] == 'yes') {
            $childern = $childern->where('required', 'yes');
        }
        if (isset($request['age']) && $request['age'] != '') {
            $start = $request['age'] - 5;
            $start_date = date("Y-m-d", strtotime("-" . $request['age'] . " year"));
            $end_date = date("Y-m-d", strtotime("-" . $start . " year"));
            $childern = $childern->where('birth_date', '>=', $start_date)->where('birth_date', '<', $end_date);
        }
        $childern = $childern->get();

        return view('interface.childern', ['countries' => $countries, 'childern' => $childern]);
    }

    public function child($id) {
        $lang = Config::get('app.locale');
        $type = request()->get('type');

        $child = \App\Models\Child::find($id);

        $countries = \App\Models\Country::where('active', 'yes')->orderBy($lang . '_name', 'desc')->pluck($lang . '_name', 'id')->toArray();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);

        if ($type == '' || $type == 'info') {
            return view('interface.child_info', ['child' => $child, 'countries' => $countries]);
        } elseif ($type == 'study') {
            return view('interface.child_study', ['child' => $child, 'countries' => $countries]);
        } elseif ($type == 'health') {
            return view('interface.child_health', ['child' => $child, 'countries' => $countries]);
        } elseif ($type == 'social') {
            return view('interface.child_social', ['child' => $child, 'countries' => $countries]);
        } elseif ($type == 'reports') {
            return view('interface.child_reports', ['child' => $child, 'countries' => $countries]);
        } elseif ($type == 'gift') {
            $gifts = \App\Models\Gift::where('type', 'childern')->where('active', 'yes')->orderBy('sort', 'asc')->get();
            return view('interface.child_gifts', ['child' => $child, 'countries' => $countries, 'gifts' => $gifts]);
        }
    }

    public function ajax_country($id) {
        $country = \App\Models\Country::find($id);
        return view('interface.ajax_country', ['country' => $country]);
    }

    public function families() {
        $lang = Config::get('app.locale');
        $request = request()->all();

        $countries = \App\Models\Country::where('active', 'yes')->orderBy($lang . '_name', 'desc')->whereExists(function ($query) {
                    $query->select(\DB::raw(1))->where('families.active', 'yes')
                            ->from('families')
                            ->whereRaw('families.country_id = countries.id');
                })->pluck($lang . '_name', 'id')->toArray();
        $countries = Arr::add($countries, '', trans('admin.choose'));
        $countries = array_reverse($countries, TRUE);

        $families = \App\Models\Family::where('active', 'yes')->orderBy('id', 'desc');
        if (isset($request['gender']) && $request['gender'] != '') {
            $families = $families->where('gender', $request['gender']);
        }
        if (isset($request['country']) && $request['country'] != '') {
            $families = $families->where('country_id', $request['country']);
        }
        if (isset($request['required']) && $request['required'] == 'yes') {
            $families = $families->where('required', 'yes');
        }
        if (isset($request['age']) && $request['age'] != '') {
            $families = $families->where('members_count', $request['age']);
        }
        $families = $families->get();

        return view('interface.families', ['countries' => $countries, 'families' => $families]);
    }

    public function family($id) {
        $lang = Config::get('app.locale');
        $type = request()->get('type');

        $family = \App\Models\Family::find($id);

        $countries = \App\Models\Country::where('active', 'yes')->orderBy($lang . '_name', 'desc')->pluck($lang . '_name', 'id')->toArray();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);

        if ($type == '' || $type == 'info') {
            return view('interface.family_info', ['family' => $family, 'countries' => $countries]);
        } elseif ($type == 'social') {
            return view('interface.family_social', ['family' => $family, 'countries' => $countries]);
        } elseif ($type == 'member') {
            $members = \App\Models\FamilyMember::where('family_id', $family['id'])->where('active', 'yes')->get();
            return view('interface.family_members', ['family' => $family, 'countries' => $countries, 'members' => $members]);
        } elseif ($type == 'reports') {
            return view('interface.family_reports', ['family' => $family, 'countries' => $countries]);
        } elseif ($type == 'gift') {
            $gifts = \App\Models\Gift::where('type', 'families')->where('active', 'yes')->orderBy('sort', 'asc')->get();
            return view('interface.family_gifts', ['family' => $family, 'countries' => $countries, 'gifts' => $gifts]);
        }
    }

    public function teachers() {
        $lang = Config::get('app.locale');
        $request = request()->all();

        $countries = \App\Models\Country::where('active', 'yes')->orderBy($lang . '_name', 'desc')->whereExists(function ($query) {
                    $query->select(\DB::raw(1))->where('teachers.active', 'yes')
                            ->from('teachers')
                            ->whereRaw('teachers.country_id = countries.id');
                })->pluck($lang . '_name', 'id')->toArray();
        $countries = Arr::add($countries, '', trans('admin.choose'));
        $countries = array_reverse($countries, TRUE);

        $teachers = \App\Models\Teacher::where('active', 'yes')->orderBy('id', 'desc');
        if (isset($request['gender']) && $request['gender'] != '') {
            $teachers = $teachers->where('gender', $request['gender']);
        }
        if (isset($request['country']) && $request['country'] != '') {
            $teachers = $teachers->where('country_id', $request['country']);
        }
        if (isset($request['required']) && $request['required'] == 'yes') {
            $teachers = $teachers->where('required', 'yes');
        }
        if (isset($request['age']) && $request['age'] != '') {
            $start = $request['age'] - 5;
            $start_date = date("Y-m-d", strtotime("-" . $request['age'] . " year"));
            $end_date = date("Y-m-d", strtotime("-" . $start . " year"));
            $teachers = $teachers->where('birth_date', '>=', $start_date)->where('birth_date', '<', $end_date);
        }
        $teachers = $teachers->get();

        return view('interface.teachers', ['countries' => $countries, 'teachers' => $teachers]);
    }

    public function teacher($id) {
        $lang = Config::get('app.locale');
        $type = request()->get('type');

        $teacher = \App\Models\Teacher::find($id);

        $countries = \App\Models\Country::where('active', 'yes')->orderBy($lang . '_name', 'desc')->pluck($lang . '_name', 'id')->toArray();
        $countries = Arr::add($countries, '', trans('admin.choose_country'));
        $countries = array_reverse($countries, TRUE);

        if ($type == '' || $type == 'info') {
            return view('interface.teacher_info', ['teacher' => $teacher, 'countries' => $countries]);
        } elseif ($type == 'qualification') {
            return view('interface.teacher_qualification', ['teacher' => $teacher, 'countries' => $countries]);
        } elseif ($type == 'oranization') {
            return view('interface.teacher_oranization', ['teacher' => $teacher, 'countries' => $countries]);
        } elseif ($type == 'video') {
            $videos = \App\Models\TeacherVideo::where('teacher_id', $teacher['id'])->where('active', 'yes')->get();
            return view('interface.teacher_videos', ['teacher' => $teacher, 'countries' => $countries, 'videos' => $videos]);
        } elseif ($type == 'reports') {
            return view('interface.teacher_reports', ['teacher' => $teacher, 'countries' => $countries]);
        } elseif ($type == 'gift') {
            $gifts = \App\Models\Gift::where('type', 'teachers')->where('active', 'yes')->orderBy('sort', 'asc')->get();
            return view('interface.teacher_gifts', ['teacher' => $teacher, 'countries' => $countries, 'gifts' => $gifts]);
        }
    }

    public function donation($type, $id) {
        $request = request()->all();
        $lang = Config::get('app.locale');
        $currency_info = \App\Models\Currency::find(Session::get('currency'));

        if ($type == 'childern') {
            $sponsorship = \App\Models\Child::find($id);
        } elseif ($type == 'families') {
            $sponsorship = \App\Models\Family::find($id);
        } elseif ($type == 'teachers') {
            $sponsorship = \App\Models\Teacher::find($id);
        } elseif ($type == 'projects') {
            $sponsorship = \App\Models\Project::find($id);
        }

        if (Auth::Check()) {
            if ($type != 'projects') {
                $validator = Validator::make($request, [
                            "time" => "required",
                            "gift" => "required",
                            'gift_name' => "required_if:gift,yes"
                ]);
            } else {
                $validator = Validator::make($request, [
                            "amount" => "required|numeric",
                            "gift" => "required",
                            'gift_name' => "required_if:gift,yes"
                ]);
            }
        } else {
            if ($type != 'projects') {
                $validator = Validator::make($request, [
                            "name" => "required",
                            "phone" => "required",
                            "country_id" => "required",
                            "time" => "required",
                            "gift" => "required",
                            'gift_name' => "required_if:gift,yes"
                ]);
            } else {
                $validator = Validator::make($request, [
                            "name" => "required",
                            "phone" => "required",
                            "country_id" => "required",
                            "amount" => "required|numeric",
                            "gift" => "required",
                            'gift_name' => "required_if:gift,yes"
                ]);
            }
        }

        if ($validator->fails()) {
            $message = "";
            foreach ($validator->errors()->all() as $one_error) {
                if ($message == "") {
                    $message = $one_error;
                } else {
                    $message = $message . ' , ' . $one_error;
                }
            }
            return back()->withInput()->withError($message);
        } else {
            if (Auth::Check()) {
                $exist_donation = \App\Models\Donation::where('user_id', Auth::User()->id)->where('user_type', 'user')->where('rel_id', $sponsorship['id'])->where('category', $type)->where('type', 'always')->where('active', 'yes')->first();
            } else {
                $visitor = \App\Models\Visitor::where('name', $request['name'])->where('phone', $request['phone'])->where('country_id', $request['country_id'])->first();
                if ($visitor) {
                    $visitor_id = $visitor['id'];
                } else {
                    $new_visitor = new \App\Models\Visitor();
                    $new_visitor->name = $request['name'];
                    $new_visitor->country_id = $request['country_id'];
                    $new_visitor->phone = $request['phone'];
                    $new_visitor->email = $request['email'];
                    $new_visitor->save();

                    $visitor_id = $new_visitor->id;
                }
                $exist_donation = \App\Models\Donation::where('user_id', $visitor_id)->where('user_type', 'visitor')->where('rel_id', $sponsorship['id'])->where('category', $type)->where('type', 'always')->where('active', 'yes')->first();
            }
            if ($exist_donation) {
                return back()->withInput()->withError(trans('admin.exist_donation'));
            }

            $new_donation = new \App\Models\Donation();
            $new_donation->rel_id = $sponsorship['id'];
            $new_donation->ar_currency = $currency_info['ar_currency'];
            $new_donation->en_currency = $currency_info['en_currency'];
            $new_donation->format = $currency_info['currency_format'];
            if ($type != 'projects') {
                $new_donation->amount = $sponsorship['amount'] / $currency_info['equal'];
            } else {
                $new_donation->amount = $request['amount'];
            }
            $new_donation->category = $type;
            $new_donation->type = $request['time'];
            $new_donation->pay_type = $request['pay_type'];
            if ($request['pay_type'] == 'knet') {
                $new_donation->active = 'unpaid';
            } else {
                $new_donation->active = 'yet';
            }
            if ($request['time'] == 'always') {
                if (date('d') < 29) {
                    $new_donation->day = date('d');
                } else {
                    $new_donation->day = 28;
                }
            }
            if ($request['gift'] == 'yes') {
                $new_donation->name = $request['gift_name'];
            }
            if (Auth::Check()) {
                $new_donation->user_id = Auth::User()->id;
                $new_donation->user_type = 'user';

                $name = Auth::User()->name;
                $email = Auth::User()->email;
                $phone = Auth::User()->phone;
                $code = Auth::User()->Country->Code;
            } else {
                $new_donation->user_id = $visitor_id;
                $new_donation->user_type = 'visitor';

                $name = $request['name'];
                $phone = $request['phone'];
                $code = \App\Models\Country::find($request['country_id'])->code;
                if ($request['email'] != '') {
                    $email = $request['email'];
                } else {
                    $email = \App\Models\Site::first()->email;
                }
            }
            $new_donation->save();
        }

        if ($request['pay_type'] == 'knet') {
            $donation = \App\Models\Donation::find($new_donation->id);
            $payment['amount'] = $donation['amount'];
            $payment['currency'] = $currency_info['currency'];
            $payment['description'] = $sponsorship[$lang . '_name'];
            $payment['reference']['transaction'] = $donation->id;
            $payment['reference']['order'] = $donation->id;
            $payment['customer']['first_name'] = $name;
            $payment['customer']['middle_name'] = '';
            $payment['customer']['last_name'] = '';
            $payment['customer']['email'] = $email;
            $payment['customer']['phone']['country_code'] = $code;
            $payment['customer']['phone']['number'] = $phone;
            $payment['source']['id'] = 'src_all';
            $payment['redirect']['url'] = url('payment_result');

            $url = Payment::get_url($payment);
            return redirect($url);
        } else {
            return back()->withSuccess(trans('admin.donation_suc'));
        }
    }

    public function gift($type, $id) {
        $request = request()->all();
        $lang = Config::get('app.locale');
        $currency_info = \App\Models\Currency::find(Session::get('currency'));
        $gift = \App\Models\Gift::find($request['gift_id']);

        if ($type == 'childern') {
            $sponsorship = \App\Models\Child::find($id);
        } elseif ($type == 'families') {
            $sponsorship = \App\Models\Family::find($id);
        } elseif ($type == 'teachers') {
            $sponsorship = \App\Models\Teacher::find($id);
        }

        if (Auth::Check()) {
            $validator = Validator::make($request, [
                        "gift_id" => "required",
            ]);
        } else {
            $validator = Validator::make($request, [
                        "name" => "required",
                        "phone" => "required",
                        "country_id" => "required",
                        "gift_id" => "required",
            ]);
        }

        if ($validator->fails()) {
            $message = "";
            foreach ($validator->errors()->all() as $one_error) {
                if ($message == "") {
                    $message = $one_error;
                } else {
                    $message = $message . ' , ' . $one_error;
                }
            }
            return back()->withInput()->withError($message);
        } else {
            if (!Auth::Check()) {
                $visitor = \App\Models\Visitor::where('name', $request['name'])->where('phone', $request['phone'])->where('country_id', $request['country_id'])->first();
                if ($visitor) {
                    $visitor_id = $visitor['id'];
                } else {
                    $new_visitor = new \App\Models\Visitor();
                    $new_visitor->name = $request['name'];
                    $new_visitor->country_id = $request['country_id'];
                    $new_visitor->phone = $request['phone'];
                    $new_visitor->email = $request['email'];
                    $new_visitor->save();

                    $visitor_id = $new_visitor->id;
                }
            }

            $new_donation = new \App\Models\Donation();
            $new_donation->rel_id = $sponsorship['id'];
            $new_donation->gift_id = $request['gift_id'];
            $new_donation->ar_currency = $currency_info['ar_currency'];
            $new_donation->en_currency = $currency_info['en_currency'];
            $new_donation->format = $currency_info['currency_format'];
            $new_donation->amount = $gift['amount'] / $currency_info['equal'];
            $new_donation->category = $type;
            $new_donation->type = 'one';
            $new_donation->pay_type = 'knet';
            $new_donation->active = 'unpaid';
            if (Auth::Check()) {
                $new_donation->user_id = Auth::User()->id;
                $new_donation->user_type = 'user';

                $name = Auth::User()->name;
                $email = Auth::User()->email;
                $phone = Auth::User()->phone;
                $code = Auth::User()->Country->Code;
            } else {
                $new_donation->user_id = $visitor_id;
                $new_donation->user_type = 'visitor';

                $name = $request['name'];
                $phone = $request['phone'];
                $code = \App\Models\Country::find($request['country_id'])->code;
                if ($request['email'] != '') {
                    $email = $request['email'];
                } else {
                    $email = \App\Models\Site::first()->email;
                }
            }
            $new_donation->save();
        }

        $donation = \App\Models\Donation::find($new_donation->id);
        $payment['amount'] = $donation['amount'];
        $payment['currency'] = $currency_info['currency'];
        $payment['description'] = $sponsorship[$lang . '_name'];
        $payment['reference']['transaction'] = $donation->id;
        $payment['reference']['order'] = $donation->id;
        $payment['customer']['first_name'] = $name;
        $payment['customer']['middle_name'] = '';
        $payment['customer']['last_name'] = '';
        $payment['customer']['email'] = $email;
        $payment['customer']['phone']['country_code'] = $code;
        $payment['customer']['phone']['number'] = $phone;
        $payment['source']['id'] = 'src_all';
        $payment['redirect']['url'] = url('payment_result');

        $url = Payment::get_url($payment);
        return redirect($url);
    }

    public function payment_result() {
        $request = request()->all();

        $result = Payment::check($request['tap_id']);
        $data = $result['reference']['order'];
        $donation = \App\Models\Donation::find($data);

        if ($result['status'] == 'CAPTURED') {
            $donation->payment_id = $result['reference']['payment'];
            $donation->transaction_id = $result['reference']['gateway'];
            $donation->active = 'yes';
            $donation->save();

            if ($donation['gift_id'] == 0) {
                if ($donation['category'] == 'childern' && $donation['rel_id'] > 0) {
                    return redirect('child/' . $donation['rel_id'])->withSuccess(trans('admin.donation_suc'));
                } elseif ($donation['category'] == 'families' && $donation['rel_id'] > 0) {
                    return redirect('family/' . $donation['rel_id'])->withSuccess(trans('admin.donation_suc'));
                } elseif ($donation['category'] == 'teachers' && $donation['rel_id'] > 0) {
                    return redirect('teacher/' . $donation['rel_id'])->withSuccess(trans('admin.donation_suc'));
                } elseif ($donation['category'] == 'projects' && $donation['rel_id'] > 0) {
                    return redirect('project/' . $donation['rel_id'])->withSuccess(trans('admin.donation_suc'));
                } else {
                    return redirect('/')->withSuccess(trans('admin.donation_suc'));
                }
            } else {
                if ($donation['category'] == 'childern') {
                    return redirect('child/' . $donation['rel_id'] . '?type=gift')->withSuccess(trans('admin.donation_suc'));
                } elseif ($donation['category'] == 'families') {
                    return redirect('family/' . $donation['rel_id'] . '?type=gift')->withSuccess(trans('admin.donation_suc'));
                } elseif ($donation['category'] == 'teachers') {
                    return redirect('teacher/' . $donation['rel_id'] . '?type=gift')->withSuccess(trans('admin.donation_suc'));
                }
            }
        } else {
            if ($donation['gift_id'] == 0) {
                if ($donation['category'] == 'childern' && $donation['rel_id'] > 0) {
                    return redirect('child/' . $donation['rel_id'])->withError(trans('admin.donation_error'));
                } elseif ($donation['category'] == 'families' && $donation['rel_id'] > 0) {
                    return redirect('family/' . $donation['rel_id'])->withError(trans('admin.donation_error'));
                } elseif ($donation['category'] == 'teachers' && $donation['rel_id'] > 0) {
                    return redirect('teacher/' . $donation['rel_id'])->withError(trans('admin.donation_error'));
                } else {
                    return redirect('/')->withError(trans('admin.donation_error'));
                }
            } else {
                if ($donation['category'] == 'childern') {
                    return redirect('child/' . $donation['rel_id'] . '?type=gift')->withError(trans('admin.donation_error'));
                } elseif ($donation['category'] == 'families') {
                    return redirect('family/' . $donation['rel_id'] . '?type=gift')->withError(trans('admin.donation_error'));
                } elseif ($donation['category'] == 'teachers') {
                    return redirect('teacher/' . $donation['rel_id'] . '?type=gift')->withError(trans('admin.donation_error'));
                }
            }
        }
    }

    public function sponsorships() {
        return view('interface.sponsorships');
    }

    public function profile_get() {
        if (!Auth::check()) {
            return redirect('/')->withError(trans('admin.login_first'));
        }
        return view('interface.profile');
    }

    public function profile_post(UpdateProfile $request) {
        $user = \App\Models\User::find(Auth::User()->id);
        $user->email = $request['email'];
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->country_id = $request['country_id'];
        $user->phone = $request['phone'];
        $user->whatsapp = $request['whatsapp'];
        $user->governate = $request['governate'];
        $user->city = $request['city'];
        $user->street = $request['street'];
        if ($request['password'] != '') {
            $user->password = Hash::make($request['password']);
        }
        $user->save();

        return back()->withSuccess(trans('admin.edit_suc'));
    }

    public function my_childern() {
        if (!Auth::check()) {
            return redirect('/')->withError(trans('admin.login_first'));
        }

        $user_id = Auth::User()->id;
        $childern = \App\Models\Child::orderBy('id', 'desc')->whereExists(function ($query) use ($user_id) {
                    $query->select(\DB::raw(1))->where('donations.active', '!=', 'unpaid')->where('donations.category', 'childern')->where('donations.user_type', 'user')->where('donations.user_id', $user_id)->where('donations.gift_id', 0)
                            ->from('donations')
                            ->whereRaw('donations.rel_id = childern.id');
                })->get();
        return view('interface.my_childern', ['childern' => $childern]);
    }

    public function my_families() {
        if (!Auth::check()) {
            return redirect('/')->withError(trans('admin.login_first'));
        }

        $user_id = Auth::User()->id;
        $families = \App\Models\Family::orderBy('id', 'desc')->whereExists(function ($query) use ($user_id) {
                    $query->select(\DB::raw(1))->where('donations.active', '!=', 'unpaid')->where('donations.category', 'families')->where('donations.user_type', 'user')->where('donations.user_id', $user_id)->where('donations.gift_id', 0)
                            ->from('donations')
                            ->whereRaw('donations.rel_id = families.id');
                })->get();
        return view('interface.my_families', ['families' => $families]);
    }

    public function my_teachers() {
        if (!Auth::check()) {
            return redirect('/')->withError(trans('admin.login_first'));
        }

        $user_id = Auth::User()->id;
        $teachers = \App\Models\Teacher::orderBy('id', 'desc')->whereExists(function ($query) use ($user_id) {
                    $query->select(\DB::raw(1))->where('donations.active', '!=', 'unpaid')->where('donations.category', 'teachers')->where('donations.user_type', 'user')->where('donations.user_id', $user_id)->where('donations.gift_id', 0)
                            ->from('donations')
                            ->whereRaw('donations.rel_id = teachers.id');
                })->get();
        return view('interface.my_teachers', ['teachers' => $teachers]);
    }

    public function pay($id) {
        $lang = Config::get('app.locale');
        $donation = \App\Models\Donation::find($id);

        $payment['amount'] = $donation['amount'];
        $payment['currency'] = $donation['en_currency'];
        if ($donation['category'] == 'childern') {
            $payment['description'] = $donation['Child'][$lang . '_name'];
        } elseif ($donation['category'] == 'families') {
            $payment['description'] = $donation['Family'][$lang . '_name'];
        } elseif ($donation['category'] == 'techers') {
            $payment['description'] = $donation['Teacher'][$lang . '_name'];
        }
        $payment['reference']['transaction'] = $donation->id;
        $payment['reference']['order'] = $donation->id;
        $payment['customer']['first_name'] = Auth::User()->name;
        $payment['customer']['middle_name'] = '';
        $payment['customer']['last_name'] = '';
        $payment['customer']['email'] = Auth::User()->email;
        $payment['customer']['phone']['country_code'] = Auth::User()->Country->code;
        $payment['customer']['phone']['number'] = Auth::User()->phone;
        $payment['source']['id'] = 'src_all';
        $payment['redirect']['url'] = url('payment_result');

        $url = Payment::get_url($payment);
        return redirect($url);
    }

    public function donation_edit($active, $id) {
        $donation = \App\Models\Donation::find($id);
        $donation->active = $active;
        $donation->save();

        return back()->withSuccess(trans('admin.edit_suc'));
    }

    public function calculator() {
        return view('interface.calculator');
    }

    public function projects() {
        $categories = \App\Models\Category::where('active', 'yes')->get();
        return view('interface.projects', ['categories' => $categories]);
    }

    public function category($id) {
        $lang = Config::get('app.locale');
        $request = request()->all();
        $category = \App\Models\Category::find($id);

        $countries = \App\Models\Country::where('active', 'yes')->orderBy($lang . '_name', 'desc')->whereExists(function ($query) {
                    $query->select(\DB::raw(1))->where('projects.active', 'yes')->where('projects.type', 'public')
                            ->from('projects')
                            ->whereRaw('projects.country_id = countries.id');
                })->pluck($lang . '_name', 'id')->toArray();
        $countries = Arr::add($countries, '', trans('admin.choose'));
        $countries = array_reverse($countries, TRUE);

        $projects = \App\Models\Project::where('category_id', $id)->where('active', 'yes')->where('type', 'public')->orderBy('id', 'desc');
        if (isset($request['country']) && $request['country'] != '') {
            $projects = $projects->where('country_id', $request['country']);
        }
        if (isset($request['required']) && $request['required'] == 'yes') {
            $projects = $projects->where('required', 'yes');
        }
        $projects = $projects->get();

        return view('interface.category', ['category' => $category, 'countries' => $countries, 'projects' => $projects]);
    }

    public function project($id) {
        $project = \App\Models\Project::find($id);
        return view('interface.project', ['project' => $project]);
    }

    public function my_projects_donations() {
        if (!Auth::check()) {
            return redirect('/')->withError(trans('admin.login_first'));
        }
        $donations = \App\Models\Donation::where('category', 'projects')->where('active', '!=', 'unpaid')->where('user_type', 'user')->where('user_id', Auth::User()->id)->orderBy('id', 'desc')->get();
        return view('interface.my_projects_donations', ['donations' => $donations]);
    }

    public function my_projects() {
        if (!Auth::check()) {
            return redirect('/')->withError(trans('admin.login_first'));
        }
        $projects = \App\Models\Project::where('user_id', Auth::User()->id)->orderBy('id', 'desc')->get();

        return view('interface.my_projects', ['projects' => $projects]);
    }

    public function project_add_get() {
        if (!Auth::check()) {
            return redirect('/')->withError(trans('admin.login_first'));
        }
        $lang = Config::get('app.locale');

        $countries = \App\Models\Country::where('active', 'yes')->orderBy($lang . '_name', 'desc')->pluck($lang . '_name', 'id')->toArray();
        $countries = Arr::add($countries, '', trans('admin.choose'));
        $countries = array_reverse($countries, TRUE);

        $categories = \App\Models\Category::where('active', 'yes')->orderBy($lang . '_name', 'asc')->pluck($lang . '_name', 'id')->toArray();
        $categories = Arr::add($categories, '', trans('admin.choose_category'));
        $categories = array_reverse($categories, TRUE);

        return view('interface.project_add', ['countries' => $countries, 'categories' => $categories]);
    }

    public function project_add_post(StoreProjectIntro $request) {
        $currency_info = \App\Models\Currency::find(Session::get('currency'));

        $destinationPath = public_path('upload/projects/');
        $file = $request['image'];
        $filename = Str::random(5) . '.' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $new_project = new \App\Models\Project();
        $new_project->user_id = Auth::User()->id;
        $new_project->country_id = $request['country_id'];
        $new_project->category_id = $request['category_id'];
        $new_project->ar_name = $request['name'];
        $new_project->en_name = $request['name'];
        $new_project->ar_desc = $request['desc'];
        $new_project->en_desc = $request['desc'];
        $new_project->amount = $request['amount'] * $currency_info['equal'];
        $new_project->collect = $request['collect'] * $currency_info['equal'];
        $new_project->image = $filename;
        $new_project->active = 'yet';
        $new_project->type = 'private';
        $new_project->save();

        return back()->withSuccess(trans('admin.add_suc'));
    }

    public function donate() {
        $request = request()->all();
        $validator = Validator::make($request, [
                    "amount" => "required|numeric",
                    "category" => "required",
                    "type" => "required",
        ]);

        if ($validator->fails()) {
            $message = "";
            foreach ($validator->errors()->all() as $one_error) {
                if ($message == "") {
                    $message = $one_error;
                } else {
                    $message = $message . ' , ' . $one_error;
                }
            }
            return back()->withError($message);
        } else {
            $currency_info = \App\Models\Currency::find(Session::get('currency'));

            $new_donation = new \App\Models\Donation();
            $new_donation->rel_id = 0;
            $new_donation->ar_currency = $currency_info['ar_currency'];
            $new_donation->en_currency = $currency_info['en_currency'];
            $new_donation->format = $currency_info['currency_format'];
            $new_donation->amount = $request['amount'];
            $new_donation->category = $request['category'];
            $new_donation->type = $request['type'];
            $new_donation->pay_type = 'knet';
            $new_donation->active = 'unpaid';
            if ($request['type'] == 'always') {
                if (date('d') < 29) {
                    $new_donation->day = date('d');
                } else {
                    $new_donation->day = 28;
                }
            }
            $new_donation->user_id = Auth::User()->id;
            $new_donation->user_type = 'user';
            $new_donation->save();

            $name = Auth::User()->name;
            $email = Auth::User()->email;
            $phone = Auth::User()->phone;
            $code = Auth::User()->Country->Code;

            $donation = \App\Models\Donation::find($new_donation->id);
            $payment['amount'] = $donation['amount'];
            $payment['currency'] = $currency_info['currency'];
            $payment['description'] = trans('admin.donate');
            $payment['reference']['transaction'] = $donation->id;
            $payment['reference']['order'] = $donation->id;
            $payment['customer']['first_name'] = $name;
            $payment['customer']['middle_name'] = '';
            $payment['customer']['last_name'] = '';
            $payment['customer']['email'] = $email;
            $payment['customer']['phone']['country_code'] = $code;
            $payment['customer']['phone']['number'] = $phone;
            $payment['source']['id'] = 'src_all';
            $payment['redirect']['url'] = url('payment_result');

            $url = Payment::get_url($payment);
            return redirect($url);
        }
    }

    public function delayed_donations() {
        if (!Auth::check()) {
            return redirect('/')->withError(trans('admin.login_first'));
        }
        $donations = \App\Models\Donation::where('active', 'yet')->where('user_type', 'user')->where('user_id', Auth::User()->id)->orderBy('id', 'desc')->get();
        return view('interface.delayed_donations', ['donations' => $donations]);
    }

}

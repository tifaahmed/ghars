<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use URL;
use Mail;
use App\Http\Library\Payments;
use App\Http\Library\PushNotifications;

class ApiController extends Controller {

//
    public function __construct(Request $request) {
        app()->setLocale($request->header('Lang'));
        $this->lang = $request->header('Lang');
        $this->platform = $request->header('Platform');
        $this->firebase_token = $request->header('FirebaseToken');
        $this->token = $request->header('Auth');
        $this->currency = \App\Models\Currency::find($request->header('Currency'));
        $this->user_id = 0;

        if ($this->token != "") {
            $user = \App\Models\User::where('token', $this->token)->first();
            if ($user) {
                $this->user_id = $user->id;
                Auth::login($user);
            }
        }

        if ($this->firebase_token != "" && \App\Models\ApiKey::where('key', $this->firebase_token)->count() == 0) {
            $new = new \App\Models\ApiKey();
            $new->user_id = $this->user_id;
            $new->platform = $this->platform;
            $new->key = $this->firebase_token;
            $new->lang = $this->lang;
            $new->save();
        } elseif ($this->firebase_token != "" && \App\Models\ApiKey::where('key', $this->firebase_token)->count() > 0) {
            $new = \App\Models\ApiKey::where('key', $this->firebase_token)->first();
            $new->user_id = $this->user_id;
            $new->lang = $this->lang;
            $new->save();
        }
    }

    public function app_setting() {
        $site = \App\Models\Site::first();
        $setting['fixing'] = 'no';
        $setting['version'] = $site[$this->platform . '_version'];
        $setting['ads'] = \App\Models\Ads::where('active', 'yes')->where('type', 'app')->count();
        $setting['tutorials'] = \App\Models\Tutorial::where('active', 'yes')->count();

        $one_ads = \App\Models\Ads::where('active', 'yes')->where('type', 'app')->inRandomOrder()->first();
        if ($one_ads) {
            $ads['name'] = $one_ads[$this->lang . '_name'];
            $ads['image'] = url('upload/ads/' . $one_ads['image']);
            $ads['link'] = $one_ads['link'];
        } else {
            $ads = (object) [];
        }

        $response['status'] = 1;
        $response['message'] = trans('api.app_setting');
        $response['data'] = ['setting' => $setting, 'ads' => $ads];
        return Response()->json($response);
    }

    public function currencies() {
        if (!$this->currency) {
            $currency_id = 1;
        } else {
            $currency_id = request()->header('Currency');
        }

        $currencies = [];
        $all_currencies = \App\Models\Currency::where('active', 'yes')->orderBy('sort', 'asc')->get();
        foreach ($all_currencies as $one_currency) {
            $currency['id'] = $one_currency['id'];
            $currency['name'] = $one_currency[$this->lang . '_name'] . ' - ' . $one_currency[$this->lang . '_currency'];
            $currency['image'] = url('upload/currencies/' . $one_currency['image']);
            $currency['selected'] = 'no';
            if ($one_currency['id'] == $currency_id) {
                $currency['selected'] = 'yes';
            }
            array_push($currencies, $currency);
        }

        $response['status'] = 1;
        $response['message'] = trans('admin.currencies');
        $response['data'] = $currencies;
        return Response()->json($response);
    }

    public function ads() {
        $one_ads = \App\Models\Ads::where('active', 'yes')->where('type', 'app')->inRandomOrder()->first();
        if ($one_ads) {
            $ads['name'] = $one_ads[$this->lang . '_name'];
            $ads['image'] = url('upload/ads/' . $one_ads['image']);
            $ads['link'] = $one_ads['link'];
        } else {
            $ads = (object) [];
        }

        $response['status'] = 1;
        $response['message'] = trans('admin.ads');
        $response['data'] = $ads;
        return Response()->json($response);
    }

    public function tutorials() {
        $one_tutorial = \App\Models\Tutorial::where('active', 'yes')->orderBy('sort', 'asc')->inRandomOrder()->first();
        if ($one_tutorial) {
            $tutorial['id'] = $one_tutorial['id'];
            $tutorial['name'] = $one_tutorial[$this->lang . '_name'];
            $tutorial['desc'] = $one_tutorial[$this->lang . '_desc'];
            $tutorial['image'] = url('upload/tutorials/' . $one_tutorial['image']);
        } else {
            $tutorial = [];
        }

        $response['status'] = 1;
        $response['message'] = trans('admin.tutorials');
        $response['data'] = $tutorial;
        return Response()->json($response);
    }

    public function login() {
        $request = request()->all();
        $validator = Validator::make($request, [
                    "email" => "required",
                    "password" => "required"
        ]);

        if ($validator->fails()) {
            return Response()->json(['status' => 0, 'message' => trans('api.wrong_login')], 401);
        } else {
            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'deleted_at' => null], FALSE)) {
                $active = Auth::user()->active;
                if ($active == 'yes') {
                    if (Auth::User()->token == "") {
                        $user_edit = \App\Models\User::find(Auth::User()->id);
                        $user_edit->token = Hash::make($user_edit['email']);
                        $user_edit->save();
                    }

                    if ($this->firebase_token && $this->platform) {
                        $found = \App\Models\ApiKey::where('key', $this->firebase_token)->where('platform', $this->platform)->first();
                        if ($found) {
                            $found->user_id = Auth::User()->id;
                            $found->lang = $this->lang;
                            $found->save();
                        } else {
                            $new_key = new \App\Models\ApiKey();
                            $new_key->user_id = Auth::User()->id;
                            $new_key->platform = $this->platform;
                            $new_key->key = $this->firebase_token;
                            $new_key->lang = $this->lang;
                            $new_key->save();
                        }
                    }


                    $user_data = \App\Models\User::find(Auth::User()->id);
                    $user['id'] = $user_data['id'];
                    $user['code'] = $user_data['country_id'];
                    $user['name'] = $user_data['name'];
                    $user['email'] = $user_data['email'];
                    $user['phone'] = $user_data['phone'];
                    $user['whatsapp'] = $user_data['whatsapp'];
                    $user['governate'] = $user_data['governate'];
                    $user['city'] = $user_data['city'];
                    $user['street'] = $user_data['street'];
                    $user['authorization'] = $user_data['token'];

                    $status = 1;
                    $message = trans('api.suc_login');
                } else {
                    Auth::logout();
                    return Response()->json(['status' => 0, 'message' => trans('api.not_allow')], 401);
                }
            } else {
                return Response()->json(['status' => 0, 'message' => trans('api.wrong_login')], 401);
            }
        }
        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = $user;
        return Response()->json($response);
    }

    public function register_get() {
        $countries = [];
        $all_countries = \App\Models\Country::where('active', 'yes')->orderBy('code', 'asc')->get();
        foreach ($all_countries as $one_country) {
            $country['id'] = $one_country['id'];
            $country['code'] = $one_country['code'];
            array_push($countries, $country);
        }

        $response['status'] = 1;
        $response['message'] = trans('admin.register');
        $response['data'] = $countries;
        return Response()->json($response);
    }

    public function register_post() {
        $request = request()->all();
        $validator = Validator::make($request, [
                    "email" => "required|email|unique:users,email,null,id,deleted_at,NULL",
                    "name" => "required|unique:users,name,null,id,deleted_at,NULL",
                    "code" => "required",
                    "phone" => "required|string|unique:users,phone,null,id,deleted_at,NULL",
                    "password" => "required",
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
            return Response()->json(['status' => 0, 'message' => $message], 422);
        } else {
            $new = new \App\Models\User();
            $new->name = $request['name'];
            $new->email = $request['email'];
            $new->phone = $request['phone'];
            $new->password = Hash::make($request['password']);
            $new->token = Hash::make($request['email']);
            $new->country_id = $request['code'];
            $new->whatsapp = $request['whatsapp'];
            $new->governate = $request['governate'];
            $new->city = $request['city'];
            $new->street = $request['street'];
            $new->type = 'user';
            $new->active = 'yes';
            $new->save();

            if ($this->firebase_token && $this->platform) {
                $found = \App\Models\ApiKey::where('key', $this->firebase_token)->where('platform', $this->platform)->first();
                if ($found) {
                    $found->user_id = $new->id;
                    $found->lang = $this->lang;
                    $found->save();
                } else {
                    $new_key = new \App\Models\ApiKey();
                    $new_key->user_id = $new->id;
                    $new_key->platform = $this->platform;
                    $new_key->key = $this->firebase_token;
                    $new_key->lang = $this->lang;
                    $new_key->save();
                }
            }

            $one_user = \App\Models\User::find($new->id);
            $user['id'] = $one_user['id'];
            $user['code'] = $one_user['country_id'];
            $user['name'] = $one_user['name'];
            $user['email'] = $one_user['email'];
            $user['phone'] = $one_user['phone'];
            $user['whatsapp'] = $one_user['whatsapp'];
            $user['governate'] = $one_user['governate'];
            $user['city'] = $one_user['city'];
            $user['street'] = $one_user['street'];
            $user['authorization'] = $one_user['token'];

            $status = 1;
            $message = trans('api.suc_register');
        }

        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = $user;

        return Response()->json($response);
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
            return Response()->json(['status' => 0, 'message' => $message], 422);
        } else {
            $user_email = \App\Models\User::where('email', $request['email'])->where('active', '!=', 'delete')->first();
            if ($user_email) {
                \App\Models\PasswordReset::where('email', $request['email'])->delete();

                $random = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(24 / strlen($x)))), 1, 24);
                $PasswordReset = new \App\Models\PasswordReset();
                $PasswordReset->email = $request['email'];
                $PasswordReset->token = $random . strtotime(now());
                $PasswordReset->save();

                $status = 1;
                $message = trans('admin.suc_reset');
            } else {
                $message = trans('api.no_user');
                return Response()->json(['status' => 0, 'message' => $message], 422);
            }
        }
        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = (object) [];

        return Response()->json($response);
    }

    public function home_screen() {
        $slider = [];
        $all_slider = \App\Models\Slider::where('active', 'yes')->orderBy('sort', 'asc')->take(5)->get();
        foreach ($all_slider as $one_slider) {
            $one['id'] = $one_slider['id'];
            $one['name'] = $one_slider[$this->lang . '_name'];
            $one['image'] = url('upload/slider/' . $one_slider['image']);
            $one['link'] = $one_slider['link'];
            array_push($slider, $one);
        }

        $categories = [];
        $all_categories = \App\Models\Category::where('active', 'yes')->get();
        foreach ($all_categories as $one_category) {
            $category['id'] = $one_category['id'];
            $category['name'] = $one_category[$this->lang . '_name'];
            $category['image'] = url('upload/categories/' . $one_category['image']);
            array_push($categories, $category);
        }

        $site = \App\Models\Site::first();
        $sponsorships = [
            ['type' => 'childern', 'name' => trans('admin.childern'), 'image' => url('upload/site/' . $site['childern'])],
            ['type' => 'families', 'name' => trans('admin.families'), 'image' => url('upload/site/' . $site['families'])],
            ['type' => 'teachers', 'name' => trans('admin.teachers'), 'image' => url('upload/site/' . $site['teachers'])]
        ];

        $required_sponsorships = [];
        $all_childern = \App\Models\Child::where('active', 'yes')->where('required', 'yes')->orderBy('id', 'desc')->get();
        $all_families = \App\Models\Family::where('active', 'yes')->where('required', 'yes')->orderBy('id', 'desc')->get();
        $all_teachers = \App\Models\Teacher::where('active', 'yes')->where('required', 'yes')->orderBy('id', 'desc')->get();

        foreach ($all_childern as $one_child) {
            $sponsorship['id'] = $one_child['id'];
            $sponsorship['type'] = 'childern';
            $sponsorship['name'] = $one_child[$this->lang . '_name'];
            $sponsorship['gender'] = trans('admin.' . $one_child['gender']);
            $sponsorship['country'] = $one_child['Country'][$this->lang . '_name'];
            $sponsorship['image'] = url('upload/childern/' . $one_child['image']);
            $sponsorship['amount'] = number_format($one_child['amount'] / $this->currency->equal, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            $date1 = $one_child['birth_date'];
            $date2 = date('Y-m-d');
            $diff = abs(strtotime($date2) - strtotime($date1));
            $sponsorship['birth_date'] = floor($diff / (365 * 60 * 60 * 24)) . ' ' . trans('admin.years');

            array_push($required_sponsorships, $sponsorship);
        }

        foreach ($all_families as $one_family) {
            $sponsorship['id'] = $one_family['id'];
            $sponsorship['type'] = 'families';
            $sponsorship['name'] = $one_family[$this->lang . '_name'];
            $sponsorship['gender'] = trans('admin.' . $one_family['gender']);
            $sponsorship['country'] = $one_family['Country'][$this->lang . '_name'];
            $sponsorship['image'] = url('upload/families' . $one_family['image']);
            $sponsorship['amount'] = number_format($one_family['amount'] / $this->currency->equal, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            $sponsorship['birth_date'] = trans('admin.members_count') . ' : ' . $one_family['members_count'];

            array_push($required_sponsorships, $sponsorship);
        }

        foreach ($all_teachers as $one_teacher) {
            $sponsorship['id'] = $one_teacher['id'];
            $sponsorship['type'] = 'teachers';
            $sponsorship['name'] = $one_teacher[$this->lang . '_name'];
            $sponsorship['gender'] = trans('admin.' . $one_teacher['gender']);
            $sponsorship['country'] = $one_teacher['Country'][$this->lang . '_name'];
            $sponsorship['image'] = url('upload/teachers/' . $one_teacher['image']);
            $sponsorship['amount'] = number_format($one_teacher['amount'] / $this->currency->equal, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            $date1 = $one_teacher['birth_date'];
            $date2 = date('Y-m-d');
            $diff = abs(strtotime($date2) - strtotime($date1));
            $sponsorship['birth_date'] = floor($diff / (365 * 60 * 60 * 24)) . ' ' . trans('admin.years');

            array_push($required_sponsorships, $sponsorship);
        }

        $response['status'] = 1;
        $response['message'] = trans('api.home_screen');
        $response['data'] = ['slider' => $slider, 'categories' => $categories, 'sponsorships' => $sponsorships, 'required_sponsorships' => $required_sponsorships];

        return Response()->json($response);
    }

    public function sponsorships() {
        $request = request()->all();

        $gender = [
            ['id' => 'male', 'name' => trans('admin.male')],
            ['id' => 'female', 'name' => trans('admin.female')],
        ];
        $countries = \App\Models\Country::where('active', 'yes')->orderBy($this->lang . '_name', 'asc')->select('id', $this->lang . '_name as name')->get();

        if ($request['type'] == 'childern') {
            $ages = [
                ['id' => '5', 'name' => trans('admin.age_5')],
                ['id' => '10', 'name' => trans('admin.age_10')],
                ['id' => '15', 'name' => trans('admin.age_15')],
                ['id' => '20', 'name' => trans('admin.age_20')]
            ];

            $all_sponsorships = \App\Models\Child::where('active', 'yes')->orderBy('id', 'desc');
        } elseif ($request['type'] == 'teachers') {
            $ages = [
                ['id' => '20', 'name' => trans('admin.age_20')],
                ['id' => '25', 'name' => trans('admin.age_25')],
                ['id' => '30', 'name' => trans('admin.age_30')],
                ['id' => '35', 'name' => trans('admin.age_35')],
                ['id' => '40', 'name' => trans('admin.age_40')],
                ['id' => '45', 'name' => trans('admin.age_45')],
                ['id' => '50', 'name' => trans('admin.age_50')],
                ['id' => '55', 'name' => trans('admin.age_55')],
                ['id' => '60', 'name' => trans('admin.age_60')]
            ];
        } else {
            $ages = [
                ['id' => '1', 'name' => trans('admin.member_1')],
                ['id' => '2', 'name' => trans('admin.member_2')],
                ['id' => '3', 'name' => trans('admin.member_3')],
                ['id' => '4', 'name' => trans('admin.member_4')],
                ['id' => '5', 'name' => trans('admin.member_5')],
                ['id' => '6', 'name' => trans('admin.member_6')],
                ['id' => '7', 'name' => trans('admin.member_7')],
                ['id' => '8', 'name' => trans('admin.member_8')],
            ];
        }
        if (isset($request['gender']) && $request['gender'] != '') {
            $all_sponsorships = $all_sponsorships->where('gender', $request['gender']);
        }
        if (isset($request['country']) && $request['country'] != '') {
            $all_sponsorships = $all_sponsorships->where('country_id', $request['country']);
        }
        if (isset($request['required']) && $request['required'] == 'yes') {
            $all_sponsorships = $all_sponsorships->where('required', 'yes');
        }
        if (isset($request['age']) && $request['age'] != '') {
            if ($request['type'] != 'families') {
                $start = $request['age'] - 5;
                $start_date = date("Y-m-d", strtotime("-" . $request['age'] . " year"));
                $end_date = date("Y-m-d", strtotime("-" . $start . " year"));
                $all_sponsorships = $all_sponsorships->where('birth_date', '>=', $start_date)->where('birth_date', '<', $end_date);
            } else {
                $all_sponsorships = $all_sponsorships->where('members_count', $request['age']);
            }
        }
        $all_sponsorships = $all_sponsorships->get();

        $sponsorships = [];
        foreach ($all_sponsorships as $one_sponsorship) {
            $sponsorship['id'] = $one_sponsorship['id'];
            $sponsorship['type'] = $request['type'];
            $sponsorship['name'] = $one_sponsorship[$this->lang . '_name'];
            $sponsorship['gender'] = trans('admin.' . $one_sponsorship['gender']);
            $sponsorship['country'] = $one_sponsorship['Country'][$this->lang . '_name'];
            $sponsorship['image'] = url('upload/' . $request['type'] . '/' . $one_sponsorship['image']);
            $sponsorship['amount'] = number_format($one_sponsorship['amount'] / $this->currency->equal, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            if ($request['type'] != 'families') {
                $date1 = $one_sponsorship['birth_date'];
                $date2 = date('Y-m-d');

                $diff = abs(strtotime($date2) - strtotime($date1));
                $sponsorship['birth_date'] = floor($diff / (365 * 60 * 60 * 24)) . ' ' . trans('admin.years');
            } else {
                $sponsorship['birth_date'] = trans('admin.members_count') . ' : ' . $one_sponsorship['members_count'];
            }

            array_push($sponsorships, $sponsorship);
        }

        $response['status'] = 1;
        $response['message'] = trans('admin.' . $request['type']);
        $response['data'] = ['gender' => $gender, 'countries' => $countries, 'ages' => $ages, 'sponsorships' => $sponsorships];

        return Response()->json($response);
    }

    public function sponsorship($id) {
        $type = request()->get('type');
        if ($type == 'childern') {
            $one_sponsorship = \App\Models\Child::find($id);
            $study_report = '';
            if ($one_sponsorship['study_report'] != '') {
                $study_report = url('upload/childern/' . $one_sponsorship['study_report']);
            }

            $tab_1 = [
                'name' => trans('admin.sponsorship_info'),
                'data' => [
                    ['type' => 'image', 'key' => '', 'value' => url('upload/childern/' . $one_sponsorship['image'])],
                    ['type' => 'text', 'key' => trans('admin.name'), 'value' => $one_sponsorship[$this->lang . '_name']],
                    ['type' => 'text', 'key' => trans('admin.birth_date'), 'value' => $one_sponsorship['birth_date']],
                    ['type' => 'text', 'key' => trans('admin.birth_no'), 'value' => $one_sponsorship['birth_no']],
                    ['type' => 'text', 'key' => trans('admin.gender'), 'value' => trans('admin.' . $one_sponsorship['gender'])],
                    ['type' => 'text', 'key' => trans('admin.country'), 'value' => $one_sponsorship['Country'][$this->lang . '_name']],
                    ['type' => 'text', 'key' => trans('admin.governate'), 'value' => $one_sponsorship[$this->lang . '_governate']],
                    ['type' => 'text', 'key' => trans('admin.city'), 'value' => $one_sponsorship[$this->lang . '_city']]
                ]
            ];
            $tab_2 = [
                'name' => trans('admin.sponsorship_study'),
                'data' => [
                    ['type' => 'text', 'key' => trans('admin.study_stage'), 'value' => $one_sponsorship[$this->lang . '_study_stage']],
                    ['type' => 'text', 'key' => trans('admin.class'), 'value' => $one_sponsorship[$this->lang . '_class']],
                    ['type' => 'text', 'key' => trans('admin.quran'), 'value' => $one_sponsorship[$this->lang . '_quran']],
                    ['type' => 'textarea', 'key' => trans('admin.skills'), 'value' => $one_sponsorship[$this->lang . '_skills']],
                    ['type' => 'link', 'key' => trans('admin.study_report'), 'value' => $study_report]
                ]
            ];
            $tab_3 = [
                'name' => trans('admin.sponsorship_health'),
                'data' => [
                    ['type' => 'text', 'key' => trans('admin.psychological'), 'value' => $one_sponsorship[$this->lang . '_psychological']],
                    ['type' => 'text', 'key' => trans('admin.healthy'), 'value' => $one_sponsorship[$this->lang . '_healthy']],
                    ['type' => 'textarea', 'key' => trans('admin.illness'), 'value' => $one_sponsorship[$this->lang . '_illness']],
                    ['type' => 'textarea', 'key' => trans('admin.illness_desc'), 'value' => $one_sponsorship[$this->lang . '_illness_desc']]
                ]
            ];
            $tab_4 = [
                'name' => trans('admin.sponsorship_social'),
                'data' => [
                    ['type' => 'text', 'key' => trans('admin.death_date'), 'value' => $one_sponsorship['death_date']],
                    ['type' => 'text', 'key' => trans('admin.death_reason'), 'value' => $one_sponsorship[$this->lang . '_death_reason']],
                    ['type' => 'text', 'key' => trans('admin.responsible'), 'value' => $one_sponsorship[$this->lang . '_responsible']],
                    ['type' => 'text', 'key' => trans('admin.relative'), 'value' => $one_sponsorship[$this->lang . '_relative']],
                    ['type' => 'text', 'key' => trans('admin.brothers'), 'value' => $one_sponsorship['brothers']],
                    ['type' => 'text', 'key' => trans('admin.sisters'), 'value' => $one_sponsorship['sisters']],
                ]
            ];

            $sponsorship = [$tab_1, $tab_2, $tab_3, $tab_4];
            $lecutes = [];
            $members = [];
            $reports = [];
            $all_reports = \App\Models\ChildReport::where('child_id', $one_sponsorship['id'])->where('active', 'yes')->get();
            foreach ($all_reports as $one_report) {
                $report['id'] = $one_report['id'];
                $report['name'] = $one_report[$this->lang . '_name'];
                $report['file'] = url('upload/childern/' . $one_report['file']);

                array_push($reports, $report);
            }
        } elseif ($type == 'families') {
            $one_sponsorship = \App\Models\Family::find($id);

            $tab_1 = [
                'name' => trans('admin.sponsorship_info'),
                'data' => [
                    ['type' => 'image', 'key' => '', 'value' => url('upload/families/' . $one_sponsorship['image'])],
                    ['type' => 'text', 'key' => trans('admin.family_name'), 'value' => $one_sponsorship[$this->lang . '_name']],
                    ['type' => 'text', 'key' => trans('admin.gender'), 'value' => trans('admin.' . $one_sponsorship['gender'])],
                    ['type' => 'text', 'key' => trans('admin.country'), 'value' => $one_sponsorship['Country'][$this->lang . '_name']],
                    ['type' => 'text', 'key' => trans('admin.nationality'), 'value' => $one_sponsorship[$this->lang . '_nationality']],
                    ['type' => 'text', 'key' => trans('admin.civil_id'), 'value' => $one_sponsorship['civil_id']],
                    ['type' => 'text', 'key' => trans('admin.parent_status'), 'value' => $one_sponsorship[$this->lang . '_parent_status']],
                    ['type' => 'text', 'key' => trans('admin.death_date'), 'value' => $one_sponsorship['death_date']],
                    ['type' => 'text', 'key' => trans('admin.death_reason'), 'value' => $one_sponsorship[$this->lang . '_death_reason']],
                    ['type' => 'text', 'key' => trans('admin.members_count'), 'value' => $one_sponsorship['members_count']],
                    ['type' => 'text', 'key' => trans('admin.males'), 'value' => $one_sponsorship['males']],
                    ['type' => 'text', 'key' => trans('admin.females'), 'value' => $one_sponsorship['females']],
                ]
            ];
            $tab_2 = [
                'name' => trans('admin.sponsorship_social'),
                'data' => [
                    ['type' => 'text', 'key' => trans('admin.responsible'), 'value' => $one_sponsorship[$this->lang . '_responsible']],
                    ['type' => 'text', 'key' => trans('admin.relative'), 'value' => $one_sponsorship[$this->lang . '_relative']],
                    ['type' => 'text', 'key' => trans('admin.responsible_civil_id'), 'value' => $one_sponsorship['responsible_civil_id']],
                    ['type' => 'text', 'key' => trans('admin.career_status'), 'value' => $one_sponsorship[$this->lang . '_career_status']],
                    ['type' => 'text', 'key' => trans('admin.career'), 'value' => $one_sponsorship[$this->lang . '_career']]
                ]
            ];

            $sponsorship = [$tab_1, $tab_2];
            $lecutes = [];

            $members = [];
            $all_members = \App\Models\FamilyMember::where('family_id', $one_sponsorship['id'])->where('active', 'yes')->get();
            foreach ($all_members as $one_member) {
                $member['id'] = $one_member['id'];
                $member['name'] = $one_member[$this->lang . '_name'];
                $member['birth_date'] = $one_member['birth_date'];
                $member['gender'] = trans('admin.' . $one_member['gender']);
                $member['civil_id_type'] = $one_member[$this->lang . '_civil_type'];
                $member['civil_id'] = $one_member['civil_id'];
                $member['career_status'] = $one_member[$this->lang . '_career_status'];
                $member['class'] = $one_member[$this->lang . '_class'];
                $member['healthy'] = $one_member[$this->lang . '_healthy'];
                $member['psychological'] = $one_member[$this->lang . '_psychological'];
                $member['image'] = url('upload/families_members/' . $one_member['image']);

                array_push($members, $member);
            }

            $reports = [];
            $all_reports = \App\Models\FamilyReport::where('family_id', $one_sponsorship['id'])->where('active', 'yes')->get();
            foreach ($all_reports as $one_report) {
                $report['id'] = $one_report['id'];
                $report['name'] = $one_report[$this->lang . '_name'];
                $report['file'] = url('upload/families/' . $one_report['file']);

                array_push($reports, $report);
            }
        } elseif ($type == 'teachers') {
            $one_sponsorship = \App\Models\Teacher::find($id);

            $tab_1 = [
                'name' => trans('admin.sponsorship_info'),
                'data' => [
                    ['type' => 'image', 'key' => '', 'value' => url('upload/teachers/' . $one_sponsorship['image'])],
                    ['type' => 'text', 'key' => trans('admin.name'), 'value' => $one_sponsorship[$this->lang . '_name']],
                    ['type' => 'text', 'key' => trans('admin.gender'), 'value' => trans('admin.' . $one_sponsorship['gender'])],
                    ['type' => 'text', 'key' => trans('admin.country'), 'value' => $one_sponsorship['Country'][$this->lang . '_name']],
                    ['type' => 'text', 'key' => trans('admin.nationality'), 'value' => $one_sponsorship[$this->lang . '_nationality']],
                    ['type' => 'text', 'key' => trans('admin.birth_date'), 'value' => $one_sponsorship['birth_date']],
                    ['type' => 'text', 'key' => trans('admin.address'), 'value' => $one_sponsorship[$this->lang . '_address']],
                    ['type' => 'text', 'key' => trans('admin.social_status'), 'value' => $one_sponsorship[$this->lang . '_status']],
                    ['type' => 'text', 'key' => trans('admin.phone'), 'value' => $one_sponsorship['phone']],
                    ['type' => 'text', 'key' => trans('admin.email'), 'value' => $one_sponsorship['email']]
                ]
            ];
            $tab_2 = [
                'name' => trans('admin.sponsorship_qualifications'),
                'data' => [
                    ['type' => 'text', 'key' => trans('admin.qualification'), 'value' => $one_sponsorship[$this->lang . '_qualification']],
                    ['type' => 'text', 'key' => trans('admin.qualification_source'), 'value' => $one_sponsorship[$this->lang . '_qualification_source']],
                    ['type' => 'link', 'key' => trans('admin.qualification_date'), 'value' => $one_sponsorship['qualification_date']],
                    ['type' => 'text', 'key' => trans('admin.specialization'), 'value' => $one_sponsorship[$this->lang . '_specialization']],
                    ['type' => 'text', 'key' => trans('admin.career'), 'value' => $one_sponsorship[$this->lang . '_career']],
                    ['type' => 'text', 'key' => trans('admin.invitation'), 'value' => $one_sponsorship[$this->lang . '_invitation']],
                    ['type' => 'text', 'key' => trans('admin.social_activity'), 'value' => $one_sponsorship[$this->lang . '_social']],
                    ['type' => 'text', 'key' => trans('admin.quran'), 'value' => $one_sponsorship[$this->lang . '_quran']],
                    ['type' => 'textarea', 'key' => trans('admin.skills'), 'value' => $one_sponsorship[$this->lang . '_skills']]
                ]
            ];
            $tab_3 = [
                'name' => trans('admin.sponsorship_oranization'),
                'data' => [
                    ['type' => 'text', 'key' => trans('admin.country'), 'value' => $one_sponsorship['ResponsibleCountry'][$this->lang . '_name']],
                    ['type' => 'text', 'key' => trans('admin.responsible_address'), 'value' => $one_sponsorship[$this->lang . '_responsible_address']],
                    ['type' => 'text', 'key' => trans('admin.responsible'), 'value' => $one_sponsorship[$this->lang . '_responsible']],
                    ['type' => 'text', 'key' => trans('admin.responsible_email'), 'value' => $one_sponsorship['responsible_email']],
                    ['type' => 'text', 'key' => trans('admin.responsible_phone'), 'value' => $one_sponsorship['responsible_phone']]
                ]
            ];

            $sponsorship = [$tab_1, $tab_2, $tab_3];

            $members = [];

            $lecutes = [];
            $all_lecutes = \App\Models\TeacherVideo::where('teacher_id', $one_sponsorship['id'])->where('active', 'yes')->get();
            foreach ($all_lecutes as $one_lecute) {
                $lecute['id'] = $one_lecute['id'];
                $lecute['name'] = $one_lecute[$this->lang . '_name'];
                $lecute['link'] = $one_lecute['link'];
                $lecute['image'] = url('upload/teachers_videos/' . $one_lecute['image']);

                array_push($lecutes, $lecute);
            }

            $reports = [];
            $all_reports = \App\Models\TeacherReport::where('teacher_id', $one_sponsorship['id'])->where('active', 'yes')->get();
            foreach ($all_reports as $one_report) {
                $report['id'] = $one_report['id'];
                $report['name'] = $one_report[$this->lang . '_name'];
                $report['file'] = url('upload/teachers/' . $one_report['file']);

                array_push($reports, $report);
            }
        }

        $gifts = [];
        $all_gifts = \App\Models\Gift::where('active', 'yes')->where('type', $type)->orderBy('sort', 'asc')->get();
        foreach ($all_gifts as $one_gift) {
            $gift['id'] = $one_gift['id'];
            $gift['name'] = $one_gift[$this->lang . '_name'] . ' ' . number_format($one_gift['amount'] / $this->currency->equal, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            $gift['image'] = url('upload/gifts/' . $one_gift['image']);
            array_push($gifts, $gift);
        }

        $response['status'] = 1;
        $response['message'] = $one_sponsorship[$this->lang . '_name'];
        $response['data'] = ['sponsorship' => $sponsorship, 'members' => $members, 'lecutes' => $lecutes, 'reports' => $reports, 'gifts' => $gifts];

        return Response()->json($response);
    }

    public function categories() {
        $categories = [];
        $all_categories = \App\Models\Category::where('active', 'yes')->orderBy('sort', 'asc')->get();
        foreach ($all_categories as $one_category) {
            $category['id'] = $one_category['id'];
            $category['name'] = $one_category[$this->lang . '_name'];
            $category['image'] = url('upload/categories/' . $one_category['image']);
            array_push($categories, $category);
        }

        $response['status'] = 1;
        $response['message'] = trans('admin.categories');
        $response['data'] = $categories;

        return Response()->json($response);
    }

    public function products() {
        $request = request()->all();
        $products = [];
        $all_products = \App\Models\Product::where('products.active', 'yes')->where('products_prices.currency_id', $this->currency['id'])->join('products_prices', 'products_prices.product_id', '=', 'products.id');
        if (isset($request['featured']) && $request['featured'] == 'yes') {
            $all_products = $all_products->where('products.featured', 'yes');
            $title = trans('admin.featured_products');
        }

        if (isset($request['word'])) {
            if ($request['word'] != '') {
                if (\App\Models\Search::where('key', $this->firebase_token)->where('word', $request['word'])->count() == 0) {
                    $new = new \App\Models\Search();
                    $new->key = $this->firebase_token;
                    $new->word = $request['word'];
                    $new->save();
                }
            }
            $all_products = $all_products->where('products.' . $this->lang . '_name', 'LIKE', '%' . $request['word'] . '%');
            $title = trans('admin.search');
        }

        if (isset($request['category_id']) && $request['category_id'] != '') {
            $all_products = $all_products->where('products.category_id', $request['category_id']);
            $one_category = \App\Models\Category::find($request['category_id']);
            $title = $one_category[$this->lang . '_name'];
        }

        if (isset($request['sort']) && $request['sort'] != '') {
            if ($request['sort'] == 'a_z') {
                $all_products = $all_products->orderBy('products.' . $this->lang . '_name', 'asc');
            } elseif ($request['sort'] == 'z_a') {
                $all_products = $all_products->orderBy('products.' . $this->lang . '_name', 'desc');
            } elseif ($request['sort'] == 'best_seller') {
                $all_products = $all_products->orderBy('products.sold', 'desc');
            } elseif ($request['sort'] == 'low_high') {
                $all_products = $all_products->orderBy('products_prices.price', 'asc');
            } elseif ($request['sort'] == 'high_low') {
                $all_products = $all_products->orderBy('products_prices.price', 'desc');
            } else {
                $all_products = $all_products->orderBy('products.sort', 'asc');
            }
        } else {
            $all_products = $all_products->orderBy('products.sort', 'asc');
        }
        $all_products = $all_products->paginate(10);

        foreach ($all_products as $one_product) {
            $product['id'] = $one_product['product_id'];
            $product['name'] = $one_product[$this->lang . '_name'];
            $product['favorite'] = \App\Models\Favourite::where('product_id', $one_product['product_id'])->where('user_id', $this->user_id)->count();
            $product['image'] = url('upload/products/' . $one_product['image']);
            $product['quantity'] = $one_product['quantity'];
            $product['offer'] = 'no';
            if ($one_product['Category']['offer'] > 0) {
                $product['offer'] = 'yes';
                $product['price'] = number_format($one_product['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                $product['price_offer'] = number_format($one_product['price'] - ($one_product['price'] * $one_product['Category']['offer'] / 100), $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            } elseif ($one_product['offer'] > 0) {
                $product['offer'] = 'yes';
                $product['price'] = number_format($one_product['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                $product['price_offer'] = number_format($one_product['offer'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            } else {
                $product['offer'] = 'no';
                $product['price'] = number_format($one_product['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                $product['price_offer'] = number_format($one_product['offer'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            }
            array_push($products, $product);
        }

        $info['current_page'] = $all_products->currentPage();
        $info['first_page_url'] = "";
        $info['last_page'] = $all_products->lastPage();
        $info['last_page_url'] = "";
        $info['next_page_url'] = $all_products->nextPageUrl();
        $info['path'] = $all_products->url($all_products['current_page']);
        $info['per_page'] = $all_products->perPage();
        $info['prev_page_url'] = $all_products->previousPageUrl();
        $info['to'] = $all_products->count();
        $info['total'] = $all_products->total();

        $sort = [
            ['id' => 'a_z', 'name' => trans('admin.a_z')],
            ['id' => 'z_a', 'name' => trans('admin.z_a')],
            ['id' => 'low_high', 'name' => trans('admin.low_high')],
            ['id' => 'high_low', 'name' => trans('admin.high_low')],
            ['id' => 'newest', 'name' => trans('admin.newest')],
            ['id' => 'best_seller', 'name' => trans('admin.best_seller')]
        ];

        $response['status'] = 1;
        $response['message'] = $title;
        $response['data'] = ['products' => $products, 'info' => $info, 'sort' => $sort];

        return Response()->json($response);
    }

    public function search() {
        $words = \App\Models\Search::where('key', $this->firebase_token)->orderBy('id', 'desc')->pluck('word')->toArray();

        $response['status'] = 1;
        $response['message'] = trans('admin.search');
        $response['data'] = $words;

        return Response()->json($response);
    }

    public function product($id) {
        $product_edit = \App\Models\Product::find($id);
        $product_edit->views = $product_edit->views + 1;
        $product_edit->save();

        $one_product = \App\Models\Product::find($id);
        $price = \App\Models\ProductPrice::where('currency_id', $this->currency['id'])->where('product_id', $id)->first();

        $product['id'] = $one_product['id'];
        $product['name'] = $one_product[$this->lang . '_name'];
        $product['ingredients'] = $one_product[$this->lang . '_ingredients'];
        $product['desc'] = $one_product[$this->lang . '_desc'];
        $product['favorite'] = \App\Models\Favourite::where('product_id', $one_product['id'])->where('user_id', $this->user_id)->count();
        $product['images'] = [url('upload/products/' . $one_product['image'])];
        foreach ($one_product['Images'] as $image) {
            array_push($product['images'], url('upload/products/' . $image['image']));
        }

        $product['offer'] = 'no';
        if ($one_product['Category']['offer'] > 0) {
            $product['offer'] = 'yes';
            $product['price'] = number_format($price['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            $product['price_offer'] = number_format($price['price'] - ($price['price'] * $one_product['Category']['offer'] / 100), $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        } elseif ($price['offer'] > 0) {
            $product['offer'] = 'yes';
            $product['price'] = number_format($price['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            $product['price_offer'] = number_format($price['offer'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        } else {
            $product['offer'] = 'no';
            $product['price'] = number_format($price['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        }

        $product['quantity'] = $one_product['quantity'];
        if ($one_product['purchasable_type'] == 'limited' && $one_product['quantity'] > $one_product['purchasable']) {
            $product['quantity'] = $one_product['purchasable'];
        }
        $product['link'] = url('product/' . $id);

        $response['status'] = 1;
        $response['message'] = $product['name'];
        $response['data'] = ['product' => $product];

        return Response()->json($response);
    }

    public function favorite_action($id) {
        if ($this->user_id == 0) {
            return Response()->json(['status' => 0, 'message' => trans('api.login_first')], 401);
        }

        $count = \App\Models\Favourite::where('user_id', $this->user_id)->where('product_id', $id)->count();
        if ($count == 0) {
            $new = new \App\Models\Favourite();
            $new->user_id = $this->user_id;
            $new->product_id = $id;
            $new->save();
            $message = trans('api.favourite_add');
            $suc = 1;
        } else {
            \App\Models\Favourite::where('user_id', $this->user_id)->where('product_id', $id)->delete();
            $message = trans('api.favourite_remove');
            $suc = 0;
        }

        $response['status'] = $suc;
        $response['message'] = $message;
        $response['data'] = (object) [];

        return Response()->json($response);
    }

    public function cart_add() {
        $request = request()->all();
        $product = \App\Models\Product::find($request['product_id']);

        if ($this->user_id > 0) {
            $found = \App\Models\Cart::where('user_id', $this->user_id)->where('product_id', $request['product_id'])->first();
            $user_id = $this->user_id;
            $key_id = '';
        } else {
            $found = \App\Models\Cart::where('key_id', $this->firebase_token)->where('product_id', $request['product_id'])->first();
            $user_id = '';
            $key_id = $this->firebase_token;
        }


        if ($found) {
            if ($product['purchasable_type'] == 'limited' && $found->quantity + $request['quantity'] > $product['purchasable']) {
                $status = 0;
                $message = trans('admin.purchasable_error') . ' ' . $product['purchasable'] . ' ' . trans('admin.purchasable_errorr');
            } elseif ($found->quantity + $request['quantity'] > $product['quantity']) {
                $status = 0;
                $message = trans('admin.purchasable_error') . ' ' . $product['quantity'] . ' ' . trans('admin.purchasable_errorr');
            } else {
                $found->quantity = $found->quantity + $request['quantity'];
                $found->save();

                $status = 1;
                $message = trans('admin.add_cart_suc');
            }
        } else {
            if ($product['purchasable_type'] == 'limited' && $request['quantity'] > $product['purchasable']) {
                $status = 0;
                $message = trans('admin.purchasable_error') . ' ' . $product['purchasable'] . ' ' . trans('admin.purchasable_errorr');
            } elseif ($request['quantity'] > $product['quantity']) {
                $status = 0;
                $message = trans('admin.purchasable_error') . ' ' . $product['quantity'] . ' ' . trans('admin.purchasable_errorr');
            } else {
                $new = new \App\Models\Cart();
                $new->user_id = $user_id;
                $new->key_id = $key_id;
                $new->product_id = $request['product_id'];
                $new->quantity = $request['quantity'];
                $new->save();

                $status = 1;
                $message = trans('admin.add_cart_suc');
            }
        }

        $cart_count = 0;
        if ($this->user_id > 0) {
            $all_products = \App\Models\Cart::where('user_id', $this->user_id)->get();
        } else {
            $all_products = \App\Models\Cart::where('key_id', $this->firebase_token)->where('user_id', 0)->get();
        }
        foreach ($all_products as $one_product) {
            if ($one_product['Product']['active'] == 'yes') {
                if ($one_product['Product']['purchasable_type'] == 'limited' && $one_product['quantity'] > $one_product['Product']['purchasable']) {
                    $quantity = $one_product['Product']['purchasable'];
                } elseif ($one_product['quantity'] > $one_product['Product']['quantity']) {
                    $quantity = $one_product['Product']['quantity'];
                } else {
                    $quantity = $one_product['quantity'];
                }

                $cart_count = $cart_count + $quantity;
            }
        }
        $ios_data = ['action' => 'cart', 'count' => $cart_count, 'title' => '', 'alert' => '', 'image' => ''];
        $android_data = ['action' => 'cart', 'count' => $cart_count, 'title' => '', 'message' => '', 'image' => ''];
        if ($this->user_id > 0) {
            $android_devices = \App\Models\ApiKey::where('user_id', $this->user_id)->where('platform', 'android')->pluck('key')->toArray();
            $ios_devices = \App\Models\ApiKey::where('user_id', $this->user_id)->where('platform', 'ios')->pluck('key')->toArray();
        } else {
            $android_devices = \App\Models\ApiKey::where('key', $this->firebase_token)->where('user_id', 0)->where('platform', 'android')->pluck('key')->toArray();
            $ios_devices = \App\Models\ApiKey::where('key', $this->firebase_token)->where('user_id', 0)->where('platform', 'ios')->pluck('key')->toArray();
        }

        if (count($ios_devices) > 0) {
            PushNotifications::ios($ios_devices, $ios_data, 'many');
        }
        if (count($android_devices) > 0) {
            PushNotifications::android($android_devices, $android_data, 'many');
        }

        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = ['cart_count' => $cart_count];
        return Response()->json($response);
    }

    public function cart() {
        if ($this->user_id > 0) {
            $all_products = \App\Models\Cart::where('user_id', $this->user_id)->get();
        } else {
            $all_products = \App\Models\Cart::where('key_id', $this->firebase_token)->where('user_id', 0)->get();
        }

        $products = [];
        $sub_total = 0;
        $discount = number_format(0, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        foreach ($all_products as $one_product) {
            if ($one_product['Product']['active'] == 'yes') {
                $price = \App\Models\ProductPrice::where('currency_id', $this->currency['id'])->where('product_id', $one_product['product_id'])->first();

                $product['cart_id'] = $one_product['id'];
                $product['id'] = $one_product['product_id'];
                $product['name'] = $one_product['Product'][$this->lang . '_name'];

                if ($one_product['Product']['Category']['offer'] > 0) {
                    $product['offer'] = 'yes';
                    $product['price'] = number_format($price['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product['price_offer'] = number_format($price['price'] - ($price['price'] * $one_product['Product']['Category']['offer'] / 100), $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product_price = $price['price'] - ($price['price'] * $one_product['Product']['Category']['offer'] / 100);
                } elseif ($price['offer'] > 0) {
                    $product['offer'] = 'yes';
                    $product['price'] = number_format($price['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product['price_offer'] = number_format($price['offer'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product_price = $price['offer'];
                } else {
                    $product['offer'] = 'no';
                    $product['price'] = number_format($price['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product_price = $price['price'];
                }

                if ($one_product['Product']['purchasable_type'] == 'limited' && $one_product['quantity'] > $one_product['Product']['purchasable']) {
                    $product['quantity'] = $one_product['Product']['purchasable'];
                    $product['max_quantity'] = $one_product['Product']['purchasable'];
                    $quantity = $one_product['Product']['purchasable'];
                } elseif ($one_product['quantity'] > $one_product['Product']['quantity']) {
                    $product['quantity'] = $one_product['Product']['quantity'];
                    $product['max_quantity'] = $one_product['Product']['quantity'];
                    $quantity = $one_product['Product']['quantity'];
                } else {
                    $product['quantity'] = $one_product['quantity'];
                    if ($one_product['Product']['purchasable_type'] == 'unlimited') {
                        $product['max_quantity'] = $one_product['Product']['quantity'];
                    } else {
                        $product['max_quantity'] = $one_product['Product']['purchasable'];
                    }
                    $quantity = $one_product['quantity'];
                }

                $product['total'] = number_format($product_price * $quantity, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                $product['image'] = URL::to('upload/products/' . $one_product['Product']['image']);
                $sub_total = $sub_total + ($product_price * $quantity);
                array_push($products, $product);
            }
        }
        $total = number_format($sub_total, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        $sub_total = number_format($sub_total, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];

        $addresses = [];
        $all_address = \App\Models\Address::where('user_id', $this->user_id)->get();
        foreach ($all_address as $one_address) {
            $address['id'] = $one_address['id'];
            $address['country_name'] = $one_address['Country'][$this->lang . '_name'];
            $address['country_id'] = $one_address['country_id'];
            $address['currency_id'] = $one_address['Country']['currency_id'];
            $address['delivery_duration'] = $one_address['Country'][$this->lang . '_delivery'];
            $address['title'] = $one_address['address_name'];
            $address['phone'] = $one_address['Country']['code'] . $one_address['phone'];
            $address['city'] = $one_address['City'][$this->lang . '_name'];
            $address['address_line_1'] = $one_address['address_line_1'];
            $address['address_line_2'] = $one_address['address_line_2'];
            $address['postal_code'] = $one_address['postal_code'];
            $address['notes'] = $one_address['notes'];

            array_push($addresses, $address);
        }

        $response['status'] = 1;
        $response['message'] = trans('api.cart');
        $response['data'] = ['products' => $products, 'addresses' => $addresses, 'sub_total' => $sub_total, 'discount' => $discount, 'total' => $total];
        return Response()->json($response);
    }

    public function cart_delete($id) {
        \App\Models\Cart::where('id', $id)->delete();

        if ($this->user_id > 0) {
            $all_products = \App\Models\Cart::where('user_id', $this->user_id)->get();
        } else {
            $all_products = \App\Models\Cart::where('key_id', $this->firebase_token)->where('user_id', 0)->get();
        }

        $products = [];
        $cart_count = 0;
        $sub_total = 0;
        $discount = number_format(0, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        foreach ($all_products as $one_product) {
            if ($one_product['Product']['active'] == 'yes') {
                $price = \App\Models\ProductPrice::where('currency_id', $this->currency['id'])->where('product_id', $one_product['product_id'])->first();

                $product['cart_id'] = $one_product['id'];
                $product['id'] = $one_product['product_id'];
                $product['name'] = $one_product['Product'][$this->lang . '_name'];

                if ($one_product['Product']['Category']['offer'] > 0) {
                    $product['offer'] = 'yes';
                    $product['price'] = number_format($price['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product['price_offer'] = number_format($price['price'] - ($price['price'] * $one_product['Product']['Category']['offer'] / 100), $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product_price = $price['price'] - ($price['price'] * $one_product['Product']['Category']['offer'] / 100);
                } elseif ($price['offer'] > 0) {
                    $product['offer'] = 'yes';
                    $product['price'] = number_format($price['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product['price_offer'] = number_format($price['offer'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product_price = $price['offer'];
                } else {
                    $product['offer'] = 'no';
                    $product['price'] = number_format($price['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product_price = $price['price'];
                }

                if ($one_product['Product']['purchasable_type'] == 'limited' && $one_product['quantity'] > $one_product['Product']['purchasable']) {
                    $product['quantity'] = $one_product['Product']['purchasable'];
                    $product['max_quantity'] = $one_product['Product']['purchasable'];
                    $quantity = $one_product['Product']['purchasable'];
                } elseif ($one_product['quantity'] > $one_product['Product']['quantity']) {
                    $product['quantity'] = $one_product['Product']['quantity'];
                    $product['max_quantity'] = $one_product['Product']['quantity'];
                    $quantity = $one_product['Product']['quantity'];
                } else {
                    $product['quantity'] = $one_product['quantity'];
                    if ($one_product['Product']['purchasable_type'] == 'unlimited') {
                        $product['max_quantity'] = $one_product['Product']['quantity'];
                    } else {
                        $product['max_quantity'] = $one_product['Product']['purchasable'];
                    }
                    $quantity = $one_product['quantity'];
                }

                $product['total'] = number_format($product_price * $quantity, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                $product['image'] = URL::to('upload/products/' . $one_product['Product']['image']);
                $sub_total = $sub_total + ($product_price * $quantity);
                $cart_count = $cart_count + $quantity;
                array_push($products, $product);
            }
        }
        $total = number_format($sub_total, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        $sub_total = number_format($sub_total, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];

        $addresses = [];
        $all_address = \App\Models\Address::where('user_id', $this->user_id)->get();
        foreach ($all_address as $one_address) {
            $address['id'] = $one_address['id'];
            $address['country_name'] = $one_address['Country'][$this->lang . '_name'];
            $address['country_id'] = $one_address['country_id'];
            $address['title'] = $one_address['address_name'];
            $address['phone'] = $one_address['Country']['code'] . $one_address['phone'];
            $address['city'] = $one_address['City'][$this->lang . '_name'];
            $address['address_line_1'] = $one_address['address_line_1'];
            $address['address_line_2'] = $one_address['address_line_2'];
            $address['postal_code'] = $one_address['postal_code'];
            $address['notes'] = $one_address['notes'];

            array_push($addresses, $address);
        }

        $ios_data = ['action' => 'cart', 'count' => $cart_count, 'title' => '', 'alert' => '', 'image' => ''];
        $android_data = ['action' => 'cart', 'count' => $cart_count, 'title' => '', 'message' => '', 'image' => ''];
        if ($this->user_id > 0) {
            $android_devices = \App\Models\ApiKey::where('user_id', $this->user_id)->where('platform', 'android')->pluck('key')->toArray();
            $ios_devices = \App\Models\ApiKey::where('user_id', $this->user_id)->where('platform', 'ios')->pluck('key')->toArray();
        } else {
            $android_devices = \App\Models\ApiKey::where('key', $this->firebase_token)->where('user_id', 0)->where('platform', 'android')->pluck('key')->toArray();
            $ios_devices = \App\Models\ApiKey::where('key', $this->firebase_token)->where('user_id', 0)->where('platform', 'ios')->pluck('key')->toArray();
        }


        if (count($ios_devices) > 0) {
            PushNotifications::ios($ios_devices, $ios_data, 'many');
        }
        if (count($android_devices) > 0) {
            PushNotifications::android($android_devices, $android_data, 'many');
        }

        $response['status'] = 1;
        $response['message'] = trans('api.cart');
        $response['data'] = ['products' => $products, 'addresses' => $addresses, 'sub_total' => $sub_total, 'discount' => $discount, 'total' => $total, 'cart_count' => $cart_count];
        return Response()->json($response);
    }

    public function cart_edit($id) {
        $request = request()->all();
        $found = \App\Models\Cart::find($id);
        $product_info = \App\Models\Product::find($found['product_id']);

        if ($product_info['purchasable_type'] == 'limited' && $request['quantity'] > $product_info['purchasable']) {
            $status = 0;
            $message = trans('admin.purchasable_error') . ' ' . $product_info['purchasable'] . ' ' . trans('admin.purchasable_errorr');
        } elseif ($request['quantity'] > $product_info['quantity']) {
            $status = 0;
            $message = trans('admin.purchasable_error') . ' ' . $product_info['quantity'] . ' ' . trans('admin.purchasable_errorr');
        } else {
            $found->quantity = $request['quantity'];
            $found->save();

            $status = 1;
            $message = trans('admin.add_cart_suc');
        }


        if ($this->user_id > 0) {
            $all_products = \App\Models\Cart::where('user_id', $this->user_id)->get();
        } else {
            $all_products = \App\Models\Cart::where('key_id', $this->firebase_token)->where('user_id', 0)->get();
        }

        $products = [];
        $cart_count = 0;
        $sub_total = 0;
        $discount = number_format(0, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        foreach ($all_products as $one_product) {
            if ($one_product['Product']['active'] == 'yes') {
                $price = \App\Models\ProductPrice::where('currency_id', $this->currency['id'])->where('product_id', $one_product['product_id'])->first();

                $product['cart_id'] = $one_product['id'];
                $product['id'] = $one_product['product_id'];
                $product['name'] = $one_product['Product'][$this->lang . '_name'];

                if ($one_product['Product']['Category']['offer'] > 0) {
                    $product['offer'] = 'yes';
                    $product['price'] = number_format($price['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product['price_offer'] = number_format($price['price'] - ($price['price'] * $one_product['Product']['Category']['offer'] / 100), $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product_price = $price['price'] - ($price['price'] * $one_product['Product']['Category']['offer'] / 100);
                } elseif ($price['offer'] > 0) {
                    $product['offer'] = 'yes';
                    $product['price'] = number_format($price['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product['price_offer'] = number_format($price['offer'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product_price = $price['offer'];
                } else {
                    $product['offer'] = 'no';
                    $product['price'] = number_format($price['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                    $product_price = $price['price'];
                }

                if ($one_product['Product']['purchasable_type'] == 'limited' && $one_product['quantity'] > $one_product['Product']['purchasable']) {
                    $product['quantity'] = $one_product['Product']['purchasable'];
                    $product['max_quantity'] = $one_product['Product']['purchasable'];
                    $quantity = $one_product['Product']['purchasable'];
                } elseif ($one_product['quantity'] > $one_product['Product']['quantity']) {
                    $product['quantity'] = $one_product['Product']['quantity'];
                    $product['max_quantity'] = $one_product['Product']['quantity'];
                    $quantity = $one_product['Product']['quantity'];
                } else {
                    $product['quantity'] = $one_product['quantity'];
                    if ($one_product['Product']['purchasable_type'] == 'unlimited') {
                        $product['max_quantity'] = $one_product['Product']['quantity'];
                    } else {
                        $product['max_quantity'] = $one_product['Product']['purchasable'];
                    }
                    $quantity = $one_product['quantity'];
                }

                $product['total'] = number_format($product_price * $quantity, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                $product['image'] = URL::to('upload/products/' . $one_product['Product']['image']);
                $sub_total = $sub_total + ($product_price * $quantity);
                $cart_count = $cart_count + $quantity;
                array_push($products, $product);
            }
        }
        $total = number_format($sub_total, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        $sub_total = number_format($sub_total, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];

        $addresses = [];
        $all_address = \App\Models\Address::where('user_id', $this->user_id)->get();
        foreach ($all_address as $one_address) {
            $address['id'] = $one_address['id'];
            $address['country_name'] = $one_address['Country'][$this->lang . '_name'];
            $address['country_id'] = $one_address['country_id'];
            $address['title'] = $one_address['address_name'];
            $address['phone'] = $one_address['Country']['code'] . $one_address['phone'];
            $address['city'] = $one_address['City'][$this->lang . '_name'];
            $address['address_line_1'] = $one_address['address_line_1'];
            $address['address_line_2'] = $one_address['address_line_2'];
            $address['postal_code'] = $one_address['postal_code'];
            $address['notes'] = $one_address['notes'];

            array_push($addresses, $address);
        }

        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = ['products' => $products, 'addresses' => $addresses, 'sub_total' => $sub_total, 'discount' => $discount, 'total' => $total, 'cart_count' => $cart_count];
        return Response()->json($response);
    }

    public function address_save() {
        $request = request()->all();

        $validator = Validator::make($request, [
                    "country_id" => "required",
                    "city_id" => "required",
                    "address_name" => "required",
                    "phone" => "required",
                    "address_line_1" => "required",
        ]);

        if ($validator->fails()) {
            $status = 0;
            $message = "";
            foreach ($validator->errors()->all() as $one_error) {
                if ($message == "") {
                    $message = $one_error;
                } else {
                    $message = $message . ', ' . $one_error;
                }
            }
        } else {
            $new_address = new \App\Models\Address();
            $new_address->user_id = $this->user_id;
            $new_address->country_id = \App\Models\City::find($request['city_id'])->country_id;
            $new_address->city_id = $request['city_id'];
            $new_address->address_name = $request['address_name'];
            $new_address->address_line_1 = $request['address_line_1'];
            $new_address->address_line_2 = $request['address_line_2'];
            $new_address->phone = $request['phone'];
            $new_address->postal_code = $request['postal_code'];
            $new_address->notes = $request['notes'];
            $new_address->save();

            $status = 1;
            $message = trans('api.address_suc');
        }

        $addresses = [];
        $all_address = \App\Models\Address::where('user_id', $this->user_id)->get();
        foreach ($all_address as $one_address) {
            $address['id'] = $one_address['id'];
            $address['country_name'] = $one_address['Country'][$this->lang . '_name'];
            $address['country_id'] = $one_address['country_id'];
            $address['currency_id'] = $one_address['Country']['currency_id'];
            $address['delivery_duration'] = $one_address['Country'][$this->lang . '_delivery'];
            $address['title'] = $one_address['address_name'];
            $address['phone'] = $one_address['Country']['code'] . $one_address['phone'];
            $address['city'] = $one_address['City'][$this->lang . '_name'];
            $address['address_line_1'] = $one_address['address_line_1'];
            $address['address_line_2'] = $one_address['address_line_2'];
            $address['postal_code'] = $one_address['postal_code'];
            $address['notes'] = $one_address['notes'];

            array_push($addresses, $address);
        }

        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = ['addresses' => $addresses];
        return Response()->json($response);
    }

    public function addresses() {
        if ($this->user_id == 0) {
            $response['status'] = 0;
            $response['message'] = trans('api.login_first');
            $response['data'] = (object) [];
            return Response()->json($response);
        }

        $addresses = [];
        $all_address = \App\Models\Address::where('user_id', $this->user_id)->get();
        foreach ($all_address as $one_address) {
            $address['id'] = $one_address['id'];
            $address['country_name'] = $one_address['Country'][$this->lang . '_name'];
            $address['country_id'] = $one_address['country_id'];
            $address['currency_id'] = $one_address['Country']['currency_id'];
            $address['city_id'] = $one_address['city_id'];
            $address['delivery_duration'] = $one_address['Country'][$this->lang . '_delivery'];
            $address['title'] = $one_address['address_name'];
            $address['phone'] = $one_address['Country']['code'] . $one_address['phone'];
            $address['city'] = $one_address['City'][$this->lang . '_name'];
            $address['address_line_1'] = $one_address['address_line_1'];
            $address['address_line_2'] = $one_address['address_line_2'];
            $address['postal_code'] = $one_address['postal_code'];
            $address['notes'] = $one_address['notes'];

            array_push($addresses, $address);
        }

        $response['status'] = 1;
        $response['message'] = trans('api.addresses');
        $response['data'] = ['addresses' => $addresses];

        return Response()->json($response);
    }

    public function address_info($id) {
        $one_address = \App\Models\Address::find($id);

        $address['id'] = $one_address['id'];
        $address['country_name'] = $one_address['Country'][$this->lang . '_name'];
        $address['country_id'] = $one_address['country_id'];
        $address['city_id'] = $one_address['city_id'];
        $address['address_name'] = $one_address['address_name'];
        $address['phone'] = $one_address['phone'];
        $address['address_line_1'] = $one_address['address_line_1'];
        $address['address_line_2'] = $one_address['address_line_1'];
        $address['postal_code'] = $one_address['postal_code'];
        $address['notes'] = $one_address['notes'];
        $address['country_name'] = $one_address['City']['Country'][$this->lang . '_name'];
        $address['country_code'] = $one_address['City']['Country']['code'];
        $address['city_name'] = $one_address['City'][$this->lang . '_name'];

        $countries = [];
        $all_countries = \App\Models\Country::where('active', 'yes')->orderBy($this->lang . '_name', 'asc')->get();
        foreach ($all_countries as $one_country) {
            $country['id'] = $one_country['id'];
            $country['currency_id'] = $one_country['currency_id'];
            $country['name'] = $one_country[$this->lang . '_name'];
            $country['code'] = $one_country['code'];
            $country['cities'] = [];
            $all_cities = \App\Models\City::where('active', 'yes')->where('country_id', $one_country['id'])->orderBy($this->lang . '_name', 'asc')->get();
            foreach ($all_cities as $one_city) {
                $city['id'] = $one_city['id'];
                $city['name'] = $one_city[$this->lang . '_name'];
                array_push($country['cities'], $city);
            }
            if (count($country['cities']) > 0) {
                array_push($countries, $country);
            }
        }

        $response['status'] = 1;
        $response['message'] = $one_address['address_name'];
        $response['data'] = ['address' => $address, 'countries' => $countries];
        return Response()->json($response);
    }

    public function address_edit($id) {
        if ($this->user_id == 0) {
            $response['status'] = 0;
            $response['message'] = trans('api.login_first');
            $response['data'] = (object) [];
            return Response()->json($response);
        }
        $request = request()->all();

        $validator = Validator::make($request, [
                    "country_id" => "required",
                    "city_id" => "required",
                    "address_name" => "required",
                    "phone" => "required",
                    "address_line_1" => "required",
        ]);

        if ($validator->fails()) {
            $status = 0;
            $message = "";
            foreach ($validator->errors()->all() as $one_error) {
                if ($message == "") {
                    $message = $one_error;
                } else {
                    $message = $message . ', ' . $one_error;
                }
            }
        } else {
            $edit_address = \App\Models\Address::find($id);
            $edit_address->country_id = \App\Models\City::find($request['city_id'])->country_id;
            $edit_address->city_id = $request['city_id'];
            $edit_address->address_name = $request['address_name'];
            $edit_address->address_line_1 = $request['address_line_1'];
            $edit_address->address_line_2 = $request['address_line_2'];
            $edit_address->phone = $request['phone'];
            $edit_address->postal_code = $request['postal_code'];
            $edit_address->notes = $request['notes'];
            $edit_address->save();

            $status = 1;
            $message = trans('api.address_suc');
        }

        $addresses = [];
        $all_address = \App\Models\Address::where('user_id', $this->user_id)->get();
        foreach ($all_address as $one_address) {
            $address['id'] = $one_address['id'];
            $address['country_name'] = $one_address['Country'][$this->lang . '_name'];
            $address['country_id'] = $one_address['country_id'];
            $address['currency_id'] = $one_address['Country']['currency_id'];
            $address['delivery_duration'] = $one_address['Country'][$this->lang . '_delivery'];
            $address['title'] = $one_address['address_name'];
            $address['phone'] = $one_address['Country']['code'] . $one_address['phone'];
            $address['city'] = $one_address['City'][$this->lang . '_name'];
            $address['address_line_1'] = $one_address['address_line_1'];
            $address['address_line_2'] = $one_address['address_line_2'];
            $address['postal_code'] = $one_address['postal_code'];
            $address['notes'] = $one_address['notes'];

            array_push($addresses, $address);
        }

        $countries = [];
        $all_countries = \App\Models\Country::where('active', 'yes')->orderBy($this->lang . '_name', 'asc')->get();
        foreach ($all_countries as $one_country) {
            $country['id'] = $one_country['id'];
            $country['currency_id'] = $one_country['currency_id'];
            $country['name'] = $one_country[$this->lang . '_name'];
            $country['code'] = $one_country['code'];
            $country['cities'] = [];
            $all_cities = \App\Models\City::where('active', 'yes')->where('country_id', $one_country['id'])->orderBy($this->lang . '_name', 'asc')->get();
            foreach ($all_cities as $one_city) {
                $city['id'] = $one_city['id'];
                $city['name'] = $one_city[$this->lang . '_name'];
                array_push($country['cities'], $city);
            }
            if (count($country['cities']) > 0) {
                array_push($countries, $country);
            }
        }

        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = ['addresses' => $addresses, 'countries' => $countries];
        return Response()->json($response);
    }

    public function address_delete($id) {
        $one_address = \App\Models\Address::find($id);
        if ($one_address) {
            $one_address->delete();
        }

        $addresses = [];
        $all_address = \App\Models\Address::where('user_id', $this->user_id)->get();
        foreach ($all_address as $one_address) {
            $address['id'] = $one_address['id'];
            $address['country_name'] = $one_address['Country'][$this->lang . '_name'];
            $address['country_id'] = $one_address['country_id'];
            $address['currency_id'] = $one_address['Country']['currency_id'];
            $address['delivery_duration'] = $one_address['Country'][$this->lang . '_delivery'];
            $address['title'] = $one_address['address_name'];
            $address['phone'] = $one_address['Country']['code'] . $one_address['phone'];
            $address['city'] = $one_address['City'][$this->lang . '_name'];
            $address['address_line_1'] = $one_address['address_line_1'];
            $address['address_line_2'] = $one_address['address_line_2'];
            $address['postal_code'] = $one_address['postal_code'];
            $address['notes'] = $one_address['notes'];

            array_push($addresses, $address);
        }

        $response['status'] = 1;
        $response['message'] = trans('api.address_del');
        $response['data'] = ['addresses' => $addresses];

        return Response()->json($response);
    }

    public function check_coupon() {
        $request = request()->all();

        if ($this->user_id > 0) {
            $all_products = \App\Models\Cart::where('user_id', $this->user_id)->get();
        } else {
            $all_products = \App\Models\Cart::where('key_id', $this->firebase_token)->where('user_id', 0)->get();
        }

        $sub_total = 0;
        $discount = 0;
        foreach ($all_products as $one_product) {
            if ($one_product['Product']['active'] == 'yes') {
                $price = \App\Models\ProductPrice::where('currency_id', $this->currency['id'])->where('product_id', $one_product['product_id'])->first();

                if ($one_product['Product']['Category']['offer'] > 0) {
                    $product_price = $price['price'] - ($price['price'] * $one_product['Product']['Category']['offer'] / 100);
                } elseif ($price['offer'] > 0) {
                    $product_price = $price['offer'];
                } else {
                    $product_price = $price['price'];
                }

                if ($one_product['Product']['purchasable_type'] == 'limited' && $one_product['quantity'] > $one_product['Product']['purchasable']) {
                    $quantity = $one_product['Product']['purchasable'];
                } elseif ($one_product['quantity'] > $one_product['Product']['quantity']) {
                    $quantity = $one_product['Product']['quantity'];
                } else {
                    $quantity = $one_product['quantity'];
                }

                $sub_total = $sub_total + ($product_price * $quantity);
            }
        }

        if (isset($request['promo_code']) && $request['promo_code'] != '') {
            $promo_code = \App\Models\PromoCode::where('code', $request['promo_code'])->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>', date('Y-m-d'))->first();
            if ($promo_code) {
                $promo_code_active = 1;
                if ($promo_code['active'] != 'yes' || $promo_code['start_date'] > date('Y-m-d') || $promo_code['end_date'] <= date('Y-m-d') || $promo_code['usage'] >= $promo_code['max']) {
                    $promo_code_active = 0;
                }
                if ($promo_code_active == 1) {
                    $discount = $sub_total * $promo_code['amount'] / 100;
                    $status = 1;
                    $message = trans('api.valid_copoun');
                } else {
                    $status = 0;
                    $message = trans('api.invalid_copoun');
                }
            } else {
                $status = 0;
                $message = trans('api.invalid_copoun');
            }
        } else {
            $status = 0;
            $message = trans('api.invalid_copoun');
        }


        $total = number_format($sub_total - $discount, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        $sub_total = number_format($sub_total, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        $discount = number_format($discount, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];

        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = ['sub_total' => $sub_total, 'discount' => $discount, 'total' => $total];
        return Response()->json($response);
    }

    public function checkout_info() {
        $request = request()->all();

        if ($this->user_id > 0) {
            $all_products = \App\Models\Cart::where('user_id', $this->user_id)->get();
        } else {
            $all_products = \App\Models\Cart::where('key_id', $this->firebase_token)->where('user_id', 0)->get();
        }

        $one_address = \App\Models\Address::find($request['address_id']);
        $address['id'] = $one_address['id'];
        $address['country_name'] = $one_address['Country'][$this->lang . '_name'];
        $address['country_id'] = $one_address['country_id'];
        $address['currency_id'] = $one_address['Country']['currency_id'];
        $address['delivery_duration'] = $one_address['Country'][$this->lang . '_delivery'];
        $address['title'] = $one_address['address_name'];
        $address['phone'] = $one_address['Country']['code'] . $one_address['phone'];
        $address['city'] = $one_address['City'][$this->lang . '_name'];
        $address['address_line_1'] = $one_address['address_line_1'];
        $address['address_line_2'] = $one_address['address_line_2'];
        $address['postal_code'] = $one_address['postal_code'];
        $address['notes'] = $one_address['notes'];

        $delivery = 0;
        $sub_total = 0;
        $discount = 0;
        $items = 0;
        foreach ($all_products as $one_product) {
            if ($one_product['Product']['active'] == 'yes') {
                $price = \App\Models\ProductPrice::where('currency_id', $this->currency['id'])->where('product_id', $one_product['product_id'])->first();

                if ($one_product['Product']['Category']['offer'] > 0) {
                    $product_price = $price['price'] - ($price['price'] * $one_product['Product']['Category']['offer'] / 100);
                } elseif ($price['offer'] > 0) {
                    $product_price = $price['offer'];
                } else {
                    $product_price = $price['price'];
                }

                if ($one_product['Product']['purchasable_type'] == 'limited' && $one_product['quantity'] > $one_product['Product']['purchasable']) {
                    $quantity = $one_product['Product']['purchasable'];
                } elseif ($one_product['quantity'] > $one_product['Product']['quantity']) {
                    $quantity = $one_product['Product']['quantity'];
                } else {
                    $quantity = $one_product['quantity'];
                }

                $items = $items + $quantity;
                $sub_total = $sub_total + ($product_price * $quantity);
            }
        }

        if (isset($request['promo_code']) && $request['promo_code'] != '') {
            $promo_code = \App\Models\PromoCode::where('code', $request['promo_code'])->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>', date('Y-m-d'))->first();
            if ($promo_code) {
                $promo_code_active = 1;
                if ($promo_code['active'] != 'yes' || $promo_code['start_date'] > date('Y-m-d') || $promo_code['end_date'] <= date('Y-m-d') || $promo_code['usage'] >= $promo_code['max']) {
                    $promo_code_active = 0;
                }
                if ($promo_code_active == 1) {
                    $discount = $sub_total * $promo_code['amount'] / 100;
                }
            }
        }

        $min_order = $one_address['Country']['Currency']['min_order'];
        $max_items = $one_address['Country']['Currency']['max_items'];
        if (($sub_total - $discount) < $min_order) {
            $status = 0;
            $message = trans('admin.min_order_error') . ' ' . number_format($min_order, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        } elseif ($items > $max_items) {
            $status = 0;
            $message = trans('admin.max_items_error') . ' ' . $this->currency['max_items'] . ' ' . trans('admin.max_items_errorr');
        } else {
            $status = 1;
            $message = trans('admin.cart');
        }

        if ($this->currency['id'] == 1) {
            $delivery = 0;
        } elseif ($this->currency['id'] == 2) {
            if (($sub_total - $discount) < 50) {
                $delivery = 20;
            } else {
                $delivery = 0;
            }
        } elseif ($this->currency['id'] == 3) {
            if (($sub_total - $discount) < 500) {
                $delivery = 3;
            } else {
                $delivery = 0;
            }
        } elseif ($this->currency['id'] == 4) {
            if (($sub_total - $discount) < 500) {
                $delivery = 30;
            } else {
                $delivery = 0;
            }
        } elseif ($this->currency['id'] == 5) {
            if (($sub_total - $discount) < 500) {
                $delivery = 30;
            } else {
                $delivery = 0;
            }
        } elseif ($this->currency['id'] == 6) {
            if (($sub_total - $discount) < 50) {
                $delivery = 3;
            } else {
                $delivery = 0;
            }
        } elseif ($this->currency['id'] == 7) {
            $delivery = 20;
        } elseif ($this->currency['id'] == 8) {
            $delivery = 20;
        }

        $fees = ($sub_total - $discount) * $this->currency['fees'] / 100;
        $total = number_format($sub_total - $discount + $delivery + $fees, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        $sub_total = number_format($sub_total, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        $discount = number_format($discount, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        $fees = number_format($fees, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        if ($delivery == 0) {
            $delivery = trans('admin.free');
        } else {
            $delivery = number_format($delivery, $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
        }

        $payment_methods = [];
        $all_payment_methods = explode(',', $this->currency['payment_method']);
        foreach ($all_payment_methods as $one_payment_method) {
            $payment_method['id'] = $one_payment_method;
            if ($this->platform == 'ios') {
                $payment_method['image'] = url('upload/payments/' . $one_payment_method . '.png');
            } else {
                $payment_method['image'] = url('upload/payments/' . $one_payment_method . '.svg');
            }
            if ($one_payment_method == 2) {
                $payment_method['name'] = trans('admin.credit');
            } else {
                $payment_method['name'] = trans('admin.debit');
            }
            array_push($payment_methods, $payment_method);
        }

        $pages = \App\Models\Page::whereIn('id', [2, 3, 4])->select(['id', $this->lang . '_title as title', $this->lang . '_desc as content'])->get();

        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = ['address' => $address, 'sub_total' => $sub_total, 'discount' => $discount, 'total' => $total, 'delivery' => $delivery, 'fees' => $fees, 'pages' => $pages, 'payment_methods' => $payment_methods];
        return Response()->json($response);
    }

    public function checkout() {
        $request = request()->all();

        $new_order = new \App\Models\Order();
        $new_order->key = $this->firebase_token;
        $new_order->platform = $this->platform;
        $new_order->lang = $this->lang;
        $new_order->status = 'unpaid';
        $new_order->pay_type = $request['payment_method'];
        $new_order->date = date('Y-m-d');

        $new_order->user_type = 'user';
        $new_order->user_id = $this->user_id;
        $new_order->gift = $request['gift'];

        $address = \App\Models\Address::find($request['address_id']);
        $new_order->currency_format = $address['City']['Country']['Currency']['currency_format'];
        $new_order->currency_ar = $address['City']['Country']['Currency']['ar_currency'];
        $new_order->currency_en = $address['City']['Country']['Currency']['en_currency'];
        $new_order->country_ar = $address['City']['Country']['ar_name'];
        $new_order->country_en = $address['City']['Country']['en_name'];
        $new_order->city_ar = $address['City']['ar_name'];
        $new_order->city_en = $address['City']['en_name'];
        $new_order->address_name = $address['address_name'];
        $new_order->address_line_1 = $address['address_line_1'];
        $new_order->address_line_2 = $address['address_line_2'];
        $new_order->postal_code = $address['postal_code'];
        $new_order->phone = $address['City']['Country']['code'] . $address['phone'];
        $new_order->notes = $address['notes'];

        $new_order->save();
        $order_id = $new_order->id;

        $all_products = \App\Models\Cart::where('user_id', $this->user_id)->get();

        $sub_total = $discount = $delivery = 0;
        $promo_code_value = '';
        foreach ($all_products as $one_product) {
            if ($one_product['Product']['active'] == 'yes') {
                $price = \App\Models\ProductPrice::where('currency_id', $address['Country']['currency_id'])->where('product_id', $one_product['product_id'])->first();

                if ($one_product['Product']['Category']['offer'] > 0) {
                    $product_price = $price['price'] - ($price['price'] * $one_product['Product']['Category']['offer'] / 100);
                } elseif ($price['offer'] > 0) {
                    $product_price = $price['offer'];
                } else {
                    $product_price = $price['price'];
                }

                if ($one_product['Product']['purchasable_type'] == 'limited' && $one_product['quantity'] > $one_product['Product']['purchasable']) {
                    $quantity = $one_product['Product']['purchasable'];
                } elseif ($one_product['quantity'] > $one_product['Product']['quantity']) {
                    $quantity = $one_product['Product']['quantity'];
                } else {
                    $quantity = $one_product['quantity'];
                }

                $new_order_product = new \App\Models\OrderProduct();
                $new_order_product->order_id = $order_id;
                $new_order_product->product_id = $one_product['product_id'];
                $new_order_product->count = $quantity;
                $new_order_product->price = $product_price;
                $new_order_product->save();

                $sub_total = $sub_total + ($product_price * $quantity);
            }
        }

        if (isset($request['promo_code']) && $request['promo_code'] != '') {
            $promo_code = \App\Models\PromoCode::where('code', $request['promo_code'])->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>', date('Y-m-d'))->first();
            if ($promo_code) {
                $promo_code_active = 1;
                if ($promo_code['active'] != 'yes' || $promo_code['start_date'] > date('Y-m-d') || $promo_code['end_date'] <= date('Y-m-d') || $promo_code['usage'] >= $promo_code['max']) {
                    $promo_code_active = 0;
                }
                if ($promo_code_active == 1) {
                    $promo_code_value = $promo_code['code'];
                    $discount = $sub_total * $promo_code['amount'] / 100;
                }
            }
        }

        if ($this->currency['id'] == 2 && ($sub_total - $discount) < 50) {
            $delivery = 20;
        } elseif ($this->currency['id'] == 3 && ($sub_total - $discount) < 500) {
            $delivery = 3;
        } elseif ($this->currency['id'] == 4 && ($sub_total - $discount) < 500) {
            $delivery = 30;
        } elseif ($this->currency['id'] == 5 && ($sub_total - $discount) < 500) {
            $delivery = 30;
        } elseif ($this->currency['id'] == 6 && ($sub_total - $discount) < 50) {
            $delivery = 3;
        } elseif ($this->currency['id'] == 7 || $this->currency['id'] == 8) {
            $delivery = 20;
        }

        $fees = ($sub_total - $discount) * $this->currency['fees'] / 100;

        $edit_order = \App\Models\Order::find($order_id);
        $edit_order->promo_code = $promo_code_value;
        $edit_order->promo_code_amount = $discount;
        $edit_order->delivery = $delivery;
        $edit_order->fees = $fees;
        $edit_order->total = $sub_total;
        $edit_order->save();

        $final_order = \App\Models\Order::find($order_id);
        $fianl_price = $final_order['total'] + $final_order['delivery'] + $final_order['fees'] - $final_order['promo_code_amount'];

        $user = \App\Models\User::find($this->user_id);
        $data['name'] = $user['first_name'] . ' ' . $user['last_name'];
        $data['email'] = $user['email'];
        $data['phone'] = $address['phone'];
        $data['unique'] = uniqid();
        $data['id'] = $order_id;
        $data['total'] = $fianl_price;
        $data['platform'] = $this->platform;
        $data['lang'] = $this->lang;
        $data['currency'] = $address['City']['Country']['Currency']['currency'];
        $data['code'] = $address['City']['Country']['code'];
        $data['pay_type'] = $request['payment_method'];
        $url = Payments::get_url($data);

        $response['status'] = 1;
        $response['message'] = trans('admin.order_suc');
        $response['data'] = ['order_id' => $order_id, 'payment_id' => '', 'transaction_id' => '', 'payment_link' => $url];
        return Response()->json($response);
    }

    public function orders() {
        $orders = [];
        $all_orders = \App\Models\Order::where('user_id', $this->user_id)->Where('status', '!=', 'unpaid')->orderBy('id', 'desc')->get();

        foreach ($all_orders as $one_order) {
            $order['id'] = $one_order['id'];
            $order['id_text'] = '#AM' . $one_order['id'];
            $order['date'] = $one_order['date'];
            $order['items'] = $one_order->Products->sum('count');
            $order['status'] = trans('admin.order_' . $one_order['status']);
            $order['total'] = number_format($one_order['total'] + $one_order['delivery'] + $one_order['fees'] - $one_order['promo_code_amount'], $one_order['currency_format'], '.', '') . ' ' . $one_order['currency_' . $this->lang];
            $order['reorder'] = 'no';
            if ($one_order['status'] == 'delivered') {
                $order['reorder'] = 'yes';
                foreach ($one_order['Products'] as $one_product) {
                    if ($one_product['Product']['active'] != 'yes' || $one_product['Product']['quantity'] == 0) {
                        $order['reorder'] = 'no';
                    }
                }
            }

            array_push($orders, $order);
        }

        $response['status'] = 1;
        $response['message'] = trans('admin.orders');
        $response['data'] = $orders;

        return Response()->json($response);
    }

    public function order($id) {
        $one_order = \App\Models\Order::find($id);

        $order['id'] = $one_order['id'];
        $order['id_text'] = '#AM' . $one_order['id'];
        $order['date'] = $one_order['date'];
        $order['status'] = trans('admin.order_' . $one_order['status']);
        $order['user'] = trans('admin.mr') . ' ' . $one_order['User']['first_name'] . ' ' . $one_order['User']['last_name'];
        $order['address_country'] = $one_order['country_' . $this->lang] . ' , ' . $one_order['city_' . $this->lang];
        $order['address_phone'] = $one_order['phone'];
        $order['address_line_1'] = $one_order['address_line_1'];
        $order['address_line_2'] = $one_order['address_line_2'];
        $order['postal_code'] = $one_order['postal_code'];
        $order['notes'] = $one_order['notes'];
        $order['gift'] = $one_order['gift'];
        $order['payment_id'] = $one_order['payment_id'];
        $order['transaction_id'] = $one_order['transaction_id'];
        $order['reorder'] = 'no';
        if ($one_order['status'] == 'delivered') {
            $order['reorder'] = 'yes';
        }

        $order['fees'] = number_format($one_order['fees'], $one_order['currency_format'], '.', '') . ' ' . $one_order['currency_' . $this->lang];
        $order['sub_total'] = number_format($one_order['total'], $one_order['currency_format'], '.', '') . ' ' . $one_order['currency_' . $this->lang];
        $order['discount'] = number_format($one_order['promo_code_amount'], $one_order['currency_format'], '.', '') . ' ' . $one_order['currency_' . $this->lang];
        $order['total'] = number_format($one_order['total'] + $one_order['delivery'] + $one_order['fees'] - $one_order['promo_code_amount'], $one_order['currency_format'], '.', '') . ' ' . $one_order['currency_' . $this->lang];
        if ($one_order['delivery'] == 0) {
            $order['delivery'] = trans('admin.free');
        } else {
            $order['delivery'] = number_format($one_order['delivery'], $one_order['currency_format'], '.', '') . ' ' . $one_order['currency_' . $this->lang];
        }

        $order['products'] = [];
        foreach ($one_order['Products'] as $one_product) {
            $product['name'] = $one_product['Product'][$this->lang . '_name'];
            $product['quantity'] = $one_product['count'];
            $product['price'] = number_format($one_product['price'] * $one_product['count'], $one_order['currency_format'], '.', '') . ' ' . $one_order['currency_' . $this->lang];
            $product['image'] = URL::to('upload/products/' . $one_product['Product']['image']);
            array_push($order['products'], $product);
            if ($one_product['Product']['active'] != 'yes' || $one_product['Product']['quantity'] == 0) {
                $order['reorder'] = 'no';
            }
        }

        $response['status'] = 1;
        $response['message'] = trans('admin.orders_details_no') . ' : ' . $id;
        $response['data'] = $order;

        return Response()->json($response);
    }

    public function profile() {
        if ($this->user_id == 0) {
            return Response()->json(['status' => 0, 'message' => trans('api.login_first')], 401);
        }
        $user_id = $this->user_id;
        $one_user = \App\Models\User::find($user_id);
        $user['id'] = $one_user->id;
        $user['name'] = $one_user->first_name . ' ' . $one_user->last_name;
        $user['email'] = $one_user->email;

        $products = [];
        $all_products = \App\Models\Product::where('products.active', 'yes')->where('products_prices.currency_id', $this->currency['id'])->join('products_prices', 'products_prices.product_id', '=', 'products.id')->whereExists(function ($query) use ($user_id) {
                    $query->select(\DB::raw(1))->where('favourites.user_id', $user_id)
                            ->from('favourites')
                            ->whereRaw('favourites.product_id = products.id');
                })->orderBy('sort', 'asc')->take(4)->get();

        foreach ($all_products as $one_product) {
            $product['id'] = $one_product['id'];
            $product['name'] = $one_product[$this->lang . '_name'];
            $product['favorite'] = 1;
            $product['image'] = url('upload/products/' . $one_product['image']);
            $product['quantity'] = $one_product['quantity'];
            $product['offer'] = 'no';
            if ($one_product['Category']['offer'] > 0) {
                $product['offer'] = 'yes';
                $product['price'] = number_format($one_product['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                $product['price_offer'] = number_format($one_product['price'] - ($one_product['price'] * $one_product['Category']['offer'] / 100), $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            } elseif ($one_product['offer'] > 0) {
                $product['offer'] = 'yes';
                $product['price'] = number_format($one_product['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                $product['price_offer'] = number_format($one_product['offer'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            } else {
                $product['offer'] = 'no';
                $product['price'] = number_format($one_product['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                $product['price_offer'] = number_format($one_product['offer'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            }
            array_push($products, $product);
        }

        $response['status'] = 1;
        $response['message'] = trans('api.profile');
        $response['data'] = ['user' => $user, 'products' => $products];

        return Response()->json($response);
    }

    public function profile_edit() {
        if ($this->user_id == 0) {
            return Response()->json(['status' => 0, 'message' => trans('api.login_first')], 401);
        }
        $user_id = $this->user_id;
        $one_user = \App\Models\User::find($user_id);
        $user['id'] = $one_user->id;
        $user['first_name'] = $one_user->first_name;
        $user['last_name'] = $one_user->last_name;
        $user['email'] = $one_user->email;
        $user['code'] = $one_user->country_id;
        $user['phone'] = $one_user->phone;
        $user['authorization'] = $one_user->token;

        $countries = [];
        $all_countries = \App\Models\Country::where('active', 'yes')->orderBy('code', 'asc')->get();
        foreach ($all_countries as $one_country) {
            $country['id'] = $one_country['id'];
            $country['code'] = $one_country['code'];
            $country['selected'] = 'no';
            if ($one_country['id'] == $one_user['country_id']) {
                $country['selected'] = 'yes';
            }
            array_push($countries, $country);
        }

        $response['status'] = 1;
        $response['message'] = trans('api.profile');
        $response['data'] = ['user' => $user, 'countries' => $countries];

        return Response()->json($response);
    }

    public function profile_update() {
        $request = request()->all();
        $validator = Validator::make($request, [
                    "first_name" => "required",
                    "last_name" => "required",
                    "phone" => "required|numeric|unique:users,phone,$this->user_id,id,deleted_at,NULL",
                    "code" => "required"
        ]);

        if ($validator->fails()) {
            $message = "";
            foreach ($validator->errors()->all() as $one_error) {
                if ($message == "") {
                    $message = $one_error;
                } else {
                    $message = $message . ', ' . $one_error;
                }
            }
            return Response()->json(['status' => 0, 'message' => $message], 422);
        } else {
            $user_edit = \App\Models\User::find($this->user_id);
            $user_edit->first_name = $request['first_name'];
            $user_edit->last_name = $request['last_name'];
            $user_edit->phone = $request['phone'];
            $user_edit->country_id = $request['code'];
            $user_edit->save();

            $one_user = \App\Models\User::find($this->user_id);
            $user['id'] = $one_user->id;
            $user['first_name'] = $one_user->first_name;
            $user['last_name'] = $one_user->last_name;
            $user['email'] = $one_user->email;
            $user['code'] = $one_user->country_id;
            $user['phone'] = $one_user->phone;
            $user['authorization'] = $one_user->token;

            $status = 1;
            $message = trans('api.profile_suc');
        }

        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = $user;

        return Response()->json($response);
    }

    public function change_password() {
        if ($this->user_id == 0) {
            $response['status'] = 0;
            $response['message'] = trans('api.login_first');
            $response['data'] = (object) [];
            return Response()->json($response);
        }
        $request = request()->all();
        $validator = Validator::make($request, [
                    "old_password" => "required",
                    "password" => "required|confirmed",
                    "password_confirmation" => "required",
        ]);

        if ($validator->fails()) {
            $status = 0;
            $message = "";
            foreach ($validator->errors()->all() as $one_error) {
                if ($message == "") {
                    $message = $one_error;
                } else {
                    $message = $message . ' , ' . $one_error;
                }
            }
            return Response()->json(['status' => 0, 'message' => $message], 422);
        } else {
            $user = \App\Models\User::find($this->user_id);
            if (Auth::attempt(['email' => $user['email'], 'password' => $request['old_password']], FALSE)) {
                $user_edit = \App\Models\User::find(Auth::User()->id);
                $user_edit->password = Hash::make($request['password']);
                $user_edit->save();

                $status = 1;
                $message = trans('admin.suc_update_password');
            } else {
                $status = 0;
                $message = trans('admin.wrong_old_password');
                return Response()->json(['status' => 0, 'message' => $message], 422);
            }
        }

        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = (object) [];
        return Response()->json($response);
    }

    public function favourites() {
        if ($this->user_id == 0) {
            return Response()->json(['status' => 0, 'message' => trans('api.login_first')], 401);
        }
        $user_id = Auth::User()->id;
        $products = [];
        $all_products = \App\Models\Product::where('products.active', 'yes')->where('products_prices.currency_id', $this->currency['id'])->join('products_prices', 'products_prices.product_id', '=', 'products.id')->whereExists(function ($query) use ($user_id) {
                    $query->select(\DB::raw(1))->where('favourites.user_id', $user_id)
                            ->from('favourites')
                            ->whereRaw('favourites.product_id = products.id');
                })->orderBy('sort', 'asc')->get();

        foreach ($all_products as $one_product) {
            $product['id'] = $one_product['id'];
            $product['name'] = $one_product[$this->lang . '_name'];
            $product['favorite'] = 1;
            $product['image'] = url('upload/products/' . $one_product['image']);
            $product['quantity'] = $one_product['quantity'];
            $product['offer'] = 'no';
            if ($one_product['Category']['offer'] > 0) {
                $product['offer'] = 'yes';
                $product['price'] = number_format($one_product['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                $product['price_offer'] = number_format($one_product['price'] - ($one_product['price'] * $one_product['Category']['offer'] / 100), $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            } elseif ($one_product['offer'] > 0) {
                $product['offer'] = 'yes';
                $product['price'] = number_format($one_product['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                $product['price_offer'] = number_format($one_product['offer'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            } else {
                $product['offer'] = 'no';
                $product['price'] = number_format($one_product['price'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
                $product['price_offer'] = number_format($one_product['offer'], $this->currency['currency_format'], '.', '') . ' ' . $this->currency[$this->lang . '_currency'];
            }
            array_push($products, $product);
        }

        $response['status'] = 1;
        $response['message'] = trans('api.favourites');
        $response['data'] = $products;
        return Response()->json($response);
    }

    public function branches() {
        $countries = [];
        $all_countries = \App\Models\BranchCountry::where('active', 'yes')->orderBy('sort', 'asc')->get();
        foreach ($all_countries as $one_country) {
            $country['id'] = $one_country['id'];
            $country['name'] = $one_country[$this->lang . '_name'];
            $country['image'] = url('upload/branches_countries/' . $one_country['map_mobile']);
            $country['branches'] = [];
            foreach ($one_country['BranchesActive'] as $one_branch) {
                $branch['id'] = $one_branch['id'];
                $branch['name'] = $one_branch[$this->lang . '_name'];
                $branch['desc'] = $one_branch[$this->lang . '_desc'];
                $branch['work_days'] = $one_branch[$this->lang . '_work_days'];
                $branch['work_time'] = $one_branch[$this->lang . '_work_time'];
                $branch['phone'] = $one_branch['phone'];
                $branch['map'] = $one_branch['map'];
                array_push($country['branches'], $branch);
            }
            array_push($countries, $country);
        }

        $response['status'] = 1;
        $response['message'] = trans('admin.branches');
        $response['data'] = $countries;
        return Response()->json($response);
    }

    public function setting() {
        $pages = \App\Models\Page::WhereNotIn('id', [5, 6])->select(['id', $this->lang . '_title as title'])->get();

        $current_currency = $this->currency[$this->lang . '_currency'];
        $version = \App\Models\Site::first()->ios_version_text;

        $currencies = [];
        $all_currencies = \App\Models\Currency::where('active', 'yes')->orderBy('sort', 'asc')->get();
        foreach ($all_currencies as $one_currency) {
            $currency['id'] = $one_currency['id'];
            $currency['name'] = $one_currency[$this->lang . '_currency'];
            $currency['desc'] = '(' . $one_currency[$this->lang . '_name'] . ')';
            $currency['image'] = url('upload/currencies/' . $one_currency['image']);
            $currency['selected'] = 'no';
            if ($one_currency['id'] == $this->currency['id']) {
                $currency['selected'] = 'yes';
            }
            array_push($currencies, $currency);
        }

        $response['status'] = 1;
        $response['message'] = trans('admin.site');
        $response['data'] = ['pages' => $pages, 'currencies' => $currencies, 'current_currency' => $current_currency, 'version' => $version];
        return Response()->json($response);
    }

    public function page($id) {
        $one_page = \App\Models\Page::find($id);
        $page['title'] = $one_page[$this->lang . '_title'];
        $page['content'] = $one_page[$this->lang . '_desc'];
        $page['image'] = '';
        if ($one_page['image'] != '') {
            $page['image'] = url('upload/pages/' . $one_page['image']);
        }

        $response['status'] = 1;
        $response['message'] = $page['title'];
        $response['data'] = $page;
        return Response()->json($response);
    }

    public function contact_get() {
        $site = \App\Models\Site::select(['email', 'phone'])->first();

        $response['status'] = 1;
        $response['message'] = trans('admin.contact');
        $response['data'] = $site;
        return Response()->json($response);
    }

    public function contact_post(Request $request) {
        $validator = Validator::make($request->all(), [
                    "email" => "required|email",
                    "name" => "required",
                    "phone" => "required|numeric",
                    "message" => "required",
        ]);

        if ($validator->fails()) {
            $status = 0;
            $message = "";
            foreach ($validator->errors()->all() as $one_error) {
                if ($message == "") {
                    $message = $one_error;
                } else {
                    $message = $message . ', ' . $one_error;
                }
            }
            return Response()->json(['status' => 0, 'message' => $message], 422);
        } else {
            $new = new \App\Models\Contact();
            $new->name = $request['name'];
            $new->phone = $request['phone'];
            $new->email = $request['email'];
            $new->message = $request['message'];
            $new->save();

//            Mail::send('emails.contact', ['name' => $request['name'], 'email' => $request['email'], 'phone' => $request['phone'], 'messagee' => $request['message']], function ($message) use ($request) {
//                $message->to($request['email']);
//                $message->subject(trans('admin.contact_message'));
//            });

            $status = 1;
            $message = trans('admin.contact_suc');
        }
        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = (object) [];

        return Response()->json($response);
    }

    public function notifications() {
        if ($this->user_id == 0) {
            $notifications_id = \App\Models\Notification::where('to_id', 0)->pluck('id')->toArray();
        } else {
            $notifications_general = \App\Models\Notification::where('to_id', 0)->whereIn('platform', ['all', $this->platform])->pluck('id')->toArray();
            $notifications_private = \App\Models\Notification::where('to_id', $this->user_id)->pluck('id')->toArray();
            $notifications_id = array_merge($notifications_private, $notifications_general);
        }
        $all_notifications = \App\Models\Notification::whereIn('id', $notifications_id)->orderBy('id', 'desc')->paginate(10);

        $info['current_page'] = $all_notifications->currentPage();
        $info['first_page_url'] = "";
        $info['last_page'] = $all_notifications->lastPage();
        $info['last_page_url'] = "";
        $info['next_page_url'] = $all_notifications->nextPageUrl();
        $info['path'] = $all_notifications->url($all_notifications['current_page']);
        $info['per_page'] = $all_notifications->perPage();
        $info['prev_page_url'] = $all_notifications->previousPageUrl();
        $info['to'] = $all_notifications->count();
        $info['total'] = $all_notifications->total();
        $notifications = [];
        foreach ($all_notifications as $one_notification) {
            $notification['id'] = $one_notification['id'];
            $notification['title'] = $one_notification[$this->lang . '_title'];
            $notification['message'] = $one_notification[$this->lang . '_message'];
            $notification['order_id'] = $one_notification['rel_id'];
            $date1 = new \DateTime($one_notification['created_at']);
            $date2 = $date1->diff(new \DateTime(date("Y-m-d H:i:s")));
            if ($date2->y > 0) {
                $notification['date'] = $date2->y . ' Y';
            } elseif ($date2->m > 0) {
                $notification['date'] = $date2->m . ' M';
            } elseif ($date2->d > 0) {
                $notification['date'] = $date2->d . ' D';
            } elseif ($date2->h > 0) {
                $notification['date'] = $date2->h . ' H';
            } elseif ($date2->i > 0) {
                $notification['date'] = $date2->i . ' m';
            } elseif ($date2->s > 0) {
                $notification['date'] = $date2->s . ' s';
            } else {
                $notification['date'] = 'Now';
            }

            array_push($notifications, $notification);
        }

        $response['status'] = 1;
        $response['message'] = trans('api.notifications');
        $response['data'] = ['notifications' => $notifications, 'info' => $info];
        return Response()->json($response);
    }

    public function countries() {
        $countries = [];
        $all_countries = \App\Models\Country::where('active', 'yes')->orderBy($this->lang . '_name', 'asc')->get();
        foreach ($all_countries as $one_country) {
            $country['id'] = $one_country['id'];
            $country['currency_id'] = $one_country['currency_id'];
            $country['name'] = $one_country[$this->lang . '_name'];
            $country['code'] = $one_country['code'];
            $country['cities'] = [];
            $all_cities = \App\Models\City::where('active', 'yes')->where('country_id', $one_country['id'])->orderBy($this->lang . '_name', 'asc')->get();
            foreach ($all_cities as $one_city) {
                $city['id'] = $one_city['id'];
                $city['name'] = $one_city[$this->lang . '_name'];
                array_push($country['cities'], $city);
            }
            if (count($country['cities']) > 0) {
                array_push($countries, $country);
            }
        }
        $response['status'] = 1;
        $response['message'] = trans('admin.countries');
        $response['data'] = ['countries' => $countries];
        return Response()->json($response);
    }

    public function reorder($id) {
        $order = \App\Models\Order::find($id);

        foreach ($order['Products'] as $one_product) {
            if ($one_product['Product']['active'] == 'yes') {
                $product = \App\Models\Product::find($one_product['product_id']);

                if ($this->user_id > 0) {
                    $found = \App\Models\Cart::where('user_id', $this->user_id)->where('product_id', $one_product['product_id'])->first();
                    $user_id = $this->user_id;
                    $key_id = '';
                } else {
                    $found = \App\Models\Cart::where('key_id', $this->firebase_token)->where('product_id', $one_product['product_id'])->first();
                    $user_id = '';
                    $key_id = $this->firebase_token;
                }

                if ($found) {
                    if ($product['purchasable_type'] == 'limited' && $found->quantity + $one_product['count'] > $product['purchasable']) {
                        $status = 0;
                        $message = trans('admin.purchasable_error') . ' ' . $product['purchasable'] . ' ' . trans('admin.purchasable_errorr');
                    } elseif ($found->quantity + $one_product['count'] > $product['quantity']) {
                        $status = 0;
                        $message = trans('admin.purchasable_error') . ' ' . $product['quantity'] . ' ' . trans('admin.purchasable_errorr');
                    } else {
                        $found->quantity = $found->quantity + $one_product['count'];
                        $found->save();
                    }
                } else {
                    if ($product['purchasable_type'] == 'limited' && $one_product['count'] > $product['purchasable']) {
                        $status = 0;
                        $message = trans('admin.purchasable_error') . ' ' . $product['purchasable'] . ' ' . trans('admin.purchasable_errorr');
                    } elseif ($one_product['count'] > $product['quantity']) {
                        $status = 0;
                        $message = trans('admin.purchasable_error') . ' ' . $product['quantity'] . ' ' . trans('admin.purchasable_errorr');
                    } else {
                        $new = new \App\Models\Cart();
                        $new->user_id = $user_id;
                        $new->key_id = $key_id;
                        $new->product_id = $one_product['product_id'];
                        $new->quantity = $one_product['count'];
                        $new->save();
                    }
                }
            }
        }

        $response['status'] = 1;
        $response['message'] = trans('admin.suc_reorder');
        $response['data'] = (object) [];
        return Response()->json($response);
    }

}

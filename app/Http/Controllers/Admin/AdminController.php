<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryStep;
use Illuminate\Support\Arr;

class AdminController extends Controller {

    //
    function __construct(CategoryStep $CategoryStep) {
        $this->category_step = $CategoryStep;
    }

    public function getLogin() {
        if (Auth::Check()) {
            return redirect('admin');
        }
        return view('admin.home.login');
    }

    public function postLogin() {
        $inputs = Request()->all();

        $remember = FALSE;
        if (isset($inputs['remember'])) {
            $remember = TRUE;
        }
        if (Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password'], 'type' => 'admin', 'deleted_at' => null], $remember)) {
            $active = Auth::user()->active;
            if ($active == 'yes') {
                $action = new \App\Models\Action();
                $action->user_id = Auth::User()->id;
                $action->ar_action = 'قام بتسجيل الدخول للوحة التحكم';
                $action->en_action = 'Login to dashboard';
                $action->ip = request()->ip();
                $action->save();

                return redirect()->intended('admin');
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
        $action->en_action = 'Logout from admin dashboard';
        $action->ip = request()->ip();
        $action->save();

        Auth::logout();
        return redirect('admin/login');
    }

    public function index() {
        if (!Auth::Check()) {
            return redirect('admin/login');
        }
        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بفتح الرئيسية للوحة التحكم';
        $action->en_action = 'Go to admin dashboard homepage';
        $action->ip = request()->ip();
        $action->save();

        return view('admin.home.index');
    }

    public function not_allow() {
        return view('admin.home.deny');
    }

    public function delete_all($type) {
        $request = request()->all();
        if ($type == 'categories_steps') {
            $permission = \App\Models\Permission::where('group_id', Auth::User()->group_id)->where('permission', 'categories_delete')->count();
        } else {
            $permission = \App\Models\Permission::where('group_id', Auth::User()->group_id)->where('permission', $type . '_delete')->count();
        }
        if ($permission == 0) {
            $error = trans('admin.not_allow');
            return back()->with(['error' => $error]);
        }

        if ($type == 'countries') {
            \App\Models\Country::whereIn('id', $request['ids'])->delete();
            \App\Models\City::whereIn('country_id', $request['ids'])->delete();
            \App\Models\Address::whereIn('country_id', $request['ids'])->delete();
            $ar_message = 'قام بحذف كل الدول';
            $en_message = 'Delete all countries';
        } elseif ($type == 'groups') {
            \App\Models\Group::whereIn('id', $request['ids'])->delete();
            \App\Models\Permission::whereIn('group_id', $request['ids'])->delete();
            $ar_message = 'قام بحذف كل الصلاحيات';
            $en_message = 'Delete all supervisors powers';
        } elseif ($type == 'admins') {
            $admins = \App\Models\User::whereIn('id', $request['ids'])->get();
            foreach ($admins as $admin) {
                $admin->active = 'delete';
                $admin->deleted_at = now();
                $admin->save();
            }
            $ar_message = 'قام بحذف كل المشرفين';
            $en_message = 'Delete all supervisors';
        } elseif ($type == 'users') {
            $users = \App\Models\User::whereIn('id', $request['ids'])->get();
            foreach ($users as $user) {
                $user->active = 'delete';
                $user->deleted_at = now();
                $user->save();
            }
            $ar_message = 'قام بحذف كل الأعضاء';
            $en_message = 'Delete all users';
        } elseif ($type == 'categories') {
            $categories = \App\Models\Category::whereIn('id', $request['ids'])->get();
            foreach ($categories as $category) {
                $category->active = 'delete';
                $category->deleted_at = now();
                $category->save();
            }
            $ar_message = 'قام بحذف كل أنواع المشاريع';
            $en_message = 'Delete all projects types';
        } elseif ($type == 'categories_steps') {
            $categories_steps = \App\Models\CategoryStep::whereIn('id', $request['ids'])->get();
            foreach ($categories_steps as $category_step) {
                $category_step->active = 'delete';
                $category_step->deleted_at = now();
                $category_step->save();
            }
            $ar_message = 'قام بحذف كل مراحل أنواع المشاريع';
            $en_message = 'Delete all projects types steps';
        } elseif ($type == 'portfolio') {
            \App\Models\UserPortfolio::whereIn('id', $request['ids'])->delete();
            $ar_message = 'قام بحذف كل إعمال الشركات';
            $en_message = 'Delete all companies portfolio';
        } elseif ($type == 'gifts') {
            $gifts = \App\Models\Gift::whereIn('id', $request['ids'])->get();
            foreach ($gifts as $gift) {
                $gift->active = 'delete';
                $gift->deleted_at = now();
                $gift->save();
            }
            $ar_message = 'قام بحذف كل الهدايا';
            $en_message = 'Delete all gifts';
        } elseif ($type == 'tutorials') {
            \App\Models\Tutorial::whereIn('id', $request['ids'])->delete();
            $ar_message = 'قام بحذف كل التعريف بالتطبيق';
            $en_message = 'Delete all tutorials';
        } elseif ($type == 'ads') {
            \App\Models\Ads::whereIn('id', $request['ids'])->delete();
            $ar_message = 'قام بحذف كل الإعلانات';
            $en_message = 'Delete all ads';
        } elseif ($type == 'slider') {
            \App\Models\Slider::whereIn('id', $request['ids'])->delete();
            $ar_message = 'قام بحذف كل الصور بعارض الصور';
            $en_message = 'Delete all images in slider';
        } elseif ($type == 'pages') {
            \App\Models\Page::whereIn('id', $request['ids'])->where('id', '>', 1)->delete();
            $ar_message = 'قام بحذف كل صفحات الموقع';
            $en_message = 'Delete all website pages';
        } elseif ($type == 'contact') {
            \App\Models\Contact::whereIn('id', $request['ids'])->delete();
            $ar_message = 'قام بحذف كل رسائل الإتصال بنا';
            $en_message = 'Delete all messages in contact us';
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = $ar_message;
        $action->en_action = $en_message;
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

    public function edit_active($type, $id) {
        if ($type == 'families_members') {
            $permission = \App\Models\Permission::where('group_id', Auth::User()->group_id)->where('permission', 'families_edit')->count();
        } elseif ($type == 'teachers_videos') {
            $permission = \App\Models\Permission::where('group_id', Auth::User()->group_id)->where('permission', 'teachers_edit')->count();
        } elseif ($type == 'categories_steps') {
            $permission = \App\Models\Permission::where('group_id', Auth::User()->group_id)->where('permission', 'categories_edit')->count();
        } else {
            $permission = \App\Models\Permission::where('group_id', Auth::User()->group_id)->where('permission', $type . '_edit')->count();
        }
        if ($permission == 0) {
            $data['status'] = 0;
            $data['message'] = trans('admin.not_allow');
            return response()->json($data);
        }

        if ($type == 'countries') {
            $country = \App\Models\Country::find($id);
            if ($country['active'] == 'yes') {
                $country->active = 'no';
            } elseif ($country['active'] == 'no') {
                $country->active = 'yes';
            }
            $country->save();
            $ar_message = 'قام بتعديل تفعيل الدولة : ' . $country['ar_name'];
            $en_message = 'Edit Activation of country : ' . $country['en_name'];
        } elseif ($type == 'admins') {
            $admin = \App\Models\User::find($id);
            if ($admin['active'] == 'yes') {
                $admin->active = 'no';
            } elseif ($admin['active'] == 'no') {
                $admin->active = 'yes';
            }
            $admin->save();
            $ar_message = 'قام بتعديل تفعيل الموظف : ' . $admin['name'];
            $en_message = 'Edit Activation of employee : ' . $admin['name'];
        } elseif ($type == 'users') {
            $user = \App\Models\User::find($id);
            if ($user['active'] == 'yes') {
                $user->active = 'no';
            } elseif ($user['active'] == 'no') {
                $user->active = 'yes';
            }
            $user->save();
            $ar_message = 'قام بتعديل تفعيل العضو : ' . $user['name'];
            $en_message = 'Edit Activation of user : ' . $user['name'];
        } elseif ($type == 'categories') {
            $category = \App\Models\Category::find($id);
            if ($category['active'] == 'yes') {
                $category->active = 'no';
            } elseif ($category['active'] == 'no') {
                $category->active = 'yes';
            }
            $category->save();
            $ar_message = 'قام بتعديل تفعيل نوع مشروع : ' . $category['ar_name'];
            $en_message = 'Edit Activation of project type : ' . $category['en_name'];
        } elseif ($type == 'categories_steps') {
            $category_step = \App\Models\CategoryStep::find($id);
            if ($category_step['active'] == 'yes') {
                $category_step->active = 'no';
            } elseif ($category_step['active'] == 'no') {
                $category_step->active = 'yes';
            }
            $category_step->save();
            $ar_message = 'قام بتعديل تفعيل مرحلة نوع مشروع : ' . $category_step['ar_name'];
            $en_message = 'Edit Activation of project type step : ' . $category_step['en_name'];
        } elseif ($type == 'companies') {
            $company = \App\Models\User::find($id);
            if ($company['active'] == 'yes') {
                $company->active = 'no';
            } elseif ($company['active'] == 'no') {
                $company->active = 'yes';
            }
            $company->save();
            $ar_message = 'قام بتعديل تفعيل الشركة : ' . $company['ar_name'];
            $en_message = 'Edit Activation of company : ' . $company['en_name'];
        } elseif ($type == 'portfolio') {
            $portfolio = \App\Models\UserPortfolio::find($id);
            if ($portfolio['active'] == 'yes') {
                $portfolio->active = 'no';
            } elseif ($portfolio['active'] == 'no') {
                $portfolio->active = 'yes';
            }
            $portfolio->save();
            $ar_message = 'قام بتعديل تفعيل العمل : ' . $portfolio['ar_name'];
            $en_message = 'Edit Activation of portfolio : ' . $portfolio['en_name'];
        } elseif ($type == 'projects') {
            $project = \App\Models\Project::find($id);
            if ($project['active'] == 'yes') {
                $project->active = 'no';
            } elseif ($project['active'] == 'no') {
                $project->active = 'yes';
            }
            $project->save();
            $ar_message = 'قام بتعديل تفعيل المشروع : ' . $project['ar_name'];
            $en_message = 'Edit Activation of project : ' . $project['en_name'];
        } elseif ($type == 'gifts') {
            $gift = \App\Models\Gift::find($id);
            if ($gift['active'] == 'yes') {
                $gift->active = 'no';
            } elseif ($gift['active'] == 'no') {
                $gift->active = 'yes';
            }
            $gift->save();
            $ar_message = 'قام بتعديل تفعيل الهدية : ' . $gift['ar_name'];
            $en_message = 'Edit Activation of gift : ' . $gift['en_name'];
        } elseif ($type == 'childern') {
            $child = \App\Models\Child::find($id);
            if ($child['active'] == 'yes') {
                $child->active = 'no';
            } elseif ($child['active'] == 'no') {
                $child->active = 'yes';
            }
            $child->save();
            $ar_message = 'قام بتعديل تفعيل كفالة طفل : ' . $child['ar_name'];
            $en_message = 'Edit Activation of child sponsorship : ' . $child['en_name'];
        } elseif ($type == 'families') {
            $family = \App\Models\Family::find($id);
            if ($family['active'] == 'yes') {
                $family->active = 'no';
            } elseif ($family['active'] == 'no') {
                $family->active = 'yes';
            }
            $family->save();
            $ar_message = 'قام بتعديل تفعيل كفالة أسرة : ' . $family['ar_name'];
            $en_message = 'Edit Activation of family sponsorship : ' . $family['en_name'];
        } elseif ($type == 'families_members') {
            $family_member = \App\Models\FamilyMember::find($id);
            if ($family_member['active'] == 'yes') {
                $family_member->active = 'no';
            } elseif ($family_member['active'] == 'no') {
                $family_member->active = 'yes';
            }
            $family_member->save();
            $ar_message = 'قام بتعديل تفعيل عضو أسرة : ' . $family_member['ar_name'];
            $en_message = 'Edit Activation of family member : ' . $family_member['en_name'];
        } elseif ($type == 'teachers') {
            $teacher = \App\Models\Teacher::find($id);
            if ($teacher['active'] == 'yes') {
                $teacher->active = 'no';
            } elseif ($teacher['active'] == 'no') {
                $teacher->active = 'yes';
            }
            $teacher->save();
            $ar_message = 'قام بتعديل تفعيل كفالة داعية : ' . $teacher['ar_name'];
            $en_message = 'Edit Activation of teacher sponsorship : ' . $teacher['en_name'];
        } elseif ($type == 'teachers_videos') {
            $teacher_video = \App\Models\TeacherVideo::find($id);
            if ($teacher_video['active'] == 'yes') {
                $teacher_video->active = 'no';
            } elseif ($teacher_video['active'] == 'no') {
                $teacher_video->active = 'yes';
            }
            $teacher_video->save();
            $ar_message = 'قام بتعديل تفعيل محاضرة داعية : ' . $teacher_video['ar_name'];
            $en_message = 'Edit Activation of teacher lecture : ' . $teacher_video['en_name'];
        } elseif ($type == 'tutorials') {
            $tutorial = \App\Models\Tutorial::find($id);
            if ($tutorial['active'] == 'yes') {
                $tutorial->active = 'no';
            } elseif ($tutorial['active'] == 'no') {
                $tutorial->active = 'yes';
            }
            $tutorial->save();
            $ar_message = 'قام بتعديل تفعيل التعريف : ' . $tutorial['ar_name'];
            $en_message = 'Edit Activation of tutorial : ' . $tutorial['en_name'];
        } elseif ($type == 'ads') {
            $ads = \App\Models\Ads::find($id);
            if ($ads['active'] == 'yes') {
                $ads->active = 'no';
            } elseif ($ads['active'] == 'no') {
                $ads->active = 'yes';
            }
            $ads->save();
            $ar_message = 'قام بتعديل تفعيل الاعلان : ' . $ads['ar_name'];
            $en_message = 'Edit Activation of ads : ' . $ads['en_name'];
        } elseif ($type == 'slider') {
            $slider = \App\Models\Slider::find($id);
            if ($slider['active'] == 'yes') {
                $slider->active = 'no';
            } elseif ($slider['active'] == 'no') {
                $slider->active = 'yes';
            }
            $slider->save();
            $ar_message = 'قام بتعديل تفعيل الاعلان : ' . $slider['ar_name'];
            $en_message = 'Edit Activation of ads : ' . $slider['en_name'];
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = $ar_message;
        $action->en_action = $en_message;
        $action->ip = request()->ip();
        $action->save();

        $data['status'] = 1;
        $data['message'] = trans('admin.edit_suc');
        return response()->json($data);
    }

    public function ajax_categories_steps($id) {
        $categories_steps = $this->category_step->getListCategory($id);
        $categories_steps = Arr::add($categories_steps, '', trans('admin.choose'));
        $categories_steps = array_reverse($categories_steps, TRUE);
        $value = request()->get('value');
        return view('admin.home.ajax_categories_steps', ['categories_steps' => $categories_steps, 'value' => $value]);
    }

}

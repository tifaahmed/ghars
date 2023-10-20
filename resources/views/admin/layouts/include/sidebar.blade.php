<?php
$lang = App::getLocale();
$float = "right";
if ($lang == "en") {
    $float = "left";
}
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" dir="{{$dir}}">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="background-size: 100% 100%; padding-top: 120px; height: 150px;">

            <div class="clearfix"></div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree" style="padding-bottom: 50px;">
            <?php
            $url = URL::current();
            $profile = $site = $social_media = $currencies = $countries = $log = $notifications = $groups = $admins = $users  = $visitors= $categories = $companies = $portfolio = $projects = $gifts = $childern = $families = $teachers = $donations = $tutorials = $ads = $slider = $pages = $contact = $ideas = $admin = "";

            if (strpos($url, 'profile') !== false) {
                $profile = "active";
            } elseif (strpos($url, 'site') !== false) {
                $site = "active";
            } elseif (strpos($url, 'social_media') !== false) {
                $social_media = "active";
            } elseif (strpos($url, 'currencies') !== false) {
                $currencies = "active";
            } elseif (strpos($url, 'countries') !== false) {
                $countries = "active";
            } elseif (strpos($url, 'log') !== false) {
                $log = "active";
            } elseif (strpos($url, 'notifications') !== false) {
                $notifications = "active";
            } elseif (strpos($url, 'groups') !== false) {
                $groups = "active";
            } elseif (strpos($url, 'admins') !== false) {
                $admins = "active";
            } elseif (strpos($url, 'users') !== false) {
                $users = "active";
            } elseif (strpos($url, 'visitors') !== false) {
                $visitors = "active";
            } elseif (strpos($url, 'categories') !== false) {
                $categories = "active";
            } elseif (strpos($url, 'companies') !== false) {
                $companies = "active";
            } elseif (strpos($url, 'portfolio') !== false) {
                $portfolio = "active";
            } elseif (strpos($url, 'projects') !== false) {
                $projects = "active";
            } elseif (strpos($url, 'gifts') !== false) {
                $gifts = "active";
            } elseif (strpos($url, 'childern') !== false) {
                $childern = "active";
            } elseif (strpos($url, 'families') !== false) {
                $families = "active";
            } elseif (strpos($url, 'teachers') !== false) {
                $teachers = "active";
            } elseif (strpos($url, 'donations') !== false) {
                $donations = "active";
            } elseif (strpos($url, 'tutorials') !== false) {
                $tutorials = "active";
            } elseif (strpos($url, 'ads') !== false) {
                $ads = "active";
            } elseif (strpos($url, 'slider') !== false) {
                $slider = "active";
            } elseif (strpos($url, 'pages') !== false) {
                $pages = "active";
            } elseif (strpos($url, 'contact') !== false) {
                $contact = "active";
            } elseif (strpos($url, 'ideas') !== false) {
                $ideas = "active";
            } else {
                $admin = "active";
            }

            $site_role = $social_media_role = $currencies_role = $countries_role = $log_role = $notifications_role = $groups_role = $admins_role = $users_role = $visitors_role = $categories_role = $companies_role = $portfolio_role = $projects_role = $gifts_role = $childern_role = $families_role = $teachers_role = $donations_role = $tutorials_role = $ads_role = $slider_role = $pages_role = $contact_role = $ideas_role = FALSE;

            foreach (Auth::User()->Group->Permissions as $permission) {
                if ($permission['permission'] == 'site_edit') {
                    $site_role = TRUE;
                } elseif ($permission['permission'] == 'social_media_all') {
                    $social_media_role = TRUE;
                } elseif ($permission['permission'] == 'currencies_all') {
                    $currencies_role = TRUE;
                } elseif ($permission['permission'] == 'countries_all') {
                    $countries_role = TRUE;
                } elseif ($permission['permission'] == 'log_all') {
                    $log_role = TRUE;
                } elseif ($permission['permission'] == 'notifications_all' || $permission['permission'] == 'notifications_add') {
                    $notifications_role = TRUE;
                } elseif ($permission['permission'] == 'groups_all' || $permission['permission'] == 'groups_add') {
                    $groups_role = TRUE;
                } elseif ($permission['permission'] == 'admins_all' || $permission['permission'] == 'admins_add') {
                    $admins_role = TRUE;
                } elseif ($permission['permission'] == 'users_all' || $permission['permission'] == 'users_add') {
                    $users_role = TRUE;
                } elseif ($permission['permission'] == 'visitors_all') {
                    $visitors_role = TRUE;
                } elseif ($permission['permission'] == 'categories_all' || $permission['permission'] == 'categories_add') {
                    $categories_role = TRUE;
                } elseif ($permission['permission'] == 'companies_all' || $permission['permission'] == 'companies_add') {
                    $companies_role = TRUE;
                } elseif ($permission['permission'] == 'portfolio_all' || $permission['permission'] == 'portfolio_add') {
                    $portfolio_role = TRUE;
                } elseif ($permission['permission'] == 'projects_all' || $permission['permission'] == 'projects_add') {
                    $projects_role = TRUE;
                } elseif ($permission['permission'] == 'gifts_all' || $permission['permission'] == 'gifts_add') {
                    $gifts_role = TRUE;
                } elseif ($permission['permission'] == 'childern_all' || $permission['permission'] == 'childern_add') {
                    $childern_role = TRUE;
                } elseif ($permission['permission'] == 'families_all' || $permission['permission'] == 'families_add') {
                    $families_role = TRUE;
                } elseif ($permission['permission'] == 'teachers_all' || $permission['permission'] == 'teachers_add') {
                    $teachers_role = TRUE;
                } elseif ($permission['permission'] == 'donations_all') {
                    $donations_role = TRUE;
                } elseif ($permission['permission'] == 'tutorials_all' || $permission['permission'] == 'tutorials_add') {
                    $tutorials_role = TRUE;
                } elseif ($permission['permission'] == 'ads_all' || $permission['permission'] == 'ads_add') {
                    $ads_role = TRUE;
                } elseif ($permission['permission'] == 'slider_all' || $permission['permission'] == 'slider_add') {
                    $slider_role = TRUE;
                } elseif ($permission['permission'] == 'pages_all' || $permission['permission'] == 'pages_add') {
                    $pages_role = TRUE;
                } elseif ($permission['permission'] == 'contact_all') {
                    $contact_role = TRUE;
                } elseif ($permission['permission'] == 'ideas_all') {
                    $ideas_role = TRUE;
                }
            }
            ?>
            <li class="">
                <a href="{{URL::to('lang')}}">
                    <i class="fa fa-language"></i>
                    @if($lang == "ar")
                    <span>English Version</span>
                    @else
                    <span>النسخة العربية</span>
                    @endif
                </a>
            </li>

            <li class="">
                <a href="{{URL::to('/')}}">
                    <i class="fa fa-home"></i>
                    <span>{{trans('admin.website')}}</span>
                </a>
            </li>

            <li class="{{$admin}}">
                <a href="{{URL::to('admin')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{trans('admin.admin')}}</span>
                </a>
            </li>

            <li class="{{$profile}}">
                <a href="{{URL::to('admin/profile')}}">
                    <i class="fa fa-user"></i>
                    <span>{{trans('admin.profile')}}</span>
                </a>
            </li>

            @if($site_role)
            <li class="{{$site}}">
                <a href="{{URL::to('admin/site')}}">
                    <i class="fa fa-globe"></i>
                    <span>{{trans('admin.site')}}</span>
                </a>
            </li>
            @endif

            @if($social_media_role)
            <li class="{{$social_media}}">
                <a href="{{URL::to('admin/social_media')}}">
                    <i class="fa fa-instagram"></i>
                    <span>{{trans('admin.social_media')}}</span>
                </a>
            </li>   
            @endif

            @if($currencies_role)
            <li class="{{$currencies}}">
                <a href="{{URL::to('admin/currencies')}}">
                    <i class="fa fa-usd"></i>
                    <span>{{trans('admin.currencies')}}</span>
                </a>
            </li>   
            @endif

            @if($countries_role)
            <li class="{{$countries}}">
                <a href="{{URL::to('admin/countries')}}">
                    <i class="fa fa-globe"></i>
                    <span>{{trans('admin.countries')}}</span>
                </a>
            </li>   
            @endif

            @if($log_role)
            <li class="{{$log}}">
                <a href="{{URL::to('admin/log')}}">
                    <i class="fa fa-tasks"></i>
                    <span>{{trans('admin.log')}}</span>
                </a>
            </li>   
            @endif

            @if($notifications_role)
            <li class="{{$notifications}}">
                <a href="{{URL::to('admin/notifications')}}">
                    <i class="fa fa-bell"></i>
                    <span>{{trans('admin.notifications')}}</span>
                </a>
            </li>   
            @endif

            <hr style="background: #fff;">

            @if($groups_role)
            <li class="treeview {{$groups}}">
                <a href="#">
                    <i class="fa fa-key"></i>
                    <span>{{trans('admin.groups')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/groups')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/groups/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.group_add')}}</a></li>
                </ul>
            </li>
            @endif

            @if($admins_role)
            <li class="treeview {{$admins}}">
                <a href="#">
                    <i class="fa fa-user-secret"></i>
                    <span>{{trans('admin.admins')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/admins')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/admins/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.admin_add')}}</a></li>
                </ul>
            </li>
            @endif

            @if($users_role)
            <li class="treeview {{$users}}">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>{{trans('admin.users')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/users')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/users/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.user_add')}}</a></li>
                </ul>
            </li>
            @endif

            @if($visitors_role)
            <li class="{{$visitors}}">
                <a href="{{URL::to('admin/visitors')}}">
                    <i class="fa fa-users"></i>
                    <span>{{trans('admin.visitors')}}</span>
                </a>
            </li>
            @endif

            @if($groups_role || $admins_role || $users_role || $visitors_role)
            <hr style="background: #fff;">
            @endif 

            @if($categories_role)
            <li class="treeview {{$categories}}">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span>{{trans('admin.categories')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/categories')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/categories/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.category_add')}}</a></li>
                </ul>
            </li>
            @endif

            @if($companies_role)
            <li class="treeview {{$companies}}">
                <a href="#">
                    <i class="fa fa-university"></i>
                    <span>{{trans('admin.companies')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/companies')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/companies/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.company_add')}}</a></li>
                </ul>
            </li>
            @endif

            @if($portfolio_role)
            <li class="treeview {{$portfolio}}">
                <a href="#">
                    <i class="fa fa-star"></i>
                    <span>{{trans('admin.portfolio')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/portfolio')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/portfolio/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.portfolio_add')}}</a></li>
                </ul>
            </li>
            @endif

            @if($projects_role)
            <li class="treeview {{$projects}}">
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>{{trans('admin.projects')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/projects')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/projects/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.project_add')}}</a></li>
                </ul>
            </li>
            @endif

            @if($categories_role || $companies_role || $portfolio_role || $projects_role)
            <hr style="background: #fff;">
            @endif 

            @if($gifts_role)
            <li class="treeview {{$gifts}}">
                <a href="#">
                    <i class="fa fa-gift"></i>
                    <span>{{trans('admin.gifts')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/gifts')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/gifts/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.gift_add')}}</a></li>
                </ul>
            </li>
            @endif

            @if($childern_role)
            <li class="treeview {{$childern}}">
                <a href="#">
                    <i class="fa fa-child"></i>
                    <span>{{trans('admin.childern')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/childern')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/childern/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.child_add')}}</a></li>
                </ul>
            </li>
            @endif
            
            @if($families_role)
            <li class="treeview {{$families}}">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{trans('admin.families')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/families')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/families/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.family_add')}}</a></li>
                </ul>
            </li>
            @endif
            
            @if($teachers_role)
            <li class="treeview {{$teachers}}">
                <a href="#">
                    <i class="fa fa-briefcase"></i>
                    <span>{{trans('admin.teachers')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/teachers')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/teachers/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.teacher_add')}}</a></li>
                </ul>
            </li>
            @endif
            
            @if($donations_role)
            <li class="{{$donations}}">
                <a href="{{URL::to('admin/donations')}}">
                    <i class="fa fa-money"></i>
                    <span>{{trans('admin.donations')}}</span>
                </a>
            </li>
            @endif
            
            @if($gifts_role || $childern_role || $families_role || $students_role || $teachers_role || $donations_role)
            <hr style="background: #fff;">
            @endif 

            @if($tutorials_role)
            <li class="treeview {{$tutorials}}">
                <a href="#">
                    <i class="fa fa-windows"></i>
                    <span>{{trans('admin.tutorials')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/tutorials')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/tutorials/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.tutorial_add')}}</a></li>
                </ul>
            </li>
            @endif

            @if($ads_role)
            <li class="treeview {{$ads}}">
                <a href="#">
                    <i class="fa fa-camera"></i>
                    <span>{{trans('admin.ads')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/ads')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/ads/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.ads_add')}}</a></li>
                </ul>
            </li>
            @endif

            @if($slider_role)
            <li class="treeview {{$slider}}">
                <a href="#">
                    <i class="fa fa-photo"></i>
                    <span>{{trans('admin.slider')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/slider')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/slider/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.slider_add')}}</a></li>
                </ul>
            </li>   
            @endif

            @if($pages_role)
            <li class="treeview {{$pages}}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>{{trans('admin.pages')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('admin/pages')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('admin/pages/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.page_add')}}</a></li>
                </ul>
            </li>   
            @endif

            @if($contact_role)
            <li class="{{$contact}}">
                <a href="{{URL::to('admin/contact')}}">
                    <i class="fa fa-phone-square"></i>
                    <span>{{trans('admin.contact')}}</span>
                </a>
            </li>
            @endif

            @if($ideas_role)
            <li class="{{$ideas}}">
                <a href="{{URL::to('admin/ideas')}}">
                    <i class="fa fa-envelope"></i>
                    <span>{{trans('admin.ideas')}}</span>
                </a>
            </li>
            @endif

            @if($tutorials_role || $ads_role || $slider_role || $pages_role || $contact_role || $ideas_role)
            <hr style="background: #fff;">
            @endif

            <li class="">
                <a href="{{URL::to('admin/logout')}}">
                    <i class="fa fa-sign-out"></i>
                    <span>{{trans('admin.logout')}}</span>
                </a>
            </li>  

        </ul>
    </section>
    <!-- /.sidebar -->
    <div class="sidebar-footer">
        <!-- item-->
        <a href="{{URL::to('admin/site')}}" class="link" data-toggle="tooltip" title="" data-original-title="{{trans('admin.site')}}"><i class="fa fa-cog fa-spin"></i></a>
        <!-- item-->
        <a href="{{URL::to('admin/contact')}}" class="link" data-toggle="tooltip" title="" data-original-title="{{trans('admin.contact')}}"><i class="fa fa-envelope"></i></a>
        <!-- item-->
        <a href="{{URL::to('admin/logout')}}" class="link" data-toggle="tooltip" title="" data-original-title="{{trans('admin.logout')}}"><i class="fa fa-power-off"></i></a>
    </div>
</aside>
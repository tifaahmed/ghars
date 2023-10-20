<?php
$lang = App::getLocale();
$text = "text-left";
$pull = "pull-left";
if ($lang == "ar") {
    $text = "text-right";
    $pull = "pull-right";
}
?>
<header class="main-header" dir="{{$dir}}">
    <!-- Logo -->
    <a href="{{URL::to('dashboard')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{$site[$lang.'_title']}}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{URL::to('admin_panel')}}/images/avatarr.png" class="user-image rounded" alt="User Image">
                    </a>
                    <ul class="dropdown-menu scale-up">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{URL::to('admin_panel')}}/images/avatarr.png" class="rounded float-right" alt="User Image">

                            <p>
                                {{Auth::User()->name}}
                                <small>
                                    @if($lang == 'ar')
                                    {{Auth::User()->ar_name}}
                                    @else
                                    {{Auth::User()->en_name}}
                                    @endif
                                </small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{{URL::to('/')}}" class="btn btn-block btn-primary">{{trans('admin.website')}}</a>
                            </div>
                            <div class="pull-left">
                                <a href="{{URL::to('dashboard/logout')}}" class="btn btn-block btn-danger">{{trans('admin.logout')}}</a>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
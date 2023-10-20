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
            $profile = $portfolio = $projects = $dashboard = "";

            if (strpos($url, 'profile') !== false) {
                $profile = "active";
            } elseif (strpos($url, 'portfolio') !== false) {
                $portfolio = "active";
            } elseif (strpos($url, 'projects') !== false) {
                $projects = "active";
            } else {
                $dashboard = "active";
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

            <li class="{{$dashboard}}">
                <a href="{{URL::to('dashboard')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{trans('admin.admin')}}</span>
                </a>
            </li>

            <li class="{{$profile}}">
                <a href="{{URL::to('dashboard/profile')}}">
                    <i class="fa fa-user"></i>
                    <span>{{trans('admin.profile')}}</span>
                </a>
            </li>

            <li class="treeview {{$portfolio}}">
                <a href="#">
                    <i class="fa fa-star"></i>
                    <span>{{trans('admin.portfolio')}}</span>
                    <span class="pull-{{$arrow}}-container">
                        <i class="fa fa-angle-{{$arrow}} pull-{{$arrow}}"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('dashboard/portfolio')}}"><i class="fa fa-circle-o"></i> {{trans('admin.show_all')}}</a></li>
                    <li><a href="{{URL::to('dashboard/portfolio/create')}}"><i class="fa fa-circle-o"></i> {{trans('admin.portfolio_add')}}</a></li>
                </ul>
            </li>

            <li class="{{$projects}}">
                <a href="{{URL::to('dashboard/projects')}}">
                    <i class="fa fa-bar-chart"></i>
                    <span>{{trans('admin.projects')}}</span>
                </a>
            </li>            

            <li class="">
                <a href="{{URL::to('dashboard/logout')}}">
                    <i class="fa fa-sign-out"></i>
                    <span>{{trans('admin.logout')}}</span>
                </a>
            </li>  

        </ul>
    </section>
    <!-- /.sidebar -->
    <div class="sidebar-footer">
        <!-- item-->
        <a href="{{URL::to('dashboard')}}" class="link" data-toggle="tooltip" title="" data-original-title="{{trans('admin.home')}}"><i class="fa fa-home"></i></a>
        <!-- item-->
        <a href="{{URL::to('dashboard/profile')}}" class="link" data-toggle="tooltip" title="" data-original-title="{{trans('admin.profile')}}"><i class="fa fa-user"></i></a>
        <!-- item-->
        <a href="{{URL::to('dashboard/logout')}}" class="link" data-toggle="tooltip" title="" data-original-title="{{trans('admin.logout')}}"><i class="fa fa-power-off"></i></a>
    </div>
</aside>
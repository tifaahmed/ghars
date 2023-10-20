<?php
$lang = App::getLocale();
$float = "right";
if ($lang == "en") {
    $float = "left";
}
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" dir="<?php echo e($dir); ?>">
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
                <a href="<?php echo e(URL::to('lang')); ?>">
                    <i class="fa fa-language"></i>
                    <?php if($lang == "ar"): ?>
                    <span>English Version</span>
                    <?php else: ?>
                    <span>النسخة العربية</span>
                    <?php endif; ?>
                </a>
            </li>

            <li class="">
                <a href="<?php echo e(URL::to('/')); ?>">
                    <i class="fa fa-home"></i>
                    <span><?php echo e(trans('admin.website')); ?></span>
                </a>
            </li>

            <li class="<?php echo e($dashboard); ?>">
                <a href="<?php echo e(URL::to('dashboard')); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span><?php echo e(trans('admin.admin')); ?></span>
                </a>
            </li>

            <li class="<?php echo e($profile); ?>">
                <a href="<?php echo e(URL::to('dashboard/profile')); ?>">
                    <i class="fa fa-user"></i>
                    <span><?php echo e(trans('admin.profile')); ?></span>
                </a>
            </li>

            <li class="treeview <?php echo e($portfolio); ?>">
                <a href="#">
                    <i class="fa fa-star"></i>
                    <span><?php echo e(trans('admin.portfolio')); ?></span>
                    <span class="pull-<?php echo e($arrow); ?>-container">
                        <i class="fa fa-angle-<?php echo e($arrow); ?> pull-<?php echo e($arrow); ?>"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(URL::to('dashboard/portfolio')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('admin.show_all')); ?></a></li>
                    <li><a href="<?php echo e(URL::to('dashboard/portfolio/create')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('admin.portfolio_add')); ?></a></li>
                </ul>
            </li>

            <li class="<?php echo e($projects); ?>">
                <a href="<?php echo e(URL::to('dashboard/projects')); ?>">
                    <i class="fa fa-bar-chart"></i>
                    <span><?php echo e(trans('admin.projects')); ?></span>
                </a>
            </li>            

            <li class="">
                <a href="<?php echo e(URL::to('dashboard/logout')); ?>">
                    <i class="fa fa-sign-out"></i>
                    <span><?php echo e(trans('admin.logout')); ?></span>
                </a>
            </li>  

        </ul>
    </section>
    <!-- /.sidebar -->
    <div class="sidebar-footer">
        <!-- item-->
        <a href="<?php echo e(URL::to('dashboard')); ?>" class="link" data-toggle="tooltip" title="" data-original-title="<?php echo e(trans('admin.home')); ?>"><i class="fa fa-home"></i></a>
        <!-- item-->
        <a href="<?php echo e(URL::to('dashboard/profile')); ?>" class="link" data-toggle="tooltip" title="" data-original-title="<?php echo e(trans('admin.profile')); ?>"><i class="fa fa-user"></i></a>
        <!-- item-->
        <a href="<?php echo e(URL::to('dashboard/logout')); ?>" class="link" data-toggle="tooltip" title="" data-original-title="<?php echo e(trans('admin.logout')); ?>"><i class="fa fa-power-off"></i></a>
    </div>
</aside><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/dashboard/layouts/include/sidebar.blade.php ENDPATH**/ ?>
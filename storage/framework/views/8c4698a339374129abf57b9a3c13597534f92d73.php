<?php
$lang = App::getLocale();
$text = "text-left";
$pull = "pull-left";
if ($lang == "ar") {
    $text = "text-right";
    $pull = "pull-right";
}
?>
<header class="main-header" dir="<?php echo e($dir); ?>">
    <!-- Logo -->
    <a href="<?php echo e(URL::to('admin')); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?php echo e($site[$lang.'_title']); ?></b></span>
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
                        <img src="<?php echo e(URL::to('admin_panel')); ?>/images/avatarr.png" class="user-image rounded" alt="User Image">
                    </a>
                    <ul class="dropdown-menu scale-up">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo e(URL::to('admin_panel')); ?>/images/avatarr.png" class="rounded float-right" alt="User Image">

                            <p>
                                <?php echo e(Auth::User()->name); ?>

                                <small><?php echo e(Auth::User()->Group[$lang.'_name']); ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="<?php echo e(URL::to('/')); ?>" class="btn btn-block btn-primary"><?php echo e(trans('admin.website')); ?></a>
                            </div>
                            <div class="pull-left">
                                <a href="<?php echo e(URL::to('admin/logout')); ?>" class="btn btn-block btn-danger"><?php echo e(trans('admin.logout')); ?></a>
                            </div>
                        </li>
                    </ul>
                </li>

                <?php if(\App\Models\Permission::where('group_id', Auth::User()->group_id)->where('permission', 'contact_all')->count() > 0): ?>
                <?php $contacts = \App\Models\Contact::where('seen', 'no')->orderBy('id', 'desc')->get(); ?>
                <li class="dropdown messages-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope" style="font-size: 20px;"></i>
                        <span class="label bg-green"><?php echo e(COUNT($contacts)); ?></span>
                    </a>
                    <ul class="dropdown-menu scale-up">
                        <li class="header <?php echo e($text); ?>"><?php echo e(trans('admin.contact_count')); ?> : <?php echo e(COUNT($contacts)); ?></li>
                        <li>
                            <ul class="menu inner-content-div">
                                <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php echo e($text); ?>">
                                    <a href="<?php echo e(URL::to('admin/contact/'.$contact['id'].'/edit')); ?>">
                                        <i class="fa fa-envelope text-green"></i> 
                                        <span  dir="ltr">
                                            <?php echo e($contact['name']); ?> - <?php echo e($contact['phone']); ?>

                                        </span>
                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <li class="footer"><a href="<?php echo e(URL::to('admin/contact')); ?>"><?php echo e(trans('admin.show_all')); ?></a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"></a>
                </li>
            </ul>
        </div>
    </nav>
</header><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/layouts/include/header.blade.php ENDPATH**/ ?>
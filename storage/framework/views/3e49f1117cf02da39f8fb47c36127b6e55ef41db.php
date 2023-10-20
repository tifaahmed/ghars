<?php $__env->startSection('content'); ?>
<?php
$lang = App::getLocale();
$text = "text-left";
$pull = "pull-left";
$pulll = "pull-right";
if ($lang == "ar") {
    $text = "text-right";
    $pull = "pull-right";
    $pulll = "pull-left";
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo e(trans('admin.admin')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(URL::to('dashboard')); ?>"><i class="fa fa-home"></i> <?php echo e(trans('admin.home')); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <?php if(Session::has('message')): ?>
        <div class="col-lg-12 col-xl-12">
            <div class="alert alert-success alert-dismissible">
                <?php echo e(Session::get('message')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-lg-12 col-xl-12">
            
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/dashboard/home/index.blade.php ENDPATH**/ ?>
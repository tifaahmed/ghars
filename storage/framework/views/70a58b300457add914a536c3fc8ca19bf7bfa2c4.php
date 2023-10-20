<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
$dir = 'right';
if ($lang == 'ar') {
    $dir = 'left';
}
?>


<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.sponsorships')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e(trans('admin.sponsorships')); ?></h3>
    </div>
</section>

<section class="orphans_section mainRelative_section">
    <div class="container pxLG-0">
        <div class="row guarantee__inRow">
            <div class="col-12 col-md-6 col-lg-4">
                <a href="<?php echo e(url('childern')); ?>" class="guarantee__card">
                    <img src="<?php echo e(url('upload/site/'.$site['childern'])); ?>" alt="<?php echo e(trans('admin.childern')); ?>" class="grnt_thumb">
                    <h5 class="grntee__name"><?php echo e(trans('admin.childern')); ?></h5>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <a href="<?php echo e(url('families')); ?>" class="guarantee__card">
                    <img src="<?php echo e(url('upload/site/'.$site['families'])); ?>" alt="<?php echo e(trans('admin.families')); ?>" class="grnt_thumb">
                    <h5 class="grntee__name"><?php echo e(trans('admin.families')); ?></h5>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <a href="<?php echo e(url('teachers')); ?>" class="guarantee__card">
                    <img src="<?php echo e(url('upload/site/'.$site['teachers'])); ?>" alt="<?php echo e(trans('admin.teachers')); ?>" class="grnt_thumb">
                    <h5 class="grntee__name"><?php echo e(trans('admin.teachers')); ?></h5>
                </a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/sponsorships.blade.php ENDPATH**/ ?>
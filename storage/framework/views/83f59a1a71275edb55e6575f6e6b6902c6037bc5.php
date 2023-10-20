<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
$dir = 'right';
if ($lang == 'ar') {
    $dir = 'left';
}
?>


<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.my_projects')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e(trans('admin.my_projects')); ?></h3>
    </div>
</section>

<section class="orphans_section mainRelative_section">
    <div class="container pxLG-0">        
        <div class="searchResults__wrap">
            <h3 class="myInfo_title row">
                <div class="col-12 col-lg-6">
                    <?php echo e(trans('admin.my_projects')); ?>

                </div>
                <div class="col-12 col-lg-6">
                    <a href="<?php echo e(url('project_add')); ?>" class="contSubmit__btn subMidBtn_width" style="margin: 0; float: <?php echo e($dir); ?>;"><?php echo e(trans('admin.project_private_add')); ?></a>
                </div>
            </h3>

            <div class="row guarantee__inRow">
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="OGurant__card">
                        <a href="<?php echo e(url('project/'.$project['id'])); ?>">
                            <div class="OGurant__CTop">
                                <img src="<?php echo e(url('upload/projects/'.$project['image'])); ?>" alt="<?php echo e($project[$lang.'_name']); ?>" class="OGurant__Chimg">
                                <div class="adABs__overlay">
                                    <h5 class="aDchild_name"> <?php echo e($project[$lang.'_name']); ?> </h5>
                                    <h5 class="aDchild_name"> <?php echo e(trans('admin.remain')); ?> :  <?php echo e(($project['amount'] - $project['collect']) / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']); ?></h5>
                                    <h5 class="aDchild_name"> <?php echo e(trans('admin.total')); ?> :  <?php echo e($project['amount'] / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']); ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/my_projects.blade.php ENDPATH**/ ?>
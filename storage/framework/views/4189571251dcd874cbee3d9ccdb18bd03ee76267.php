<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
?>


<?php $__env->startSection('title'); ?>
<?php echo e($category[$lang.'_name']); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e($category[$lang.'_name']); ?></h3>
    </div>
</section>

<section class="orphans_section mainRelative_section">
    <div class="container pxLG-0">
        <h3 class="orphans__title"><?php echo e(trans('admin.search')); ?></h3>

        <div class="gurantINForm__Wrapz">
            <form action="<?php echo e(url('category/'.$category['id'])); ?>" method="get" class="GuarntInfo__form">
                <div class="form__row">
                    <div class="col-12 col-md-6 col-xl-6">
                        <label for="country" class="profileV__label"><?php echo e(trans('admin.country')); ?></label>
                        <?php echo e(Form::select('country',$countries,request()->get('country'),['class'=>'profileV__input','id'=>'country'])); ?>

                    </div>
                    <div class="col-12 col-md-3 col-xl-3">
                        <label for="required" class="profileV__label"><?php echo e(trans('admin.required')); ?></label>
                        <?php echo e(Form::select('required',[''=>trans('admin.choose'),'yes'=>trans('admin.yes')],request()->get('required'),['class'=>'profileV__input nice-select','id'=>'required'])); ?>

                    </div>
                    <div class="col-12 col-md-3 col-xl-3">
                        <button type="submit" class="contSubmit__btn subMidBtn_width w-100"><?php echo e(trans('admin.search')); ?></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="searchResults__wrap">
            <h5 class="ntSearch_title"><?php echo e(trans('admin.search_results')); ?> (<?php echo e(count($projects)); ?>) </h5>
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

<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/category.blade.php ENDPATH**/ ?>
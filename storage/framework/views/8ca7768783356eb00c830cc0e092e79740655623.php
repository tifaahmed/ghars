<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
?>


<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.childern')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e(trans('admin.childern')); ?></h3>
    </div>
</section>

<section class="orphans_section mainRelative_section">
    <div class="container pxLG-0">
        <h3 class="orphans__title"><?php echo e(trans('admin.search')); ?></h3>

        <div class="gurantINForm__Wrapz">
            <form action="<?php echo e(url('childern')); ?>" method="get" class="GuarntInfo__form">
                <div class="form__row">
                    <div class="col-12 col-md-6 col-xl-3">
                        <label for="country" class="profileV__label"><?php echo e(trans('admin.country')); ?></label>
                        <?php echo e(Form::select('country',$countries,request()->get('country'),['class'=>'profileV__input','id'=>'country'])); ?>

                    </div>
                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="gender" class="profileV__label"><?php echo e(trans('admin.gender')); ?></label>
                        <?php echo e(Form::select('gender',[''=>trans('admin.choose'),'male'=>trans('admin.male'),'female'=>trans('admin.female')],request()->get('gender'),['class'=>'profileV__input nice-select','id'=>'gender'])); ?>

                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <label for="age" class="profileV__label"><?php echo e(trans('admin.age')); ?></label>
                        <?php echo e(Form::select('age',[''=>trans('admin.choose'),'5'=>trans('admin.age_5'),'10'=>trans('admin.age_10'),'15'=>trans('admin.age_15'),'20'=>trans('admin.age_20')],request()->get('age'),['class'=>'profileV__input nice-select','id'=>'age'])); ?>

                    </div>
                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="required" class="profileV__label"><?php echo e(trans('admin.required')); ?></label>
                        <?php echo e(Form::select('required',[''=>trans('admin.choose'),'yes'=>trans('admin.yes')],request()->get('required'),['class'=>'profileV__input nice-select','id'=>'required'])); ?>

                    </div>
                    <div class="col-12 col-md-6 col-xl-2">
                        <button type="submit" class="contSubmit__btn subMidBtn_width w-100"><?php echo e(trans('admin.search')); ?></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="searchResults__wrap">
            <h5 class="ntSearch_title"><?php echo e(trans('admin.search_results')); ?> (<?php echo e(count($childern)); ?>) </h5>
            <div class="row guarantee__inRow">
                <?php $__currentLoopData = $childern; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="OGurant__card">
                        <a href="<?php echo e(url('child/'.$child['id'])); ?>">
                            <div class="OGurant__CTop">
                                <span class="active__status"><?php echo e($child['amount'] / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']); ?></span>
                                <img src="<?php echo e(url('upload/childern/'.$child['image'])); ?>" alt="<?php echo e($child[$lang.'_name']); ?>" class="OGurant__Chimg">
                                <div class="adABs__overlay">
                                    <h5 class="aDchild_name"><?php echo e($child[$lang.'_name']); ?></h5>
                                    <span class="adChild_age">
                                        <?php
                                        $date1 = $child['birth_date'];
                                        $date2 = date('Y-m-d');
                                        $diff = abs(strtotime($date2) - strtotime($date1));
                                        ?>
                                        <?php echo e(floor($diff / (365 * 60 * 60 * 24)) . ' ' . trans('admin.years')); ?>

                                    </span>
                                    <div class="aDtails_wrapper">
                                        <span><?php echo e(trans('admin.'.$child['gender'])); ?></span>
                                        <span> 
                                            <img src="<?php echo e(url('interface')); ?>/img/site.svg" alt="" class="siteTH_icon">
                                            <span><?php echo e($child['Country'][$lang.'_name']); ?></span>
                                        </span>
                                    </div>
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

<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/childern.blade.php ENDPATH**/ ?>
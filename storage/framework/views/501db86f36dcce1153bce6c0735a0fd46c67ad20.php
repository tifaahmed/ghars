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

        <div class="searchResults__wrap">
            <h5 class="ntSearch_title"><?php echo e(trans('admin.search_results')); ?> (<?php echo e(count($childern)); ?>) </h5>
            <div class="row guarantee__inRow">
                <?php $__currentLoopData = $childern; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $donation = \App\Models\Donation::where('user_id', Auth::User()->id)->where('user_type', 'user')->where('rel_id', $child['id'])->where('category', 'childern')->orderBy('id', 'desc')->first(); ?>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="OGurant__card">
                        <a href="<?php echo e(url('child/'.$child['id'])); ?>">
                            <div class="OGurant__CTop">
                                <span class="active__status" style="width: 110px;">
                                    <?php echo e(trans('admin.pay_'.$donation['active'])); ?>

                                </span>
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
                    <div class="OGurant__Cbody">
                        <div class="aDInput__group">
                            <input type="text" class="profileV__input" value="<?php echo e($donation['amount']); ?>" readonly="">
                            <label for="" class="absAD__label"><?php echo e($donation[$lang . '_currency']); ?></label>
                        </div>
                        <div class="aDbuttons_wrapper">                            
                            <?php if($donation['active'] == 'no'): ?>                       
                            <a href="<?php echo e(url('donation_edit/yes/'.$donation['id'])); ?>"  class="contSubmit__btn subMidBtn_width my-0 w-100"><?php echo e(trans('admin.donation_yes')); ?></a>

                            <?php else: ?>
                            <?php if($donation['active'] == 'yet'): ?>
                            <a href="<?php echo e(url('pay/'.$donation['id'])); ?>"  class="contSubmit__btn subMidBtn_width my-0 w-50"><?php echo e(trans('admin.pay')); ?></a>
                            <?php endif; ?>

                            <a href="<?php echo e(url('donation_edit/no/'.$donation['id'])); ?>" class="stop__guarntee"><?php echo e(trans("admin.donation_no")); ?></a>                            
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/my_childern.blade.php ENDPATH**/ ?>
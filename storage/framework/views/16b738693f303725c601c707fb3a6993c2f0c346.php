<?php $lang = App::getLocale(); ?>

<div class="curr__wrapper tab-pane fade in active show" role="tabpanel" id="payOne__wrapper">

</div>
<div class="curr__wrapper tab-pane fade" role="tabpanel" id="visitM__wrapper">
    <h3 class="phones_title"><?php echo e(trans('admin.phone')); ?></h3>
    <div class="contNUM__flex">
        <img src="<?php echo e(url('interface')); ?>/img/call2.svg" alt="" class="phonTW_icon">
        <a href="tel:<?php echo e($country['delegate_1']); ?>"> <?php echo e($country['code']); ?> <?php echo e($country['delegate_1']); ?> </a>
    </div>
    <div class="contNUM__flex">
        <img src="<?php echo e(url('interface')); ?>/img/call2.svg" alt="" class="phonTW_icon">
        <a href="tel:<?php echo e($country['delegate_2']); ?>"> <?php echo e($country['code']); ?> <?php echo e($country['delegate_2']); ?> </a>
    </div>
</div>
<div class="curr__wrapper tab-pane fade" role="tabpanel" id="branch__wrapper">
    <div class="form__row">
        <div class="col-12 col-lg-6">
            <h3 class="phones_title"><?php echo e(trans('admin.phone')); ?></h3>
            <div class="contNUM__flex">
                <img src="<?php echo e(url('interface')); ?>/img/call2.svg" alt="" class="phonTW_icon">
                <a href="tel:<?php echo e($country['headquarter_1']); ?>"> <?php echo e($country['code']); ?> <?php echo e($country['headquarter_1']); ?> </a>
            </div>
            <div class="contNUM__flex">
                <img src="<?php echo e(url('interface')); ?>/img/call2.svg" alt="" class="phonTW_icon">
                <a href="tel:<?php echo e($country['headquarter_2']); ?>"> <?php echo e($country['code']); ?> <?php echo e($country['headquarter_2']); ?> </a>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <h3 class="phones_title"><?php echo e(trans('admin.address')); ?></h3>
            <p class="addressGUr_des"><?php echo e($country[$lang.'_address']); ?></p>
        </div>
    </div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/ajax_country.blade.php ENDPATH**/ ?>
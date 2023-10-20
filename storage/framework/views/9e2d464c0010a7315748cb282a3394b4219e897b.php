<?php
$lang = App::getLocale();
?>


<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.contact')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e(trans('admin.contact')); ?></h3>
    </div>
</section>

<!--start contact section-->
<section class="contact_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row">
            <div class="col-12 col-lg-6">
                <form class="contact__form" action="<?php echo e(url('contact')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>


                    <div class="form__row">
                        <div class="col-12 col-lg-12">
                            <label class="login__label"><?php echo e(trans('admin.name')); ?></label>
                            <?php echo e(Form::text('name', null, ['class'=>'loginV__input','id'=>'name', 'placeholder'=>trans('admin.name')])); ?>

                            <?php if($errors->has('name')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('name')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-12">
                            <label class="login__label"><?php echo e(trans('admin.email')); ?></label>
                            <?php echo e(Form::text('email', null, ['class'=>'loginV__input','id'=>'email', 'placeholder'=>trans('admin.email')])); ?>

                            <?php if($errors->has('email')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('email')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-12">
                            <label class="login__label"><?php echo e(trans('admin.phone')); ?></label>
                            <?php echo e(Form::text('phone', null, ['class'=>'loginV__input','id'=>'phone', 'placeholder'=>trans('admin.phone')])); ?>

                            <?php if($errors->has('phone')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('phone')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-12">
                            <label class="login__label"><?php echo e(trans('admin.message')); ?></label>
                            <?php echo e(Form::textarea('message', null, ['class'=>'loginV__input','id'=>'message', 'placeholder'=>trans('admin.message')])); ?>

                            <?php if($errors->has('message')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('message')); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <button type="submit" class="contSubmit__btn"><?php echo e(trans('admin.send')); ?></button>
                </form>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mapSec_wrap">
                    <iframe src="<?php echo e($site['map']); ?>" width="100%" height="348" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    <a class="GHas_INvlogo"> <img src="<?php echo e(url('interface')); ?>/img/lg2.png" alt=""> </a>
                </div>
                <div class="address__Details">
                    <div class="addOne_list"><?php echo e(trans('admin.contact')); ?></div>
                    <div class="addOne_list"> 
                        <img src="<?php echo e(url('interface')); ?>/img/mail.svg" alt="" class="contT_icon">
                        <a href="mailto:<?php echo e($site['email']); ?>"><?php echo e($site['email']); ?></a>
                    </div>
                    <div class="addOne_list"> 
                        <img src="<?php echo e(url('interface')); ?>/img/call.svg" alt="" class="contT_icon">
                        <a href="tel:<?php echo e($site['phone']); ?>"><?php echo e($site['phone']); ?></a>
                    </div>
                    <div class="addOne_list"> 
                        <img src="<?php echo e(url('interface')); ?>/img/sms.svg" alt="" class="contT_icon">
                        <a href="https://wa.me/<?php echo e($site['whatsapp']); ?>"><?php echo e($site['whatsapp']); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/contact.blade.php ENDPATH**/ ?>
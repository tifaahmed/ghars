<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
?>


<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.project_add')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e(trans('admin.project_add')); ?></h3>
    </div>
</section>

<!--start contact section-->
<section class="contact_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row">
            <div class="col-12 col-lg-12">
                <form class="contact__form" action="<?php echo e(url('project_add')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>


                    <div class="form__row">
                        <div class="col-12 col-lg-6">
                            <label class="login__label"><?php echo e(trans('admin.country')); ?></label>
                            <?php echo e(Form::select('country_id',$countries, null, ['class'=>'loginV__input','id'=>'country_id'])); ?>

                            <?php if($errors->has('country_id')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('country_id')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="login__label"><?php echo e(trans('admin.category')); ?></label>
                            <?php echo e(Form::select('category_id',$categories, null, ['class'=>'loginV__input','id'=>'category_id'])); ?>

                            <?php if($errors->has('category_id')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('category_id')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="login__label"><?php echo e(trans('admin.project_name')); ?></label>
                            <?php echo e(Form::text('name', null, ['class'=>'loginV__input','id'=>'name'])); ?>

                            <?php if($errors->has('name')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('name')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="login__label"><?php echo e(trans('admin.total')); ?> (<?php echo e($currency_info[$lang.'_currency']); ?>)</label>
                            <?php echo e(Form::number('amount', null, ['class'=>'loginV__input','id'=>'amount'])); ?>

                            <?php if($errors->has('amount')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('amount')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="login__label"><?php echo e(trans('admin.collect')); ?> (<?php echo e($currency_info[$lang.'_currency']); ?>)</label>
                            <?php echo e(Form::number('collect', null, ['class'=>'loginV__input','id'=>'collect'])); ?>

                            <?php if($errors->has('collect')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('collect')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="login__label"><?php echo e(trans('admin.image')); ?></label>
                            <?php echo e(Form::file('image', ['class'=>'loginV__input','id'=>'image'])); ?>

                            <?php if($errors->has('image')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('image')); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-lg-12">
                            <label class="login__label"><?php echo e(trans('admin.project_desc')); ?></label>
                            <?php echo e(Form::textarea('desc', null, ['class'=>'loginV__input','id'=>'desc'])); ?>

                            <?php if($errors->has('desc')): ?>
                            <div class="alert alert-danger"><?php echo e($errors->first('desc')); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <button type="submit" class="contSubmit__btn"><?php echo e(trans('admin.add')); ?></button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/project_add.blade.php ENDPATH**/ ?>
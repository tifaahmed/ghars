<?php $__env->startSection('content'); ?>
<?php
$lang = App::getLocale();
$text = "text-left";
$pull = "pull-left";
if ($lang == "ar") {
    $text = "text-right";
    $pull = "pull-right";
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo e(trans('admin.profile')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.profile')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.edit_info')); ?> : <?php echo e(Auth::User()->name); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/profile/'.Auth::User()->id)); ?>" method="post" enctype="multipart/form-data">
            <?php echo e(Form::hidden('_method','PATCH')); ?>

            <?php echo e(csrf_field()); ?>


            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        <?php if(Session::has('message')): ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-success alert-dismissible">
                                    <?php echo e(Session::get('message')); ?>

                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"><?php echo e(trans('admin.name')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('name', Auth::User()->name, ['class'=>'form-control','id'=>'name'])); ?>

                                <?php if($errors->has('name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label"><?php echo e(trans('admin.email')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('email', Auth::User()->email, ['class'=>'form-control','id'=>'email'])); ?>

                                <?php if($errors->has('email')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('email')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label"><?php echo e(trans('admin.password')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::input('password','password', null, ['class'=>'form-control','id'=>'password'])); ?>

                                <?php if($errors->has('password')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('password')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country_id" class="col-sm-3 col-form-label"><?php echo e(trans('admin.country')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::select('country_id',$countries, Auth::User()->country_id, ['class'=>'form-control','id'=>'country_id'])); ?>

                                <?php if($errors->has('country_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('country_id')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label"><?php echo e(trans('admin.phone')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('phone', Auth::User()->phone, ['class'=>'form-control','id'=>'phone'])); ?>

                                <?php if($errors->has('phone')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('phone')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="whatsapp" class="col-sm-3 col-form-label"><?php echo e(trans('admin.whatsapp')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('whatsapp', Auth::User()->whatsapp, ['class'=>'form-control','id'=>'whatsapp'])); ?>

                                <?php if($errors->has('whatsapp')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('whatsapp')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.save')); ?></button>
                <a href="<?php echo e(URL::to('admin')); ?>" class="btn btn-default btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
            </div>

        </form>

    </div>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/profile/index.blade.php ENDPATH**/ ?>
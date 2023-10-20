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
        <?php echo e(trans('admin.slider')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/slider')); ?>"> <?php echo e(trans('admin.slider')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.slider_add')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.slider_add')); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/slider')); ?>" method="post" enctype="multipart/form-data">
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
                            <label for="sort" class="col-sm-4 col-form-label"><?php echo e(trans('admin.sort')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::number('sort', 0, ['class'=>'form-control','id'=>'sort'])); ?>

                                <?php if($errors->has('sort')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('sort')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link" class="col-sm-4 col-form-label"><?php echo e(trans('admin.link')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::text('link', null, ['class'=>'form-control','id'=>'link'])); ?>

                                <?php if($errors->has('link')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('link')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-4 col-form-label"><?php echo e(trans('admin.slider_name_ar')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::text('ar_name', null, ['class'=>'form-control','id'=>'ar_name'])); ?>

                                <?php if($errors->has('ar_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-4 col-form-label"><?php echo e(trans('admin.slider_name_en')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::text('en_name', null, ['class'=>'form-control','id'=>'en_name'])); ?>

                                <?php if($errors->has('en_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_desc" class="col-sm-4 col-form-label"><?php echo e(trans('admin.slider_desc_ar')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::text('ar_desc', null, ['class'=>'form-control','id'=>'ar_desc'])); ?>

                                <?php if($errors->has('ar_desc')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_desc')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_desc" class="col-sm-4 col-form-label"><?php echo e(trans('admin.slider_desc_en')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::text('en_desc', null, ['class'=>'form-control','id'=>'en_desc'])); ?>

                                <?php if($errors->has('en_desc')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_desc')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="image" class="col-sm-4 col-form-label image"><?php echo e(trans('admin.image')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::file('image',['class'=>'form-control','id'=>'image'])); ?>

                                <?php if($errors->has('image')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('image')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.add')); ?></button>
                <a href="<?php echo e(URL::to('admin/slider')); ?>" class="btn btn-default btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
            </div>

        </form>

    </div>

</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/slider/create.blade.php ENDPATH**/ ?>
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
        <?php echo e(trans('admin.tutorials')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/tutorials')); ?>"> <?php echo e(trans('admin.tutorials')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.tutorial_edit')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.tutorials_edit')); ?> : <?php echo e($tutorial[$lang.'_name']); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/tutorials/'.$tutorial->id)); ?>" method="post" enctype="multipart/form-data">
            <?php echo e(method_field('PATCH')); ?>

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
                            <label for="active" class="col-sm-4 col-form-label"><?php echo e(trans('admin.active')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::select('active',['yes'=>trans('admin.yes_active') , 'no'=>trans('admin.no_active')], $tutorial['active'], ['class'=>'form-control select2','id'=>'active'])); ?>

                                <?php if($errors->has('active')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('active')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="sort" class="col-sm-4 col-form-label"><?php echo e(trans('admin.sort')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::number('sort', $tutorial['sort'], ['class'=>'form-control','id'=>'sort'])); ?>

                                <?php if($errors->has('sort')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('sort')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-4 col-form-label"><?php echo e(trans('admin.tutorial_name_ar')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::text('ar_name', $tutorial['ar_name'], ['class'=>'form-control','id'=>'ar_name'])); ?>

                                <?php if($errors->has('ar_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-4 col-form-label"><?php echo e(trans('admin.tutorial_name_en')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::text('en_name', $tutorial['en_name'], ['class'=>'form-control','id'=>'en_name'])); ?>

                                <?php if($errors->has('en_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="ar_desc" class="col-sm-4 col-form-label"><?php echo e(trans('admin.tutorial_desc_ar')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::textarea('ar_desc', $tutorial['ar_desc'], ['class'=>'form-control','id'=>'ar_desc'])); ?>

                                <?php if($errors->has('ar_desc')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_desc')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_desc" class="col-sm-4 col-form-label"><?php echo e(trans('admin.tutorial_desc_en')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::textarea('en_desc', $tutorial['en_desc'], ['class'=>'form-control','id'=>'en_desc'])); ?>

                                <?php if($errors->has('en_desc')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_desc')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="image" class="col-sm-4 col-form-label image"><?php echo e(trans('admin.image')); ?> <span dir="ltr">(Width: 415px * Height:505px)</span></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::file('image',['class'=>'form-control','id'=>'image'])); ?>

                                <?php if($errors->has('image')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('image')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input_4" class="col-sm-4 col-form-label image_current_ar"><?php echo e(trans('admin.image_current')); ?></label>
                            <div class="col-sm-8">
                                <img src="<?php echo e(URL::to('upload/tutorials/'.$tutorial['image'])); ?>" class="img-thumbnail image_current">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.save')); ?></button>
                <a href="<?php echo e(URL::to('admin/tutorials')); ?>" class="btn btn-default btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
            </div>

        </form>

    </div>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/tutorials/edit.blade.php ENDPATH**/ ?>
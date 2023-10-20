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
        <?php echo e(trans('admin.pages')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/pages')); ?>"> <?php echo e(trans('admin.pages')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.page_edit')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.page_edit')); ?> : <?php echo e($page[$lang.'_title']); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/pages/'.$page['id'])); ?>" method="post" enctype="multipart/form-data">
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
                            <label for="ar_title" class="col-sm-3 col-form-label"><?php echo e(trans('admin.page_title_ar')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('ar_title', $page['ar_title'], ['class'=>'form-control','id'=>'ar_title'])); ?>

                                <?php if($errors->has('ar_title')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_title')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_title" class="col-sm-3 col-form-label"><?php echo e(trans('admin.page_title_en')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('en_title', $page['en_title'], ['class'=>'form-control','id'=>'en_title'])); ?>

                                <?php if($errors->has('en_title')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_title')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="editor1" class="col-sm-3 col-form-label"><?php echo e(trans('admin.page_desc_ar')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::textarea('ar_desc', $page['ar_desc'], ['class'=>'form-control','id'=>'editor1','rows'=>10])); ?>

                                <?php if($errors->has('ar_desc')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_desc')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="editor2" class="col-sm-3 col-form-label"><?php echo e(trans('admin.page_desc_en')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::textarea('en_desc', $page['en_desc'], ['class'=>'form-control','id'=>'editor2','rows'=>10])); ?>

                                <?php if($errors->has('en_desc')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_desc')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <?php if($page['id'] <= 4): ?>
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label image"><?php echo e(trans('admin.image')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::file('image',['class'=>'form-control','id'=>'image'])); ?>

                                <?php if($errors->has('image')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('image')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input_4" class="col-sm-3 col-form-label image_current_ar"><?php echo e(trans('admin.image_current')); ?></label>
                            <div class="col-sm-9">
                                <img src="<?php echo e(URL::to('upload/pages/'.$page['image'])); ?>" class="img-thumbnail image_current">
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.save')); ?></button>
                <a href="<?php echo e(URL::to('admin/pages')); ?>" class="btn btn-default btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
            </div>

        </form>

    </div>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/pages/edit.blade.php ENDPATH**/ ?>
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
        <?php echo e(trans('admin.site')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.site_edit')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.site_edit')); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/site/1')); ?>" method="post" enctype="multipart/form-data">
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
                            <label for="ar_title" class="col-sm-2 col-form-label"><?php echo e(trans('admin.site_title_ar')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::text('ar_title',  $site['ar_title'], ['class'=>'form-control','id'=>'ar_title'])); ?>

                                <?php if($errors->has('ar_title')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_title')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_title" class="col-sm-2 col-form-label"><?php echo e(trans('admin.site_title_en')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::text('en_title',  $site['en_title'], ['class'=>'form-control','id'=>'en_title'])); ?>

                                <?php if($errors->has('en_title')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_title')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_desc" class="col-sm-2 col-form-label"><?php echo e(trans('admin.site_desc_ar')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::textarea('ar_desc',  $site['ar_desc'], ['class'=>'form-control','id'=>'ar_desc','rows'=>3])); ?>

                                <?php if($errors->has('ar_desc')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_desc')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_desc" class="col-sm-2 col-form-label"><?php echo e(trans('admin.site_desc_en')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::textarea('en_desc',  $site['en_desc'], ['class'=>'form-control','id'=>'en_desc','rows'=>3])); ?>

                                <?php if($errors->has('en_desc')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_desc')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tags" class="col-sm-2 col-form-label"><?php echo e(trans('admin.site_tags')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::text('tags',  $site['tags'], ['class'=>'form-control','id'=>'tags'])); ?>

                                <?php if($errors->has('tags')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('tags')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="whatsapp" class="col-sm-2 col-form-label"><?php echo e(trans('admin.whatsapp')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::text('whatsapp',  $site['whatsapp'], ['class'=>'form-control','id'=>'whatsapp'])); ?>

                                <?php if($errors->has('whatsapp')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('whatsapp')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label"><?php echo e(trans('admin.phone')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::text('phone',  $site['phone'], ['class'=>'form-control','id'=>'phone'])); ?>

                                <?php if($errors->has('phone')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('phone')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label"><?php echo e(trans('admin.email')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::text('email',  $site['email'], ['class'=>'form-control','id'=>'email'])); ?>

                                <?php if($errors->has('email')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('email')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="map" class="col-sm-2 col-form-label"><?php echo e(trans('admin.map')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::text('map',  $site['map'], ['class'=>'form-control','id'=>'map'])); ?>

                                <?php if($errors->has('map')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('map')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ios" class="col-sm-2 col-form-label"><?php echo e(trans('admin.ios')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::text('ios',  $site['ios'], ['class'=>'form-control','id'=>'ios'])); ?>

                                <?php if($errors->has('ios')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ios')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="android" class="col-sm-2 col-form-label"><?php echo e(trans('admin.android')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::text('android',  $site['android'], ['class'=>'form-control','id'=>'android'])); ?>

                                <?php if($errors->has('android')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('android')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="childern" class="col-sm-2 col-form-label image"><?php echo e(trans('admin.childern')); ?> <span dir="ltr">(Width: 500px * Height:500px)</span></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::file('childern',['class'=>'form-control','id'=>'childern'])); ?>

                                <?php if($errors->has('childern')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('childern')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input_4" class="col-sm-2 col-form-label image_current_ar"><?php echo e(trans('admin.image_current')); ?></label>
                            <div class="col-sm-10">
                                <img src="<?php echo e(URL::to('upload/site/'.$site['childern'])); ?>" class="img-thumbnail image_current">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="families" class="col-sm-2 col-form-label image"><?php echo e(trans('admin.families')); ?> <span dir="ltr">(Width: 500px * Height:500px)</span></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::file('families',['class'=>'form-control','id'=>'families'])); ?>

                                <?php if($errors->has('families')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('families')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input_4" class="col-sm-2 col-form-label image_current_ar"><?php echo e(trans('admin.image_current')); ?></label>
                            <div class="col-sm-10">
                                <img src="<?php echo e(URL::to('upload/site/'.$site['families'])); ?>" class="img-thumbnail image_current">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="teachers" class="col-sm-2 col-form-label image"><?php echo e(trans('admin.teachers')); ?> <span dir="ltr">(Width: 500px * Height:500px)</span></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::file('teachers',['class'=>'form-control','id'=>'teachers'])); ?>

                                <?php if($errors->has('teachers')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('teachers')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input_4" class="col-sm-2 col-form-label image_current_ar"><?php echo e(trans('admin.image_current')); ?></label>
                            <div class="col-sm-10">
                                <img src="<?php echo e(URL::to('upload/site/'.$site['teachers'])); ?>" class="img-thumbnail image_current">
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
<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/site/index.blade.php ENDPATH**/ ?>
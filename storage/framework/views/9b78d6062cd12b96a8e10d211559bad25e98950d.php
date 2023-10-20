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
        <?php echo e(trans('admin.companies')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/companies')); ?>"> <?php echo e(trans('admin.companies')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.company_add')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.company_add')); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/companies/')); ?>" method="post" enctype="multipart/form-data">
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
                            <label for="country_id" class="col-sm-3 col-form-label"><?php echo e(trans('admin.country')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::select('country_id',$countries, null, ['class'=>'form-control select2','id'=>'country_id'])); ?>

                                <?php if($errors->has('country_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('country_id')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-3 col-form-label"><?php echo e(trans('admin.company_name_ar')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('ar_name', null, ['class'=>'form-control','id'=>'ar_name'])); ?>

                                <?php if($errors->has('ar_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-3 col-form-label"><?php echo e(trans('admin.company_name_en')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('en_name', null, ['class'=>'form-control','id'=>'en_name'])); ?>

                                <?php if($errors->has('en_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"><?php echo e(trans('admin.owner_name')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('name', null, ['class'=>'form-control','id'=>'name'])); ?>

                                <?php if($errors->has('name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label"><?php echo e(trans('admin.email')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('email', null, ['class'=>'form-control','id'=>'email'])); ?>

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
                            <label for="phone" class="col-sm-3 col-form-label"><?php echo e(trans('admin.phone')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('phone', null, ['class'=>'form-control','id'=>'phone'])); ?>

                                <?php if($errors->has('phone')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('phone')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="whatsapp" class="col-sm-3 col-form-label"><?php echo e(trans('admin.whatsapp')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('whatsapp', null, ['class'=>'form-control','id'=>'whatsapp'])); ?>

                                <?php if($errors->has('whatsapp')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('whatsapp')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="governate" class="col-sm-3 col-form-label"><?php echo e(trans('admin.governate')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('governate', null, ['class'=>'form-control','id'=>'governate'])); ?>

                                <?php if($errors->has('governate')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('governate')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-sm-3 col-form-label"><?php echo e(trans('admin.city')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('city', null, ['class'=>'form-control','id'=>'city'])); ?>

                                <?php if($errors->has('city')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('city')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-sm-3 col-form-label"><?php echo e(trans('admin.street')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('street', null, ['class'=>'form-control','id'=>'street'])); ?>

                                <?php if($errors->has('street')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('street')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categories" class="col-sm-3 col-form-label"><?php echo e(trans('admin.categories')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::select('categories[]',$categories ,null, ['class'=>'form-control select2','id'=>'category_id','data-placeholder'=>trans('admin.choose_category'),'style'=>'width: 100%;','multiple'=>'multiple'])); ?>

                                <?php if($errors->has('categories')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('categories')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group row" id="files">
                            <label class="col-sm-2 col-form-label <?php echo e($pull); ?>" id="file_1" style="margin-bottom: 10px;"><?php echo e(trans('admin.file_name_ar')); ?></label>
                            <div class="col-sm-2 <?php echo e($pull); ?>" id="file_2" style="margin-bottom: 10px;">
                                <?php echo e(Form::text('ar_names[]',null, ['class'=>'form-control','id'=>'ar_names'])); ?>

                            </div>
                            <label class="col-sm-2 col-form-label <?php echo e($pull); ?>" id="file_3" style="margin-bottom: 10px;"><?php echo e(trans('admin.file_name_en')); ?></label>
                            <div class="col-sm-2 <?php echo e($pull); ?>" id="file_4" style="margin-bottom: 10px;">
                                <?php echo e(Form::text('en_names[]',null, ['class'=>'form-control','id'=>'en_names'])); ?>

                            </div>
                            <label class="col-sm-1 col-form-label <?php echo e($pull); ?>" id="file_5" style="margin-bottom: 10px;"><?php echo e(trans('admin.file')); ?></label>
                            <div class="col-sm-2 <?php echo e($pull); ?>" id="file_6" style="margin-bottom: 10px;">
                                <?php echo e(Form::file('files[]', ['class'=>'form-control','id'=>'files'])); ?>

                            </div>
                            <div class="col-md-1 <?php echo e($pull); ?>" style="margin-bottom: 10px;">
                                <button type="button" class="btn btn-block btn-success btn-block" style="height: 36px;" id="more_files"> <i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.add')); ?></button>
                <a href="<?php echo e(URL::to('admin/companies')); ?>" class="btn btn-default btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
            </div>

        </form>

    </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>       
    $("body").on("click", "#more_files", function (e) {
        $('#files').append('<br><br>');
        $('#files').append($('#file_1').clone());
        $('#files').append($('#file_2').clone());
        $('#files').append($('#file_3').clone());
        $('#files').append($('#file_4').clone());
        $('#files').append($('#file_5').clone());
        $('#files').append($('#file_6').clone());
        $('#files').append('<div class="col-sm-1 <?php echo $pull; ?>" style="margin-bottom: 10px;"><button class="btn btn-danger btn-lg btn-block delete_files" style="height: 36px;"><i class="fa fa-trash-o"></i></button></div>');
        return false;
    });

    $("body").on("click", ".delete_files", function (e) {
        $(this).parent("div").prev("div").prev("label").prev("div").prev("label").prev("div").prev("label").prev("br").prev("br").remove();
        $(this).parent("div").prev("div").prev("label").prev("div").prev("label").prev("div").prev("label").prev("br").remove();
        $(this).parent("div").prev("div").prev("label").prev("div").prev("label").prev("div").prev("label").remove();
        $(this).parent("div").prev("div").prev("label").prev("div").prev("label").prev("div").remove();
        $(this).parent("div").prev("div").prev("label").prev("div").prev("label").remove();
        $(this).parent("div").prev("div").prev("label").prev("div").remove();
        $(this).parent("div").prev("div").prev("label").remove();
        $(this).parent("div").prev("div").remove();
        $(this).parent("div").remove();
        return false;
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/companies/create.blade.php ENDPATH**/ ?>
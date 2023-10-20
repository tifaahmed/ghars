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
        <?php echo e(trans('admin.members')); ?> : <?php echo e($family[$lang.'_name']); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/families')); ?>"> <?php echo e(trans('admin.families')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/families_members/'.$family['id'])); ?>"> <?php echo e(trans('admin.members')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.family_member_add')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.family_member_add')); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/families_members/')); ?>" method="post" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <?php echo e(Form::hidden('family_id',$family['id'])); ?>


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
                            <label for="active" class="col-sm-2 col-form-label"><?php echo e(trans('admin.active')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::select('active',['yes'=>trans('admin.approve_yes'),'no'=>trans('admin.approve_no')], null, ['class'=>'form-control select2','id'=>'active'])); ?>

                                <?php if($errors->has('active')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('active')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-sm-2 col-form-label"><?php echo e(trans('admin.gender')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::select('gender',['male'=>trans('admin.male'),'female'=>trans('admin.female')], null, ['class'=>'form-control select2','id'=>'gender'])); ?>

                                <?php if($errors->has('gender')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('gender')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-sm-2 col-form-label"><?php echo e(trans('admin.birth_date')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('birth_date', null, ['class'=>'form-control','id'=>'birth_date'])); ?>

                                <?php if($errors->has('birth_date')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('birth_date')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="civil_id" class="col-sm-2 col-form-label"><?php echo e(trans('admin.civil_id')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('civil_id', null, ['class'=>'form-control','id'=>'civil_id'])); ?>

                                <?php if($errors->has('civil_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('civil_id')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-2 col-form-label"><?php echo e(trans('admin.family_name_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_name', null, ['class'=>'form-control','id'=>'ar_name'])); ?>

                                <?php if($errors->has('ar_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_name')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_name" class="col-sm-2 col-form-label"><?php echo e(trans('admin.family_name_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_name', null, ['class'=>'form-control','id'=>'en_name'])); ?>

                                <?php if($errors->has('en_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_civil_type" class="col-sm-2 col-form-label"><?php echo e(trans('admin.civil_type_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_civil_type', null, ['class'=>'form-control','id'=>'ar_civil_type'])); ?>

                                <?php if($errors->has('ar_civil_type')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_civil_type')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_civil_type" class="col-sm-2 col-form-label"><?php echo e(trans('admin.civil_type_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_civil_type', null, ['class'=>'form-control','id'=>'en_civil_type'])); ?>

                                <?php if($errors->has('en_civil_type')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_civil_type')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_career_status" class="col-sm-2 col-form-label"><?php echo e(trans('admin.career_status_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('ar_career_status', null, ['class'=>'form-control','id'=>'ar_career_status'])); ?>

                                <?php if($errors->has('ar_career_status')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_career_status')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_career_status" class="col-sm-2 col-form-label"><?php echo e(trans('admin.career_status_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('en_career_status', null, ['class'=>'form-control','id'=>'en_career_status'])); ?>

                                <?php if($errors->has('en_career_status')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_career_status')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_class" class="col-sm-2 col-form-label"><?php echo e(trans('admin.class_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_class', null, ['class'=>'form-control','id'=>'ar_class'])); ?>

                                <?php if($errors->has('ar_class')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_class')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_class" class="col-sm-2 col-form-label"><?php echo e(trans('admin.class_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_class', null, ['class'=>'form-control','id'=>'en_class'])); ?>

                                <?php if($errors->has('en_class')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_class')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_psychological" class="col-sm-2 col-form-label"><?php echo e(trans('admin.psychological_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_psychological', null, ['class'=>'form-control','id'=>'ar_psychological'])); ?>

                                <?php if($errors->has('ar_psychological')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_psychological')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_psychological" class="col-sm-2 col-form-label"><?php echo e(trans('admin.psychological_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_psychological', null, ['class'=>'form-control','id'=>'en_psychological'])); ?>

                                <?php if($errors->has('en_psychological')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_psychological')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_healthy" class="col-sm-2 col-form-label"><?php echo e(trans('admin.healthy_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_healthy', null, ['class'=>'form-control','id'=>'ar_healthy'])); ?>

                                <?php if($errors->has('ar_healthy')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_healthy')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_healthy" class="col-sm-2 col-form-label"><?php echo e(trans('admin.healthy_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_healthy', null, ['class'=>'form-control','id'=>'en_healthy'])); ?>

                                <?php if($errors->has('en_healthy')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_healthy')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label image"><?php echo e(trans('admin.image')); ?><span dir="ltr">(Width: 500px * Height:500px)</span></label>
                            <div class="col-sm-10">
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
                <a href="<?php echo e(URL::to('admin/families_members/'.$family['id'])); ?>" class="btn btn-default btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
            </div>

        </form>

    </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    //Date picker
    $('#birth_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/families_members/create.blade.php ENDPATH**/ ?>
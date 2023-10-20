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
        <?php echo e(trans('admin.countries')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/countries')); ?>"> <?php echo e(trans('admin.countries')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.country_edit')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.country_edit')); ?> : <?php echo e($country[$lang.'_name']); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/countries/'.$country['id'])); ?>" method="post" enctype="multipart/form-data">
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
                            <label for="iso" class="col-sm-3 col-form-label">ISO</label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('iso', $country['iso'], ['class'=>'form-control','id'=>'iso','readonly'])); ?>

                                <?php if($errors->has('iso')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('iso')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="active" class="col-sm-3 col-form-label"><?php echo e(trans('admin.country_active')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::select('active', ['yes'=>trans('admin.yes_active') , 'no'=>trans('admin.no_active')],$country['active'], ['class'=>'form-control select2','id'=>'active'])); ?>

                                <?php if($errors->has('active')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('active')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-3 col-form-label"><?php echo e(trans('admin.country_name_ar')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('ar_name', $country['ar_name'], ['class'=>'form-control','id'=>'ar_name'])); ?>

                                <?php if($errors->has('ar_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-3 col-form-label"><?php echo e(trans('admin.country_name_en')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('en_name', $country['en_name'], ['class'=>'form-control','id'=>'en_name'])); ?>

                                <?php if($errors->has('en_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="code" class="col-sm-3 col-form-label"><?php echo e(trans('admin.country_code')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('code', $country['code'], ['class'=>'form-control '.$text,'id'=>'code','style'=>'direction:ltr;'])); ?>

                                <?php if($errors->has('code')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('code')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_address" class="col-sm-3 col-form-label"><?php echo e(trans('admin.address_work_ar')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('ar_address', $country['ar_address'], ['class'=>'form-control','id'=>'ar_address'])); ?>

                                <?php if($errors->has('ar_address')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_address')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_address" class="col-sm-3 col-form-label"><?php echo e(trans('admin.address_work_en')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('en_address', $country['en_address'], ['class'=>'form-control','id'=>'en_address'])); ?>

                                <?php if($errors->has('en_address')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_address')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="headquarter_1" class="col-sm-3 col-form-label"><?php echo e(trans('admin.headquarter_1')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('headquarter_1', $country['headquarter_1'], ['class'=>'form-control','id'=>'headquarter_1'])); ?>

                                <?php if($errors->has('headquarter_1')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('headquarter_1')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="headquarter_2" class="col-sm-3 col-form-label"><?php echo e(trans('admin.headquarter_2')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('headquarter_2', $country['headquarter_2'], ['class'=>'form-control','id'=>'headquarter_2'])); ?>

                                <?php if($errors->has('headquarter_2')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('headquarter_2')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delegate_1" class="col-sm-3 col-form-label"><?php echo e(trans('admin.delegate_1')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('delegate_1', $country['delegate_1'], ['class'=>'form-control','id'=>'delegate_1'])); ?>

                                <?php if($errors->has('delegate_1')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('delegate_1')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delegate_2" class="col-sm-3 col-form-label"><?php echo e(trans('admin.delegate_2')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('delegate_2', $country['delegate_2'], ['class'=>'form-control','id'=>'delegate_2'])); ?>

                                <?php if($errors->has('delegate_2')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('delegate_2')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.save')); ?></button>
                <a href="<?php echo e(URL::to('admin/countries')); ?>" class="btn btn-default btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
            </div>

        </form>

    </div>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/countries/edit.blade.php ENDPATH**/ ?>
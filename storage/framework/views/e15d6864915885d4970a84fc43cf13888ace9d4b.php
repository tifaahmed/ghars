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
        <?php echo e(trans('admin.families')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/families')); ?>"> <?php echo e(trans('admin.families')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.family_edit')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.family_edit')); ?> : <?php echo e($family['name']); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/families/'.$family['id'])); ?>" method="post" enctype="multipart/form-data">
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
                            <label for="active" class="col-sm-2 col-form-label"><?php echo e(trans('admin.active')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::select('active',['yes'=>trans('admin.approve_yes'),'no'=>trans('admin.approve_no')], $family['active'], ['class'=>'form-control select2','id'=>'active'])); ?>

                                <?php if($errors->has('active')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('active')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country_id" class="col-sm-2 col-form-label"><?php echo e(trans('admin.country')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::select('country_id',$countries, $family['country_id'], ['class'=>'form-control select2','id'=>'country_id'])); ?>

                                <?php if($errors->has('country_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('country_id')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-sm-2 col-form-label"><?php echo e(trans('admin.gender')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::select('gender',['male'=>trans('admin.male'),'female'=>trans('admin.female')], $family['gender'], ['class'=>'form-control select2','id'=>'gender'])); ?>

                                <?php if($errors->has('gender')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('gender')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="required" class="col-sm-2 col-form-label"><?php echo e(trans('admin.required')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::select('required',['no'=>trans('admin.no'),'yes'=>trans('admin.yes')], $family['required'], ['class'=>'form-control','id'=>'required'])); ?>

                                <?php if($errors->has('required')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('required')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="amount" class="col-sm-2 col-form-label"><?php echo e(trans('admin.amount')); ?></label>
                            <div class="col-sm-3">
                                <?php echo e(Form::text('amount', $family['amount'], ['class'=>'form-control','id'=>'amount'])); ?>

                                <?php if($errors->has('amount')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('amount')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label class="col-sm-1 col-form-label"><?php echo e(trans('admin.kwd')); ?></label>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-2 col-form-label"><?php echo e(trans('admin.family_name_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_name', $family['ar_name'], ['class'=>'form-control','id'=>'ar_name'])); ?>

                                <?php if($errors->has('ar_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_name')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_name" class="col-sm-2 col-form-label"><?php echo e(trans('admin.family_name_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_name', $family['en_name'], ['class'=>'form-control','id'=>'en_name'])); ?>

                                <?php if($errors->has('en_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_nationality" class="col-sm-2 col-form-label"><?php echo e(trans('admin.nationality_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_nationality', $family['ar_nationality'], ['class'=>'form-control','id'=>'ar_nationality'])); ?>

                                <?php if($errors->has('ar_nationality')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_nationality')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_nationality" class="col-sm-2 col-form-label"><?php echo e(trans('admin.nationality_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_nationality', $family['en_nationality'], ['class'=>'form-control','id'=>'en_nationality'])); ?>

                                <?php if($errors->has('en_nationality')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_nationality')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="civil_id" class="col-sm-2 col-form-label"><?php echo e(trans('admin.civil_id')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('civil_id', $family['civil_id'], ['class'=>'form-control','id'=>'civil_id'])); ?>

                                <?php if($errors->has('civil_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('civil_id')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="members_count" class="col-sm-2 col-form-label"><?php echo e(trans('admin.members_count')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::number('members_count', $family['members_count'], ['class'=>'form-control','id'=>'members_count'])); ?>

                                <?php if($errors->has('members_count')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('members_count')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_parent_status" class="col-sm-2 col-form-label"><?php echo e(trans('admin.parent_status_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_parent_status', $family['ar_parent_status'], ['class'=>'form-control','id'=>'ar_parent_status'])); ?>

                                <?php if($errors->has('ar_parent_status')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_parent_status')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_parent_status" class="col-sm-2 col-form-label"><?php echo e(trans('admin.parent_status_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_parent_status', $family['en_parent_status'], ['class'=>'form-control','id'=>'en_parent_status'])); ?>

                                <?php if($errors->has('en_parent_status')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_parent_status')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="form-group row">
                            <label for="death_date" class="col-sm-2 col-form-label"><?php echo e(trans('admin.death_date')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::text('death_date', $family['death_date'], ['class'=>'form-control','id'=>'death_date'])); ?>

                                <?php if($errors->has('death_date')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('death_date')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_death_reason" class="col-sm-2 col-form-label"><?php echo e(trans('admin.death_reason_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_death_reason', $family['ar_death_reason'], ['class'=>'form-control','id'=>'ar_death_reason'])); ?>

                                <?php if($errors->has('ar_death_reason')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_death_reason')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_death_reason" class="col-sm-2 col-form-label"><?php echo e(trans('admin.death_reason_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_death_reason', $family['en_death_reason'], ['class'=>'form-control','id'=>'en_death_reason'])); ?>

                                <?php if($errors->has('en_death_reason')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_death_reason')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="males" class="col-sm-2 col-form-label"><?php echo e(trans('admin.males')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::number('males', $family['males'], ['class'=>'form-control','id'=>'males'])); ?>

                                <?php if($errors->has('males')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('males')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="females" class="col-sm-2 col-form-label"><?php echo e(trans('admin.females')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::number('females', $family['females'], ['class'=>'form-control','id'=>'females'])); ?>

                                <?php if($errors->has('females')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('females')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_responsible" class="col-sm-2 col-form-label"><?php echo e(trans('admin.responsible_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_responsible', $family['ar_responsible'], ['class'=>'form-control','id'=>'ar_responsible'])); ?>

                                <?php if($errors->has('ar_responsible')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_responsible')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_responsible" class="col-sm-2 col-form-label"><?php echo e(trans('admin.responsible_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_responsible', $family['en_responsible'], ['class'=>'form-control','id'=>'en_responsible'])); ?>

                                <?php if($errors->has('en_responsible')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_responsible')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_relative" class="col-sm-2 col-form-label"><?php echo e(trans('admin.relative_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_relative', $family['ar_relative'], ['class'=>'form-control','id'=>'ar_relative'])); ?>

                                <?php if($errors->has('ar_relative')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_relative')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_relative" class="col-sm-2 col-form-label"><?php echo e(trans('admin.relative_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_relative', $family['en_relative'], ['class'=>'form-control','id'=>'en_relative'])); ?>

                                <?php if($errors->has('en_relative')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_relative')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_career" class="col-sm-2 col-form-label"><?php echo e(trans('admin.career_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_career', $family['ar_career'], ['class'=>'form-control','id'=>'ar_career'])); ?>

                                <?php if($errors->has('ar_career')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_career')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_career" class="col-sm-2 col-form-label"><?php echo e(trans('admin.career_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_career', $family['en_career'], ['class'=>'form-control','id'=>'en_career'])); ?>

                                <?php if($errors->has('en_career')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_career')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_career_status" class="col-sm-2 col-form-label"><?php echo e(trans('admin.career_status_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('ar_career_status', $family['ar_career_status'], ['class'=>'form-control','id'=>'ar_career_status'])); ?>

                                <?php if($errors->has('ar_career_status')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_career_status')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_career_status" class="col-sm-2 col-form-label"><?php echo e(trans('admin.career_status_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('en_career_status', $family['en_career_status'], ['class'=>'form-control','id'=>'en_career_status'])); ?>

                                <?php if($errors->has('en_career_status')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_career_status')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="responsible_civil_id" class="col-sm-2 col-form-label"><?php echo e(trans('admin.responsible_civil_id')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::text('responsible_civil_id', $family['responsible_civil_id'], ['class'=>'form-control','id'=>'responsible_civil_id'])); ?>

                                <?php if($errors->has('responsible_civil_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('responsible_civil_id')); ?></div>
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

                        <div class="form-group row">
                            <label for="input_4" class="col-sm-2 col-form-label image_current_ar"><?php echo e(trans('admin.image_current')); ?></label>
                            <div class="col-sm-10">
                                <img src="<?php echo e(URL::to('upload/families/'.$family['image'])); ?>" class="img-thumbnail image_current">
                            </div>
                        </div>

                        <div class="form-group row" id="files">
                            <label class="col-sm-2 col-form-label <?php echo e($pull); ?>" id="file_1" style="margin-bottom: 10px;"><?php echo e(trans('admin.report_name_ar')); ?></label>
                            <div class="col-sm-2 <?php echo e($pull); ?>" id="file_2" style="margin-bottom: 10px;">
                                <?php echo e(Form::text('ar_names[]',null, ['class'=>'form-control','id'=>'ar_names'])); ?>

                            </div>
                            <label class="col-sm-2 col-form-label <?php echo e($pull); ?>" id="file_3" style="margin-bottom: 10px;"><?php echo e(trans('admin.report_name_en')); ?></label>
                            <div class="col-sm-2 <?php echo e($pull); ?>" id="file_4" style="margin-bottom: 10px;">
                                <?php echo e(Form::text('en_names[]',null, ['class'=>'form-control','id'=>'en_names'])); ?>

                            </div>
                            <label class="col-sm-1 col-form-label <?php echo e($pull); ?>" id="file_5" style="margin-bottom: 10px;"><?php echo e(trans('admin.report')); ?></label>
                            <div class="col-sm-2 <?php echo e($pull); ?>" id="file_6" style="margin-bottom: 10px;">
                                <?php echo e(Form::file('files[]', ['class'=>'form-control','id'=>'files'])); ?>

                            </div>
                            <div class="col-md-1 <?php echo e($pull); ?>" style="margin-bottom: 10px;">
                                <button type="button" class="btn btn-block btn-success btn-block" style="height: 36px;" id="more_files"> <i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.report_name_ar')); ?></th>
                                            <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.report_name_en')); ?></th>
                                            <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.status')); ?></th>
                                            <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.report')); ?></th>
                                            <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.delete')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $family['Reports']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?php echo e($report['ar_name']); ?></td>
                                            <td style="vertical-align: middle;"><?php echo e($report['en_name']); ?></td>
                                            <td style="vertical-align: middle;"><?php echo e(trans('admin.approve_'.$report['active'])); ?></td>
                                            <td style="vertical-align: middle;"><a target="_blank" href="<?php echo e(url('upload/families/'.$report['file'])); ?>" class="btn btn-sm btn-info"><?php echo e(trans('admin.show')); ?></a></td>
                                            <td style="vertical-align: middle;">
                                                <a href="<?php echo e(url('admin/families_reports/'.$report['id'])); ?>" class="btn btn-sm btn-danger"><?php echo e(trans('admin.delete')); ?></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.save')); ?></button>
                <a href="<?php echo e(URL::to('admin/families')); ?>" class="btn btn-default btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
            </div>

        </form>

    </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    //Date picker
    $('#death_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });


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

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/families/edit.blade.php ENDPATH**/ ?>
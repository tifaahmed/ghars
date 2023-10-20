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
        <?php echo e(trans('admin.childern')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/childern')); ?>"> <?php echo e(trans('admin.childern')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.child_edit')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.child_edit')); ?> : <?php echo e($child['name']); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/childern/'.$child['id'])); ?>" method="post" enctype="multipart/form-data">
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
                                <?php echo e(Form::select('active',['yes'=>trans('admin.approve_yes'),'no'=>trans('admin.approve_no')], $child['active'], ['class'=>'form-control select2','id'=>'active'])); ?>

                                <?php if($errors->has('active')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('active')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country_id" class="col-sm-2 col-form-label"><?php echo e(trans('admin.country')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::select('country_id',$countries, $child['country_id'], ['class'=>'form-control select2','id'=>'country_id'])); ?>

                                <?php if($errors->has('country_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('country_id')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-sm-2 col-form-label"><?php echo e(trans('admin.gender')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::select('gender',['male'=>trans('admin.male'),'female'=>trans('admin.female')], $child['gender'], ['class'=>'form-control select2','id'=>'gender'])); ?>

                                <?php if($errors->has('gender')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('gender')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="required" class="col-sm-2 col-form-label"><?php echo e(trans('admin.required')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::select('required',['no'=>trans('admin.no'),'yes'=>trans('admin.yes')], $child['required'], ['class'=>'form-control','id'=>'required'])); ?>

                                <?php if($errors->has('required')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('required')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="amount" class="col-sm-2 col-form-label"><?php echo e(trans('admin.amount')); ?></label>
                            <div class="col-sm-3">
                                <?php echo e(Form::text('amount', $child['amount'], ['class'=>'form-control','id'=>'amount'])); ?>

                                <?php if($errors->has('amount')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('amount')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label class="col-sm-1 col-form-label"><?php echo e(trans('admin.kwd')); ?></label>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-2 col-form-label"><?php echo e(trans('admin.child_name_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_name', $child['ar_name'], ['class'=>'form-control','id'=>'ar_name'])); ?>

                                <?php if($errors->has('ar_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_name')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_name" class="col-sm-2 col-form-label"><?php echo e(trans('admin.child_name_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_name', $child['en_name'], ['class'=>'form-control','id'=>'en_name'])); ?>

                                <?php if($errors->has('en_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-sm-2 col-form-label"><?php echo e(trans('admin.birth_date')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('birth_date', $child['birth_date'], ['class'=>'form-control','id'=>'birth_date'])); ?>

                                <?php if($errors->has('birth_date')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('birth_date')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="birth_no" class="col-sm-2 col-form-label"><?php echo e(trans('admin.birth_no')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('birth_no', $child['birth_no'], ['class'=>'form-control','id'=>'birth_no'])); ?>

                                <?php if($errors->has('birth_no')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('birth_no')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_nationality" class="col-sm-2 col-form-label"><?php echo e(trans('admin.nationality_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_nationality', $child['ar_nationality'], ['class'=>'form-control','id'=>'ar_nationality'])); ?>

                                <?php if($errors->has('ar_nationality')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_nationality')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_nationality" class="col-sm-2 col-form-label"><?php echo e(trans('admin.nationality_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_nationality', $child['en_nationality'], ['class'=>'form-control','id'=>'en_nationality'])); ?>

                                <?php if($errors->has('en_nationality')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_nationality')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_governate" class="col-sm-2 col-form-label"><?php echo e(trans('admin.governate_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_governate', $child['ar_governate'], ['class'=>'form-control','id'=>'ar_governate'])); ?>

                                <?php if($errors->has('ar_governate')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_governate')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_governate" class="col-sm-2 col-form-label"><?php echo e(trans('admin.governate_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_governate', $child['en_governate'], ['class'=>'form-control','id'=>'en_governate'])); ?>

                                <?php if($errors->has('en_governate')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_governate')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_city" class="col-sm-2 col-form-label"><?php echo e(trans('admin.city_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_city', $child['ar_city'], ['class'=>'form-control','id'=>'ar_city'])); ?>

                                <?php if($errors->has('ar_city')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_city')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_city" class="col-sm-2 col-form-label"><?php echo e(trans('admin.city_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_city', $child['en_city'], ['class'=>'form-control','id'=>'en_city'])); ?>

                                <?php if($errors->has('en_city')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_city')); ?></div>
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
                                <img src="<?php echo e(URL::to('upload/childern/'.$child['image'])); ?>" class="img-thumbnail image_current">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_study_stage" class="col-sm-2 col-form-label"><?php echo e(trans('admin.study_stage_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_study_stage', $child['ar_study_stage'], ['class'=>'form-control','id'=>'ar_study_stage'])); ?>

                                <?php if($errors->has('ar_study_stage')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_study_stage')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_study_stage" class="col-sm-2 col-form-label"><?php echo e(trans('admin.study_stage_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_study_stage', $child['en_study_stage'], ['class'=>'form-control','id'=>'en_study_stage'])); ?>

                                <?php if($errors->has('en_study_stage')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_study_stage')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_class" class="col-sm-2 col-form-label"><?php echo e(trans('admin.class_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_class', $child['ar_class'], ['class'=>'form-control','id'=>'ar_class'])); ?>

                                <?php if($errors->has('ar_class')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_class')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_class" class="col-sm-2 col-form-label"><?php echo e(trans('admin.class_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_class', $child['en_class'], ['class'=>'form-control','id'=>'en_class'])); ?>

                                <?php if($errors->has('en_class')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_class')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="study_report" class="col-sm-2 col-form-label image"><?php echo e(trans('admin.study_report')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::file('study_report',['class'=>'form-control','id'=>'study_report'])); ?>

                                <?php if($errors->has('study_report')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('study_report')); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-1">
                                <?php if($child['study_report'] != ''): ?>
                                <a target="_blank" href="<?php echo e(url('upload/childern/'.$child['study_report'])); ?>" class="btn btn-sm btn-success btn-block" style="line-height: 28px;"><?php echo e(trans('admin.show')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_quran" class="col-sm-2 col-form-label"><?php echo e(trans('admin.quran_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_quran', $child['ar_quran'], ['class'=>'form-control','id'=>'ar_quran'])); ?>

                                <?php if($errors->has('ar_quran')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_quran')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_quran" class="col-sm-2 col-form-label"><?php echo e(trans('admin.quran_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_quran', $child['en_quran'], ['class'=>'form-control','id'=>'en_quran'])); ?>

                                <?php if($errors->has('en_quran')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_quran')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_skills" class="col-sm-2 col-form-label"><?php echo e(trans('admin.skills_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('ar_skills', $child['ar_skills'], ['class'=>'form-control','id'=>'ar_skills'])); ?>

                                <?php if($errors->has('ar_skills')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_skills')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_skills" class="col-sm-2 col-form-label"><?php echo e(trans('admin.skills_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('en_skills', $child['en_skills'], ['class'=>'form-control','id'=>'en_skills'])); ?>

                                <?php if($errors->has('en_skills')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_skills')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_psychological" class="col-sm-2 col-form-label"><?php echo e(trans('admin.psychological_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_psychological', $child['ar_psychological'], ['class'=>'form-control','id'=>'ar_psychological'])); ?>

                                <?php if($errors->has('ar_psychological')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_psychological')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_psychological" class="col-sm-2 col-form-label"><?php echo e(trans('admin.psychological_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_psychological', $child['en_psychological'], ['class'=>'form-control','id'=>'en_psychological'])); ?>

                                <?php if($errors->has('en_psychological')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_psychological')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_healthy" class="col-sm-2 col-form-label"><?php echo e(trans('admin.healthy_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_healthy', $child['ar_healthy'], ['class'=>'form-control','id'=>'ar_healthy'])); ?>

                                <?php if($errors->has('ar_healthy')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_healthy')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_healthy" class="col-sm-2 col-form-label"><?php echo e(trans('admin.healthy_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_healthy', $child['en_healthy'], ['class'=>'form-control','id'=>'en_healthy'])); ?>

                                <?php if($errors->has('en_healthy')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_healthy')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_illness" class="col-sm-2 col-form-label"><?php echo e(trans('admin.illness_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_illness', $child['ar_illness'], ['class'=>'form-control','id'=>'ar_illness'])); ?>

                                <?php if($errors->has('ar_illness')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_illness')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_illness" class="col-sm-2 col-form-label"><?php echo e(trans('admin.illness_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_illness', $child['en_illness'], ['class'=>'form-control','id'=>'en_illness'])); ?>

                                <?php if($errors->has('en_illness')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_illness')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_illness_desc" class="col-sm-2 col-form-label"><?php echo e(trans('admin.illness_desc_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('ar_illness_desc', $child['ar_illness_desc'], ['class'=>'form-control','id'=>'ar_illness_desc'])); ?>

                                <?php if($errors->has('ar_illness_desc')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_illness_desc')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_illness_desc" class="col-sm-2 col-form-label"><?php echo e(trans('admin.illness_desc_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('en_illness_desc', $child['en_illness_desc'], ['class'=>'form-control','id'=>'en_illness_desc'])); ?>

                                <?php if($errors->has('en_illness_desc')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_illness_desc')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="death_date" class="col-sm-2 col-form-label"><?php echo e(trans('admin.death_date')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::text('death_date', $child['death_date'], ['class'=>'form-control','id'=>'death_date'])); ?>

                                <?php if($errors->has('death_date')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('death_date')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_death_reason" class="col-sm-2 col-form-label"><?php echo e(trans('admin.death_reason_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_death_reason', $child['ar_death_reason'], ['class'=>'form-control','id'=>'ar_death_reason'])); ?>

                                <?php if($errors->has('ar_death_reason')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_death_reason')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_death_reason" class="col-sm-2 col-form-label"><?php echo e(trans('admin.death_reason_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_death_reason', $child['en_death_reason'], ['class'=>'form-control','id'=>'en_death_reason'])); ?>

                                <?php if($errors->has('en_death_reason')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_death_reason')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_responsible" class="col-sm-2 col-form-label"><?php echo e(trans('admin.responsible_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_responsible', $child['ar_responsible'], ['class'=>'form-control','id'=>'ar_responsible'])); ?>

                                <?php if($errors->has('ar_responsible')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_responsible')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_responsible" class="col-sm-2 col-form-label"><?php echo e(trans('admin.responsible_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_responsible', $child['en_responsible'], ['class'=>'form-control','id'=>'en_responsible'])); ?>

                                <?php if($errors->has('en_responsible')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_responsible')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_relative" class="col-sm-2 col-form-label"><?php echo e(trans('admin.relative_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_relative', $child['ar_relative'], ['class'=>'form-control','id'=>'ar_relative'])); ?>

                                <?php if($errors->has('ar_relative')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_relative')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_relative" class="col-sm-2 col-form-label"><?php echo e(trans('admin.relative_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_relative', $child['en_relative'], ['class'=>'form-control','id'=>'en_relative'])); ?>

                                <?php if($errors->has('en_relative')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_relative')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="brothers" class="col-sm-2 col-form-label"><?php echo e(trans('admin.brothers')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::number('brothers', $child['brothers'], ['class'=>'form-control','id'=>'brothers'])); ?>

                                <?php if($errors->has('brothers')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('brothers')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="sisters" class="col-sm-2 col-form-label"><?php echo e(trans('admin.sisters')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::number('sisters', $child['sisters'], ['class'=>'form-control','id'=>'sisters'])); ?>

                                <?php if($errors->has('sisters')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('sisters')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

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
                                        <?php $__currentLoopData = $child['Reports']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?php echo e($report['ar_name']); ?></td>
                                            <td style="vertical-align: middle;"><?php echo e($report['en_name']); ?></td>
                                            <td style="vertical-align: middle;"><?php echo e(trans('admin.approve_'.$report['active'])); ?></td>
                                            <td style="vertical-align: middle;"><a target="_blank" href="<?php echo e(url('upload/childern/'.$report['file'])); ?>" class="btn btn-sm btn-info"><?php echo e(trans('admin.show')); ?></a></td>
                                            <td style="vertical-align: middle;">
                                                <a href="<?php echo e(url('admin/childern_reports/'.$report['id'])); ?>" class="btn btn-sm btn-danger"><?php echo e(trans('admin.delete')); ?></a>
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
                <a href="<?php echo e(URL::to('admin/childern')); ?>" class="btn btn-default btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
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

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/childern/edit.blade.php ENDPATH**/ ?>
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
        <?php echo e(trans('admin.teachers')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/teachers')); ?>"> <?php echo e(trans('admin.teachers')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.teacher_edit')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.teacher_edit')); ?> : <?php echo e($teacher[$lang.'_name']); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/teachers/'.$teacher['id'])); ?>" method="post" enctype="multipart/form-data">
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
                                <?php echo e(Form::select('active',['yes'=>trans('admin.approve_yes'),'no'=>trans('admin.approve_no')], $teacher['active'], ['class'=>'form-control select2','id'=>'active'])); ?>

                                <?php if($errors->has('active')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('active')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country_id" class="col-sm-2 col-form-label"><?php echo e(trans('admin.country')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::select('country_id',$countries, $teacher['country_id'], ['class'=>'form-control select2','id'=>'country_id'])); ?>

                                <?php if($errors->has('country_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('country_id')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-sm-2 col-form-label"><?php echo e(trans('admin.gender')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::select('gender',['male'=>trans('admin.male'),'female'=>trans('admin.female')], $teacher['gender'], ['class'=>'form-control select2','id'=>'gender'])); ?>

                                <?php if($errors->has('gender')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('gender')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="required" class="col-sm-2 col-form-label"><?php echo e(trans('admin.required')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::select('required',['no'=>trans('admin.no'),'yes'=>trans('admin.yes')], $teacher['required'], ['class'=>'form-control','id'=>'required'])); ?>

                                <?php if($errors->has('required')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('required')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="amount" class="col-sm-2 col-form-label"><?php echo e(trans('admin.amount')); ?></label>
                            <div class="col-sm-3">
                                <?php echo e(Form::text('amount', $teacher['amount'], ['class'=>'form-control','id'=>'amount'])); ?>

                                <?php if($errors->has('amount')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('amount')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label class="col-sm-1 col-form-label"><?php echo e(trans('admin.kwd')); ?></label>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-2 col-form-label"><?php echo e(trans('admin.teacher_name_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_name', $teacher['ar_name'], ['class'=>'form-control','id'=>'ar_name'])); ?>

                                <?php if($errors->has('ar_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_name')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_name" class="col-sm-2 col-form-label"><?php echo e(trans('admin.teacher_name_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_name', $teacher['en_name'], ['class'=>'form-control','id'=>'en_name'])); ?>

                                <?php if($errors->has('en_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_nationality" class="col-sm-2 col-form-label"><?php echo e(trans('admin.nationality_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_nationality', $teacher['ar_nationality'], ['class'=>'form-control','id'=>'ar_nationality'])); ?>

                                <?php if($errors->has('ar_nationality')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_nationality')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_nationality" class="col-sm-2 col-form-label"><?php echo e(trans('admin.nationality_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_nationality', $teacher['en_nationality'], ['class'=>'form-control','id'=>'en_nationality'])); ?>

                                <?php if($errors->has('en_nationality')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_nationality')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_address" class="col-sm-2 col-form-label"><?php echo e(trans('admin.address_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_address', $teacher['ar_address'], ['class'=>'form-control','id'=>'ar_address'])); ?>

                                <?php if($errors->has('ar_address')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_address')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_address" class="col-sm-2 col-form-label"><?php echo e(trans('admin.address_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_address', $teacher['en_address'], ['class'=>'form-control','id'=>'en_address'])); ?>

                                <?php if($errors->has('en_address')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_address')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_status" class="col-sm-2 col-form-label"><?php echo e(trans('admin.status_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_status', $teacher['ar_status'], ['class'=>'form-control','id'=>'ar_status'])); ?>

                                <?php if($errors->has('ar_status')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_status')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_status" class="col-sm-2 col-form-label"><?php echo e(trans('admin.status_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_status', $teacher['en_status'], ['class'=>'form-control','id'=>'en_status'])); ?>

                                <?php if($errors->has('en_status')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_status')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label"><?php echo e(trans('admin.phone')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('phone', $teacher['phone'], ['class'=>'form-control','id'=>'phone'])); ?>

                                <?php if($errors->has('phone')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('phone')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="email" class="col-sm-2 col-form-label"><?php echo e(trans('admin.email')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('email', $teacher['email'], ['class'=>'form-control','id'=>'email'])); ?>

                                <?php if($errors->has('email')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('email')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_qualification" class="col-sm-2 col-form-label"><?php echo e(trans('admin.qualification_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_qualification', $teacher['ar_qualification'], ['class'=>'form-control','id'=>'ar_qualification'])); ?>

                                <?php if($errors->has('ar_qualification')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_qualification')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_qualification" class="col-sm-2 col-form-label"><?php echo e(trans('admin.qualification_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_qualification', $teacher['en_qualification'], ['class'=>'form-control','id'=>'en_qualification'])); ?>

                                <?php if($errors->has('en_qualification')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_qualification')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_qualification_source" class="col-sm-2 col-form-label"><?php echo e(trans('admin.qualification_source_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_qualification_source', $teacher['ar_qualification_source'], ['class'=>'form-control','id'=>'ar_qualification_source'])); ?>

                                <?php if($errors->has('ar_qualification_source')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_qualification_source')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_qualification_source" class="col-sm-2 col-form-label"><?php echo e(trans('admin.qualification_source_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_qualification_source', $teacher['en_qualification_source'], ['class'=>'form-control','id'=>'en_qualification_source'])); ?>

                                <?php if($errors->has('en_qualification_source')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_qualification_source')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-sm-2 col-form-label"><?php echo e(trans('admin.birth_date')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('birth_date', $teacher['birth_date'], ['class'=>'form-control','id'=>'birth_date'])); ?>

                                <?php if($errors->has('birth_date')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('birth_date')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="qualification_date" class="col-sm-2 col-form-label"><?php echo e(trans('admin.qualification_date')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('qualification_date', $teacher['qualification_date'], ['class'=>'form-control','id'=>'qualification_date'])); ?>

                                <?php if($errors->has('qualification_date')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('qualification_date')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_specialization" class="col-sm-2 col-form-label"><?php echo e(trans('admin.specialization_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_specialization', $teacher['ar_specialization'], ['class'=>'form-control','id'=>'ar_specialization'])); ?>

                                <?php if($errors->has('ar_specialization')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_specialization')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_specialization" class="col-sm-2 col-form-label"><?php echo e(trans('admin.specialization_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_specialization', $teacher['en_specialization'], ['class'=>'form-control','id'=>'en_specialization'])); ?>

                                <?php if($errors->has('en_specialization')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_specialization')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_career" class="col-sm-2 col-form-label"><?php echo e(trans('admin.careerr_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_career', $teacher['ar_career'], ['class'=>'form-control','id'=>'ar_career'])); ?>

                                <?php if($errors->has('ar_career')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_career')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_career" class="col-sm-2 col-form-label"><?php echo e(trans('admin.careerr_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_career', $teacher['en_career'], ['class'=>'form-control','id'=>'en_career'])); ?>

                                <?php if($errors->has('en_career')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_career')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_invitation" class="col-sm-2 col-form-label"><?php echo e(trans('admin.invitation_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('ar_invitation', $teacher['ar_invitation'], ['class'=>'form-control','id'=>'ar_invitation'])); ?>

                                <?php if($errors->has('ar_invitation')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_invitation')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_invitation" class="col-sm-2 col-form-label"><?php echo e(trans('admin.invitation_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('en_invitation', $teacher['en_invitation'], ['class'=>'form-control','id'=>'en_invitation'])); ?>

                                <?php if($errors->has('en_invitation')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_invitation')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_social" class="col-sm-2 col-form-label"><?php echo e(trans('admin.social_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('ar_social', $teacher['ar_social'], ['class'=>'form-control','id'=>'ar_social'])); ?>

                                <?php if($errors->has('ar_social')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_social')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_social" class="col-sm-2 col-form-label"><?php echo e(trans('admin.social_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('en_social', $teacher['en_social'], ['class'=>'form-control','id'=>'en_social'])); ?>

                                <?php if($errors->has('en_social')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_social')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_quran" class="col-sm-2 col-form-label"><?php echo e(trans('admin.quran_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_quran', $teacher['ar_quran'], ['class'=>'form-control','id'=>'ar_quran'])); ?>

                                <?php if($errors->has('ar_quran')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_quran')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_quran" class="col-sm-2 col-form-label"><?php echo e(trans('admin.quran_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_quran', $teacher['en_quran'], ['class'=>'form-control','id'=>'en_quran'])); ?>

                                <?php if($errors->has('en_quran')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_quran')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_skills" class="col-sm-2 col-form-label"><?php echo e(trans('admin.skills_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('ar_skills', $teacher['ar_skills'], ['class'=>'form-control','id'=>'ar_skills'])); ?>

                                <?php if($errors->has('ar_skills')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_skills')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_skills" class="col-sm-2 col-form-label"><?php echo e(trans('admin.skills_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::textarea('en_skills', $teacher['en_skills'], ['class'=>'form-control','id'=>'en_skills'])); ?>

                                <?php if($errors->has('en_skills')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_skills')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="responsible_country_id" class="col-sm-2 col-form-label"><?php echo e(trans('admin.responsible_country')); ?></label>
                            <div class="col-sm-10">
                                <?php echo e(Form::select('responsible_country_id',$countries, $teacher['responsible_country_id'], ['class'=>'form-control select2','id'=>'responsible_country_id'])); ?>

                                <?php if($errors->has('responsible_country_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('responsible_country_id')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_responsible_address" class="col-sm-2 col-form-label"><?php echo e(trans('admin.responsible_address_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_responsible_address', $teacher['ar_responsible_address'], ['class'=>'form-control','id'=>'ar_responsible_address'])); ?>

                                <?php if($errors->has('ar_responsible_address')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_responsible_address')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_responsible_address" class="col-sm-2 col-form-label"><?php echo e(trans('admin.responsible_address_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_responsible_address', $teacher['en_responsible_address'], ['class'=>'form-control','id'=>'en_responsible_address'])); ?>

                                <?php if($errors->has('en_responsible_address')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_responsible_address')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_responsible" class="col-sm-2 col-form-label"><?php echo e(trans('admin.responsible_ar')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('ar_responsible', $teacher['ar_responsible'], ['class'=>'form-control','id'=>'ar_responsible'])); ?>

                                <?php if($errors->has('ar_responsible')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_responsible')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="en_responsible" class="col-sm-2 col-form-label"><?php echo e(trans('admin.responsible_en')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('en_responsible', $teacher['en_responsible'], ['class'=>'form-control','id'=>'en_responsible'])); ?>

                                <?php if($errors->has('en_responsible')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_responsible')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="responsible_email" class="col-sm-2 col-form-label"><?php echo e(trans('admin.responsible_email')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('responsible_email', $teacher['responsible_email'], ['class'=>'form-control','id'=>'responsible_email'])); ?>

                                <?php if($errors->has('responsible_email')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('responsible_email')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="responsible_phone" class="col-sm-2 col-form-label"><?php echo e(trans('admin.responsible_phone')); ?></label>
                            <div class="col-sm-4">
                                <?php echo e(Form::text('responsible_phone', $teacher['responsible_phone'], ['class'=>'form-control','id'=>'responsible_phone'])); ?>

                                <?php if($errors->has('responsible_phone')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('responsible_phone')); ?></div>
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
                                <img src="<?php echo e(URL::to('upload/teachers/'.$teacher['image'])); ?>" class="img-thumbnail image_current">
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
                                        <?php $__currentLoopData = $teacher['Reports']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?php echo e($report['ar_name']); ?></td>
                                            <td style="vertical-align: middle;"><?php echo e($report['en_name']); ?></td>
                                            <td style="vertical-align: middle;"><?php echo e(trans('admin.approve_'.$report['active'])); ?></td>
                                            <td style="vertical-align: middle;"><a target="_blank" href="<?php echo e(url('upload/teachers/'.$report['file'])); ?>" class="btn btn-sm btn-info"><?php echo e(trans('admin.show')); ?></a></td>
                                            <td style="vertical-align: middle;">
                                                <a href="<?php echo e(url('admin/teachers_reports/'.$report['id'])); ?>" class="btn btn-sm btn-danger"><?php echo e(trans('admin.delete')); ?></a>
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
                <a href="<?php echo e(URL::to('admin/teachers')); ?>" class="btn btn-default btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
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
    $('#qualification_date').datepicker({
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

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/teachers/edit.blade.php ENDPATH**/ ?>
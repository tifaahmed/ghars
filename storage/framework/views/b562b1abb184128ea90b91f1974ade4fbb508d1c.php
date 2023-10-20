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
        <?php echo e(trans('admin.projects')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/projects')); ?>"> <?php echo e(trans('admin.projects')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.project_add')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.project_add')); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/projects/')); ?>" method="post" enctype="multipart/form-data">
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
                            <label for="active" class="col-sm-3 col-form-label"><?php echo e(trans('admin.active')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::select('active',['yet'=>trans('admin.approve_yet'),'yes'=>trans('admin.approve_yes'),'no'=>trans('admin.approve_no')], null, ['class'=>'form-control select2','id'=>'active'])); ?>

                                <?php if($errors->has('active')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('active')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

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
                            <label for="category_id" class="col-sm-3 col-form-label"><?php echo e(trans('admin.category')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::select('category_id',$categories, null, ['class'=>'form-control select2','id'=>'category_id'])); ?>

                                <?php if($errors->has('category_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('category_id')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company_id" class="col-sm-3 col-form-label"><?php echo e(trans('admin.company')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::select('company_id',$companies, null, ['class'=>'form-control select2','id'=>'company_id'])); ?>

                                <?php if($errors->has('company_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('company_id')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="step_id" class="col-sm-3 col-form-label"><?php echo e(trans('admin.step')); ?></label>
                            <div class="col-sm-9">
                                <div id="categories_steps">
                                    <?php echo e(Form::select('step_id',[''=>trans('admin.choose')], null, ['class'=>'form-control select2','id'=>'step_id'])); ?>

                                </div>
                                <?php if($errors->has('step_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('step_id')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="required" class="col-sm-3 col-form-label"><?php echo e(trans('admin.required')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::select('required',['no'=>trans('admin.no'),'yes'=>trans('admin.yes')], null, ['class'=>'form-control select2','id'=>'required'])); ?>

                                <?php if($errors->has('required')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('required')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-sm-3 col-form-label"><?php echo e(trans('admin.type')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::select('type',['private'=>trans('admin.private') , 'public'=>trans('admin.public')], null, ['class'=>'form-control select2','id'=>'type'])); ?>

                                <?php if($errors->has('type')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('type')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row users">
                            <label for="user_id" class="col-sm-3 col-form-label"><?php echo e(trans('admin.customer')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::select('user_id',$users, null, ['class'=>'form-control select2','id'=>'user_id'])); ?>

                                <?php if($errors->has('user_id')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('user_id')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-3 col-form-label"><?php echo e(trans('admin.project_name_ar')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('ar_name', null, ['class'=>'form-control','id'=>'ar_name'])); ?>

                                <?php if($errors->has('ar_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-3 col-form-label"><?php echo e(trans('admin.project_name_en')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('en_name', null, ['class'=>'form-control','id'=>'en_name'])); ?>

                                <?php if($errors->has('en_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-sm-3 col-form-label"><?php echo e(trans('admin.amount')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::text('amount', null, ['class'=>'form-control','id'=>'amount'])); ?>

                                <?php if($errors->has('amount')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('amount')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label class="col-sm-1 col-form-label"><?php echo e(trans('admin.kwd')); ?></label>
                        </div>

                        <div class="form-group row">
                            <label for="collect" class="col-sm-3 col-form-label"><?php echo e(trans('admin.collect')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::text('collect', null, ['class'=>'form-control','id'=>'collect'])); ?>

                                <?php if($errors->has('collect')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('collect')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label class="col-sm-1 col-form-label"><?php echo e(trans('admin.kwd')); ?></label>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-sm-3 col-form-label"><?php echo e(trans('admin.start_date')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('start_date', null, ['class'=>'form-control','id'=>'start_date'])); ?>

                                <?php if($errors->has('start_date')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('start_date')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_date" class="col-sm-3 col-form-label"><?php echo e(trans('admin.end_date')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('end_date', null, ['class'=>'form-control','id'=>'end_date'])); ?>

                                <?php if($errors->has('end_date')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('end_date')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="editor1" class="col-sm-3 col-form-label"><?php echo e(trans('admin.project_desc_ar')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::textarea('ar_desc', null, ['class'=>'form-control','id'=>'editor1','rows'=>10])); ?>

                                <?php if($errors->has('ar_desc')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_desc')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="editor2" class="col-sm-3 col-form-label"><?php echo e(trans('admin.project_desc_en')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::textarea('en_desc', null, ['class'=>'form-control','id'=>'editor2','rows'=>10])); ?>

                                <?php if($errors->has('en_desc')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_desc')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label image"><?php echo e(trans('admin.image')); ?><span dir="ltr">(Width: 500px * Height:500px)</span></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::file('image',['class'=>'form-control','id'=>'image'])); ?>

                                <?php if($errors->has('image')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('image')); ?></div>
                                <?php endif; ?>
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

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.add')); ?></button>
                <a href="<?php echo e(URL::to('admin/projects')); ?>" class="btn btn-default btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
            </div>

        </form>

    </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    //Date picker
    $('#start_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    $('#end_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    
    $(document).ready(function () {
        var type = $('#type').val();
        if (type == 'private') {
            $(".users").show();
        } else {
            $(".users").hide();
        }

        $('#type').change(function () {
            var type = $('#type').val();
            if (type == 'private') {
                $(".users").show();
            } else {
                $(".users").hide();
            }
        });



        $("body").on("change", "#category_id", function (e) {
            var val = $(this).val();
            var base_url = $('#base-url').val();
            if (val == "") {
                val = 0;
            }
            $.ajax({
                type: "GET",
                url: base_url + "/admin/ajax_categories_steps/" + val,
                success: function (data) {
                    $('#categories_steps').html(data);
                }
            });
        });

        var category_id = $('#category_id').val();
        var base_url = $('#base-url').val();
        if (category_id == "") {
            category_id = 0;
        }
        $.ajax({
            type: "GET",
            url: base_url + "/admin/ajax_categories_steps/" + category_id,
            success: function (data) {
                $('#categories_steps').html(data);
            }
        });
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

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/projects/create.blade.php ENDPATH**/ ?>
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
        <?php echo e(trans('admin.currencies')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/currencies')); ?>"> <?php echo e(trans('admin.currencies')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.currency_edit')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.currency_edit')); ?> : <?php echo e($currency[$lang.'_currency']); ?> (<?php echo e($currency[$lang.'_name']); ?>)</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/currencies/'.$currency['id'])); ?>" method="post" enctype="multipart/form-data">
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
                            <label for="equal" class="col-sm-3 col-form-label"><?php echo e(trans('admin.equal')); ?></label>
                            <div class="col-sm-8">
                                <?php echo e(Form::text('equal', $currency['equal'], ['class'=>'form-control price','id'=>'equal'])); ?>

                                <?php if($errors->has('equal')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('equal')); ?></div>
                                <?php endif; ?>
                            </div>
                            <label class="col-sm-1 col-form-label"><?php echo e(trans('admin.kwd')); ?></label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.save')); ?></button>
                <a href="<?php echo e(URL::to('admin/currencies')); ?>" class="btn btn-default btn-lg" style="font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
            </div>

        </form>

    </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $('.price').each(function (i, obj) {
        var value = $(this).val();
        if (isNaN(value)) {
            $(this).val('');
        } else if (!value) {
            // no value
            return;
        } else {
            // cast to 3 decimal places (KWD)
            value = parseFloat(value).toFixed(3);
            // update field value
            $(this).val(value);
        }
    });

    $(document).on('blur', '.price', function () {
        // get value - reject if the value is a character
        var value = $(this).val();
        if (isNaN(value)) {
            $(this).val('');
        } else if (!value) {
            // no value
            return;
        } else {
            // cast to 3 decimal places (KWD)
            value = parseFloat(value).toFixed(3);
            // update field value
            $(this).val(value);
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/currencies/edit.blade.php ENDPATH**/ ?>
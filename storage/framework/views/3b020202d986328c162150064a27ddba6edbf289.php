<?php $__env->startSection('content'); ?>
<?php
$lang = App::getLocale();
$text = "text-left";
$pull = "float-left";
$pulll = "float-right";
if ($lang == "ar") {
    $text = "text-right";
    $pull = "float-right";
    $pulll = "float-left";
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo e(trans('admin.countries')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.countries')); ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-12" id="active_response">

                </div>
            </div>

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

            <div class="box">
                
                <div class="box-body">
                    <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
                        <thead>
                            <tr> 
                                <th class="<?php echo e($text); ?>">#</th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.country')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.country_code')); ?></th>
                                <th class="<?php echo e($text); ?>">ISO</th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.active')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.edit')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="vertical-align: middle;"><?php echo e($country['id']); ?></td>
                                <td style="vertical-align: middle;"><?php echo e($country[$lang.'_name']); ?></td>
                                <td style="vertical-align: middle;" dir="ltr" class="<?php echo e($text); ?>"><?php echo e($country['code']); ?></td>
                                <td style="vertical-align: middle;"><?php echo e($country['iso']); ?></td>
                                <td style="vertical-align: middle;">
                                    <label class="switch" style="margin-bottom: 0;">
                                        <?php if($country['active'] == 'yes'): ?>
                                        <input class="switch_active" page='countries' id="<?php echo e($country['id']); ?>" type="checkbox" checked="">
                                        <?php else: ?>
                                        <input class="switch_active" page='countries' id="<?php echo e($country['id']); ?>" type="checkbox">
                                        <?php endif; ?>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td style="vertical-align: middle;">
                                    <?php echo e(Form::open(array('url' =>'admin/countries/'.$country->id.'/edit', 'method' => 'GET'))); ?>

                                    <button  type="submit" class="btn default btn-sm btn-success"><i class="fa fa-edit"></i> <?php echo e(trans('admin.edit')); ?> </button>
                                    <?php echo e(Form::close()); ?>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->          
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?php echo e(Form::open(array('url' =>'admin/delete_all/countries', 'method' => 'POST'))); ?>

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(trans('admin.delete_all')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select id="ids" name="ids[]" class="form-control select2" multiple="multiple" data-placeholder="<?php echo e(trans('admin.delete_all')); ?>" style="width: 100%;" required="">
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $one): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($one['id']); ?>"><?php echo e($one[$lang.'_name']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="modal-footer">
                <button  type="submit" class="btn btn-primary <?php echo e($pull); ?>"><?php echo e(trans('admin.confrim')); ?> </button>
                <button type="button" class="btn btn-danger <?php echo e($pulll); ?>" data-dismiss="modal"><?php echo e(trans('admin.cancel')); ?></button>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/countries/index.blade.php ENDPATH**/ ?>
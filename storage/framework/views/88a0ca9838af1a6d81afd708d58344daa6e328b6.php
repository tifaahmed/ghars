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
        <?php echo e(trans('admin.donations')); ?> : <?php echo e($family[$lang.'_name']); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/families')); ?>"> <?php echo e(trans('admin.families')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.donations')); ?></li>
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

            <?php if(Session::has('error')): ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible">
                        <?php echo e(Session::get('error')); ?>

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
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.customer')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.amount')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.payment_id')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.transaction_id')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.name')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.phone')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.email')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.date')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $family['Donations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <?php if($donation['user_type'] == 'user'): ?>
                                    <?php echo e($donation['User']['name']); ?>

                                    <?php else: ?>
                                    <?php echo e($donation['Visitor']['name']); ?>

                                    <?php endif; ?>
                                </td>
                                <td style="vertical-align: middle;"><?php echo e($family['amount'].' '.trans('admin.kwd')); ?></td>
                                <td style="vertical-align: middle;"><?php echo e($family['payment_id']); ?></td>
                                <td style="vertical-align: middle;"><?php echo e($family['transaction_id']); ?></td>
                                <td style="vertical-align: middle;"><?php echo e($family['name']); ?></td>
                                <td style="vertical-align: middle;"><?php echo e($family['phone']); ?></td>
                                <td style="vertical-align: middle;"><?php echo e($family['email']); ?></td>
                                <td style="vertical-align: middle;"><?php echo e($family['created_at']); ?></td>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/families/show.blade.php ENDPATH**/ ?>
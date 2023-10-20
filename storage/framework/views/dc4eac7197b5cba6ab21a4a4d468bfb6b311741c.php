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
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.currencies')); ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
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

            <div class="box">
                <div class="box-body">
                    <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
                        <thead>
                            <tr> 
                                <th class="<?php echo e($text); ?>">#</th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.currency_name_ar')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.currency_name_en')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.equal')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.edit')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($currency['sort']); ?></td>
                                <td><?php echo e($currency['ar_currency']); ?> (<?php echo e($currency['ar_name']); ?>)</td>
                                <td><?php echo e($currency['en_currency']); ?> (<?php echo e($currency['en_name']); ?>)</td>
                                <td><?php echo e(number_format($currency['equal'],3,'.','') .' '.trans('admin.kwd')); ?></td>
                                <td>
                                    <?php echo e(Form::open(array('url' =>'admin/currencies/'.$currency->id.'/edit', 'method' => 'GET'))); ?>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/currencies/index.blade.php ENDPATH**/ ?>
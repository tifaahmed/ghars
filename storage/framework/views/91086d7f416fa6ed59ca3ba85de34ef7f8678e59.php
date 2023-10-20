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
        <?php echo e(trans('admin.childern')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.childern')); ?></li>
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
                <div class="box-header">
                    <a href="<?php echo e(URL::to('admin/childern/create')); ?>" class="btn btn-lg bg-black"><?php echo e(trans('admin.child_add')); ?></a>
                </div>
                <div class="box-body">
                    <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
                        <thead>
                            <tr>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.country')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.gender')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.child_name')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.birth_date')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.study_stage')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.amount')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.active')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.donations')); ?></th>
                                <th class="<?php echo e($text); ?>"><?php echo e(trans('admin.edit')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $childern; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="vertical-align: middle;"><?php echo e($child['Country'][$lang.'_name']); ?></td>
                                <td style="vertical-align: middle;"><?php echo e(trans('admin.'.$child['gender'])); ?></td>
                                <td style="vertical-align: middle;"><?php echo e($child[$lang.'_name']); ?></td>
                                <td style="vertical-align: middle;"><?php echo e($child['birth_date']); ?></td>
                                <td style="vertical-align: middle;"><?php echo e($child[$lang.'_study_stage']); ?></td>
                                <td style="vertical-align: middle;"><?php echo e($child['amount'].' '.trans('admin.kwd')); ?></td>
                                <td style="vertical-align: middle;">
                                    <label class="switch" style="margin-bottom: 0;">
                                        <?php if($child['active'] == 'yes'): ?>
                                        <input class="switch_active" page='childern' id="<?php echo e($child['id']); ?>" type="checkbox" checked="">
                                        <?php else: ?>
                                        <input class="switch_active" page='childern' id="<?php echo e($child['id']); ?>" type="checkbox">
                                        <?php endif; ?>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td style="vertical-align: middle;">
                                    <?php echo e(Form::open(array('url' =>'admin/childern/'.$child->id, 'method' => 'GET'))); ?>

                                    <button  type="submit" class="btn default btn-sm bg-purple"><i class="fa fa-usd"></i> <?php echo e(trans('admin.show')); ?> </button>
                                    <?php echo e(Form::close()); ?>

                                </td>
                                <td style="vertical-align: middle;">
                                    <?php echo e(Form::open(array('url' =>'admin/childern/'.$child->id.'/edit', 'method' => 'GET'))); ?>

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
<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/childern/index.blade.php ENDPATH**/ ?>
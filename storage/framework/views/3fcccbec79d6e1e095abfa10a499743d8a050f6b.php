<?php $__env->startSection('content'); ?>

<!-- /.login-logo -->
<div class="login-box-body">
    <p class="login-box-msg"><?php echo e(trans('admin.sign_in')); ?></p>

    <form action="<?php echo e(URL::to('admin/login')); ?>" method="post" >
        <?php echo e(csrf_field()); ?>



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

        <div class="form-group has-feedback">
            <label><?php echo e(trans('admin.email')); ?></label>
            <?php echo e(Form::text('email',null,['class'=>'form-control','required'])); ?>

        </div>
        <div class="form-group has-feedback">
            <?php echo e(trans('admin.password')); ?>

            <?php echo e(Form::input('password','password',null,['class'=>'form-control','required'])); ?>

        </div>
        <div class="row">
            <div class="col-6">
                <div class="checkbox">
                    <input type="checkbox" name="remember" id="basic_checkbox_1" >
                    <label for="basic_checkbox_1"><?php echo e(trans('admin.remember')); ?></label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-6">
                <div class="fog-pwd">
                    <a href="<?php echo e(URL::to('password/reset?from=web')); ?>"><i class="ion ion-locked"></i> <?php echo e(trans('admin.forget_password')); ?></a><br>
                </div>
            </div>
            <!--        /.col -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-info btn-block btn-flat margin-top-10"><?php echo e(trans('admin.login')); ?></button>
            </div>
            <!-- /.col -->
        </div>
    </form>
</div>

<!-- /.login-box-body -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/home/login.blade.php ENDPATH**/ ?>
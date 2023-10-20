<?php $lang = App::getLocale(); ?>


<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.profile')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e(trans('admin.profile')); ?></h3>
    </div>
</section>

<!--start profile section-->
<section class="profile_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row profileinV__row">
            <div class="col-12 col-md-5 col-lg-3">
                <div class="sideBar__menu">
                    <ul class="sideBar__list">
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('profile')); ?>" class="sideBar__link active_link">
                                <img src="<?php echo e(url('interface')); ?>/img/profile-circle.png" alt="<?php echo e(trans('admin.profile')); ?>" class="profileTH_icon">
                                <span><?php echo e(trans('admin.profile')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('my_projects')); ?>" class="sideBar__link ">
                                <img src="<?php echo e(url('interface')); ?>/img/archive-book.png" alt="<?php echo e(trans('admin.my_projects')); ?>" class="profileTH_icon">
                                <span><?php echo e(trans('admin.my_projects')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('my_projects_donations')); ?>" class="sideBar__link ">
                                <img src="<?php echo e(url('interface')); ?>/img/routing.png" alt="<?php echo e(trans('admin.projects_donations')); ?>" class="profileTH_icon">
                                <span><?php echo e(trans('admin.projects_donations')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('my_childern')); ?>" class="sideBar__link ">
                                <img src="<?php echo e(url('interface')); ?>/img/wallet.png" alt="<?php echo e(trans('admin.childern')); ?>" class="profileTH_icon">
                                <span><?php echo e(trans('admin.childern')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('my_families')); ?>" class="sideBar__link ">
                                <img src="<?php echo e(url('interface')); ?>/img/receipt-text.png" alt="<?php echo e(trans('admin.families')); ?>" class="profileTH_icon">
                                <span><?php echo e(trans('admin.families')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('my_teachers')); ?>" class="sideBar__link ">
                                <img src="<?php echo e(url('interface')); ?>/img/routing.png" alt="<?php echo e(trans('admin.teachers')); ?>" class="profileTH_icon">
                                <span><?php echo e(trans('admin.teachers')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('logout')); ?>" class="sideBar__link ">
                                <img src="<?php echo e(url('interface')); ?>/img/task-square.png" alt="<?php echo e(trans('admin.logout')); ?>" class="profileTH_icon">
                                <span><?php echo e(trans('admin.logout')); ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-9">
                <div class="profInner_WrapDes">
                    <div class="myInfo__taBorder">
                        <h3 class="myInfo_title"><?php echo e(trans('admin.profile')); ?></h3>
                        <div class="myINForm__Wrapz">
                            <form action="<?php echo e(url('profile')); ?>" method="post" class="myProInfo__form">
                                <?php echo e(csrf_field()); ?>


                                <div class="form__row">
                                    <div class="col-12 col-lg-6">
                                        <label for="name" class="profileV__label"><?php echo e(trans('admin.name')); ?></label>
                                        <?php echo e(Form::text('name', Auth::User()->name, ['class'=>'profileV__input','id'=>'name'])); ?>

                                        <?php if($errors->has('name')): ?>
                                        <div class="alert alert-danger"><?php echo e($errors->first('name')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="country_id" class="profileV__label"><?php echo e(trans('admin.country_code')); ?></label>
                                        <?php echo e(Form::select('country_id',$codes, Auth::User()->country_id, ['class'=>'profileV__input','id'=>'country_id'])); ?>

                                        <?php if($errors->has('country_id')): ?>
                                        <div class="alert alert-danger"><?php echo e($errors->first('country_id')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="phone" class="profileV__label"><?php echo e(trans('admin.phone')); ?></label>
                                        <?php echo e(Form::text('phone', Auth::User()->phone, ['class'=>'profileV__input','id'=>'phone'])); ?>

                                        <?php if($errors->has('phone')): ?>
                                        <div class="alert alert-danger"><?php echo e($errors->first('phone')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="whatsapp" class="profileV__label"><?php echo e(trans('admin.whatsapp')); ?></label>
                                        <?php echo e(Form::text('whatsapp', Auth::User()->whatsapp, ['class'=>'profileV__input','id'=>'whatsapp'])); ?>

                                        <?php if($errors->has('whatsapp')): ?>
                                        <div class="alert alert-danger"><?php echo e($errors->first('whatsapp')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="email" class="profileV__label"><?php echo e(trans('admin.email')); ?></label>
                                        <?php echo e(Form::text('email', Auth::User()->email, ['class'=>'profileV__input','id'=>'email'])); ?>

                                        <?php if($errors->has('email')): ?>
                                        <div class="alert alert-danger"><?php echo e($errors->first('email')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="password" class="profileV__label"><?php echo e(trans('admin.password')); ?></label>
                                        <?php echo e(Form::input('password','password', null, ['class'=>'profileV__input','id'=>'password'])); ?>

                                        <?php if($errors->has('password')): ?>
                                        <div class="alert alert-danger"><?php echo e($errors->first('password')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="governate" class="profileV__label"><?php echo e(trans('admin.governate')); ?></label>
                                        <?php echo e(Form::text('governate', Auth::User()->governate, ['class'=>'profileV__input','id'=>'governate'])); ?>

                                        <?php if($errors->has('governate')): ?>
                                        <div class="alert alert-danger"><?php echo e($errors->first('governate')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="city" class="profileV__label"><?php echo e(trans('admin.city')); ?></label>
                                        <?php echo e(Form::text('city', Auth::User()->city, ['class'=>'profileV__input','id'=>'city'])); ?>

                                        <?php if($errors->has('city')): ?>
                                        <div class="alert alert-danger"><?php echo e($errors->first('city')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="street" class="profileV__label"><?php echo e(trans('admin.street')); ?></label>
                                        <?php echo e(Form::text('street', Auth::User()->street, ['class'=>'profileV__input','id'=>'street'])); ?>

                                        <?php if($errors->has('street')): ?>
                                        <div class="alert alert-danger"><?php echo e($errors->first('street')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <button type="submit" class="contSubmit__btn mXST__auto"><?php echo e(trans('admin.save')); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/profile.blade.php ENDPATH**/ ?>
<?php $lang = App::getLocale(); ?>


<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.projects_donations')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e(trans('admin.projects_donations')); ?></h3>
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
                            <a href="<?php echo e(url('profile')); ?>" class="sideBar__link">
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
                            <a href="<?php echo e(url('my_projects_donations')); ?>" class="sideBar__link active_link">
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
                            <a href="<?php echo e(url('delayed_donations')); ?>" class="sideBar__link ">
                                <img src="<?php echo e(url('interface')); ?>/img/wallet.png" alt="<?php echo e(trans('admin.delayed_donations')); ?>" class="profileTH_icon">
                                <span><?php echo e(trans('admin.delayed_donations')); ?></span>
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
                        <h3 class="myInfo_title"><?php echo e(trans('admin.projects_donations')); ?></h3>
                        <div class="rTableOver_wrapper">
                            <table class="table reports__table">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo e(trans('admin.project_name')); ?></th>
                                        <th scope="col"><?php echo e(trans('admin.amount')); ?></th>
                                        <th scope="col"><?php echo e(trans('admin.pay_type')); ?></th>
                                        <th scope="col"><?php echo e(trans('admin.as_gift')); ?></th>
                                        <th scope="col"><?php echo e(trans('admin.date')); ?></th>
                                        <th scope="col"><?php echo e(trans('admin.status')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($donation['Project'][$lang.'_name']); ?></td>
                                        <td><?php echo e($donation['amount'].' '.$donation[$lang.'_currency']); ?></td>
                                        <td><?php echo e(trans('admin.'.$donation['pay_type'])); ?></td>
                                        <td>
                                            <?php if($donation['gift_id'] != 0): ?>
                                            <?php echo e($donation['Gift'][$lang.'_name']); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($donation['created_at']->format('Y-m-d')); ?></td>
                                        <td><?php echo e(trans('admin.paid_'.$donation['active'])); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/my_projects_donations.blade.php ENDPATH**/ ?>
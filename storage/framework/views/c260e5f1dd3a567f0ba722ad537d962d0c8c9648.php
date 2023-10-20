<?php $lang = App::getLocale(); ?>


<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.delayed_donations')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e(trans('admin.delayed_donations')); ?></h3>
    </div>
</section>

<!--start profile section-->
<section class="profile_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row profileinV__row">
            <div class="col-12 col-md-12">
                <div class="profInner_WrapDes">
                    <div class="myInfo__taBorder">
                        <h3 class="myInfo_title"><?php echo e(trans('admin.delayed_donations')); ?></h3>
                        <div class="rTableOver_wrapper">
                            <table class="table reports__table">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo e(trans('admin.department')); ?></th>
                                        <th scope="col"><?php echo e(trans('admin.donate_for')); ?></th>
                                        <th scope="col"><?php echo e(trans('admin.amount')); ?></th>
                                        <th scope="col"><?php echo e(trans('admin.type')); ?></th>
                                        <th scope="col"><?php echo e(trans('admin.pay_type')); ?></th>
                                        <th scope="col"><?php echo e(trans('admin.as_gift')); ?></th>
                                        <th scope="col"><?php echo e(trans('admin.date')); ?></th>
                                        <th scope="col"><?php echo e(trans('admin.pay')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(trans('admin.'.$donation['category'])); ?></td>
                                        <td>
                                            <?php if($donation['category'] == 'childern' && $donation['rel_id'] > 0): ?>
                                            <?php echo e($donation['Child'][$lang.'_name']); ?>

                                            <?php elseif($donation['category'] == 'families' && $donation['rel_id'] > 0): ?>
                                            <?php echo e($donation['Family'][$lang.'_name']); ?>

                                            <?php elseif($donation['category'] == 'teachers' && $donation['rel_id'] > 0): ?>
                                            <?php echo e($donation['Teacher'][$lang.'_name']); ?>

                                            <?php elseif($donation['category'] == 'projects' && $donation['rel_id'] > 0): ?>
                                            <?php echo e($donation['Project'][$lang.'_name']); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($donation['amount'].' '.$donation[$lang.'_currency']); ?></td>
                                        <td><?php echo e(trans('admin.'.$donation['type'].'_time')); ?></td>
                                        <td><?php echo e(trans('admin.'.$donation['pay_type'])); ?></td>
                                        <td>
                                            <?php if($donation['gift_id'] != 0): ?>
                                            <?php echo e($donation['Gift'][$lang.'_name']); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($donation['created_at']->format('Y-m-d')); ?></td>
                                        <td> <a style="color: #000;" href="<?php echo e(url('pay/'.$donation['id'])); ?>" class="printRepo_link"><?php echo e(trans('admin.pay')); ?></a> </td>
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
<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/delayed_donations.blade.php ENDPATH**/ ?>
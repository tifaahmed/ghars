<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
$dir = 'right';
if ($lang == 'ar') {
    $dir = 'left';
}
?>


<?php $__env->startSection('title'); ?>
<?php echo e($family[$lang.'_name']); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e($family[$lang.'_name']); ?></h3>
    </div>
</section>

<section class="profile_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row profileinV__row">
            <div class="col-12 col-md-5 col-lg-3">
                <div class="sideBar__menu">
                    <ul class="sideBar__list">
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('family/'.$family['id'].'?type=info')); ?>" class="sideBar__link active_link">
                                <img src="<?php echo e(url('interface')); ?>/img/profile-circle.png" alt="" class="profileTH_icon">
                                <span><?php echo e(trans('admin.sponsorship_info')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('family/'.$family['id'].'?type=social')); ?>" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/archive-book.png" alt="" class="profileTH_icon">
                                <span><?php echo e(trans('admin.sponsorship_social')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('family/'.$family['id'].'?type=member')); ?>" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/archive-book.png" alt="" class="profileTH_icon">
                                <span><?php echo e(trans('admin.member')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('family/'.$family['id'].'?type=reports')); ?>" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/task-square.png" alt="" class="profileTH_icon">
                                <span><?php echo e(trans('admin.reports')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('family/'.$family['id'].'?type=gift')); ?>" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/wallet.png" alt="" class="profileTH_icon">
                                <span><?php echo e(trans('admin.family_gift')); ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-9">
                <div class="profInner_WrapDes">
                    <div class="myInfo__taBorder">
                        <h3 class="myInfo_title row">
                            <div class="col-12 col-lg-6">
                                <?php echo e(trans('admin.sponsorship_info')); ?>

                            </div>
                            <div class="col-12 col-lg-6">
                                <a class="contSubmit__btn subMidBtn_width" style="cursor: pointer; margin: 0; float: <?php echo e($dir); ?>;"data-toggle="modal" data-target="#guarantModal"><?php echo e(trans('admin.donate').' : '.$family['amount'] / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']); ?></a>
                            </div>
                        </h3>
                        <div class="myINForm__Wrapz">
                            <form action="" class="myProInfo__form">
                                <div class="form__row">
                                    <div class="col-12 col-lg-4">
                                        <div class="childIN_thumb">
                                            <img src="<?php echo e(url('upload/families/'.$family['image'])); ?>" alt="<?php echo e($family[$lang.'_name']); ?>" class="childIMG_one">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-8">
                                        <div class="innerForm__row">
                                            <div class="col-12 col-lg-12">
                                                <label for="name1" class="profileV__label"><?php echo e(trans('admin.family_name')); ?></label>
                                                <input type="text" class="profileV__input" value="<?php echo e($family[$lang.'_name']); ?>" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="gender" class="profileV__label"><?php echo e(trans('admin.gender')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e(trans('admin.'.$family['gender'])); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="parent_status" class="profileV__label"><?php echo e(trans('admin.parent_status')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($family[$lang.'_parent_status']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="civil_id" class="profileV__label"><?php echo e(trans('admin.civil_id')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($family['civil_id']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="country" class="profileV__label"><?php echo e(trans('admin.country')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($family['Country'][$lang.'_name']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="nationality" class="profileV__label"><?php echo e(trans('admin.nationality')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($family[$lang.'_nationality']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="death_date" class="profileV__label"><?php echo e(trans('admin.death_date')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($family['death_date']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-١٢">
                                        <label for="death_reason" class="profileV__label"><?php echo e(trans('admin.death_reason')); ?></label>
                                        <textarea class="profileV__input" disabled=""><?php echo e($family[$lang.'_death_reason']); ?></textarea>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="members_count" class="profileV__label"><?php echo e(trans('admin.members_count')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($family['members_count']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="males" class="profileV__label"><?php echo e(trans('admin.males')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($family['males']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="females" class="profileV__label"><?php echo e(trans('admin.females')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($family['females']); ?>" disabled="">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php echo $__env->make('interface.family_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).ready(function () {
        var gift = $('#gift').val();
        if (gift == 'yes') {
            $('.gift_name').show();
        } else {
            $('.gift_name').hide();
        }

        $("body").on("change", "#gift", function (e) {
            var gift = $('#gift').val();
            if (gift == 'yes') {
                $('.gift_name').show();
            } else {
                $('.gift_name').hide();
            }
        });

        var country_id = $('#country_id').val();
        var link = '<?php echo url('/'); ?>';
        if (country_id != "") {
            $.ajax({
                type: "GET",
                url: link + "/ajax_country/" + country_id,
                success: function (data) {
                    $('#allGurntPay__tabs').html(data);
                }
            });
        }

        $("body").on("change", "#country_id", function (e) {
            var country_id = $(this).val();
            var link = '<?php echo url('/'); ?>';
            if (country_id != "") {
                $.ajax({
                    type: "GET",
                    url: link + "/ajax_country/" + country_id,
                    success: function (data) {
                        $('#allGurntPay__tabs').html(data);
                    }
                });
            }
        });

        $("body").on("click", ".pay_type", function (e) {
            var pay_type = $(this).attr('value');
            $('#pay_type').val(pay_type);
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/family_info.blade.php ENDPATH**/ ?>
<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
$dir = 'right';
if ($lang == 'ar') {
    $dir = 'left';
}
?>


<?php $__env->startSection('title'); ?>
<?php echo e($teacher[$lang.'_name']); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e($teacher[$lang.'_name']); ?></h3>
    </div>
</section>

<section class="profile_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row profileinV__row">
            <div class="col-12 col-md-5 col-lg-3">
                <div class="sideBar__menu">
                    <ul class="sideBar__list">
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('teacher/'.$teacher['id'].'?type=info')); ?>" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/profile-circle.png" alt="" class="profileTH_icon">
                                <span><?php echo e(trans('admin.sponsorship_info')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('teacher/'.$teacher['id'].'?type=qualification')); ?>" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/archive-book.png" alt="" class="profileTH_icon">
                                <span><?php echo e(trans('admin.sponsorship_qualifications')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('teacher/'.$teacher['id'].'?type=oranization')); ?>" class="sideBar__link active_link">
                                <img src="<?php echo e(url('interface')); ?>/img/archive-book.png" alt="" class="profileTH_icon">
                                <span><?php echo e(trans('admin.sponsorship_oranization')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('teacher/'.$teacher['id'].'?type=video')); ?>" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/archive-book.png" alt="" class="profileTH_icon">
                                <span><?php echo e(trans('admin.videos')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('teacher/'.$teacher['id'].'?type=reports')); ?>" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/task-square.png" alt="" class="profileTH_icon">
                                <span><?php echo e(trans('admin.reports')); ?></span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="<?php echo e(url('teacher/'.$teacher['id'].'?type=gift')); ?>" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/wallet.png" alt="" class="profileTH_icon">
                                <span><?php echo e(trans('admin.teacher_gift')); ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-9">
                <div class="profInner_WrapDes">
                    <div class="myInfo__taBorder">
                        <h3 class="myInfo_title row">
                            <div class="col-12 col-lg-8">
                                <?php echo e(trans('admin.sponsorship_oranization')); ?>

                            </div>
                            <div class="col-12 col-lg-4">
                                <a class="contSubmit__btn subMidBtn_width" style="cursor: pointer; margin: 0; float: <?php echo e($dir); ?>;"data-toggle="modal" data-target="#guarantModal"><?php echo e(trans('admin.donate').' : '.$teacher['amount'] / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']); ?></a>
                            </div>
                        </h3>
                        <div class="myINForm__Wrapz">
                            <form action="" class="myProInfo__form">
                                <div class="form__row">
                                    <div class="col-12 col-lg-6">
                                        <label for="country" class="profileV__label"><?php echo e(trans('admin.country')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($teacher['ResponsibleCountry'][$lang.'_name']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="responsible_address" class="profileV__label"><?php echo e(trans('admin.responsible_address')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($teacher[$lang.'_responsible_address']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="responsible" class="profileV__label"><?php echo e(trans('admin.responsible')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($teacher[$lang.'_responsible']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="responsible_email" class="profileV__label"><?php echo e(trans('admin.responsible_email')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($teacher['responsible_email']); ?>" disabled="">
                                    </div>  
                                    <div class="col-12 col-lg-6">
                                        <label for="responsible_phone" class="profileV__label"><?php echo e(trans('admin.responsible_phone')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($teacher['responsible_phone']); ?>" disabled="">
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
<?php echo $__env->make('interface.teacher_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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


<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/teacher_oranization.blade.php ENDPATH**/ ?>
<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
$dir = 'right';
if ($lang == 'ar') {
    $dir = 'left';
}
?>


<?php $__env->startSection('title'); ?>
<?php echo e($project[$lang.'_name']); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e($project[$lang.'_name']); ?></h3>
    </div>
</section>

<section class="profile_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row profileinV__row">
            <div class="col-12">
                <div class="profInner_WrapDes">
                    <div class="myInfo__taBorder">
                        <h3 class="myInfo_title row">
                            <div class="col-12 col-lg-6">
                                <?php echo e($project[$lang.'_name']); ?>

                            </div>
                            <div class="col-12 col-lg-6">
                                <a class="contSubmit__btn subMidBtn_width" style="cursor: pointer; margin: 0; float: <?php echo e($dir); ?>;"data-toggle="modal" data-target="#guarantModal"><?php echo e(trans('admin.donate')); ?></a>
                            </div>
                        </h3>
                        <div class="myINForm__Wrapz">
                            <form action="" class="myProInfo__form">
                                <div class="form__row">
                                    <div class="col-12 col-lg-4">
                                        <label for="country" class="profileV__label"><?php echo e(trans('admin.country')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($project['Country'][$lang.'_name']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="category" class="profileV__label"><?php echo e(trans('admin.category')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($project['Category'][$lang.'_name']); ?>" disabled="">
                                    </div>
                                    <?php if($project['Step']): ?>
                                    <div class="col-12 col-lg-4">
                                        <label for="step" class="profileV__label"><?php echo e(trans('admin.step')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($project['Step'][$lang.'_name']); ?>" disabled="">
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-12 col-lg-4">
                                        <label for="start_date" class="profileV__label"><?php echo e(trans('admin.start_date')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($project['start_date']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="end_date" class="profileV__label"><?php echo e(trans('admin.end_date')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($project['end_date']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="total" class="profileV__label"><?php echo e(trans('admin.total')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($project['amount'] / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="remain" class="profileV__label"><?php echo e(trans('admin.remain')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e(($project['amount'] - $project['collect']) / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']); ?>" disabled="">
                                    </div>
                                    <?php if(Auth::Check() && $project['user_id'] == Auth::User()->id && $project['company_id'] > 0): ?>
                                    <div class="col-12 col-lg-4">
                                        <label for="company" class="profileV__label"><?php echo e(trans('admin.company')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($project['Company'][$lang.'_name']); ?>" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="phone" class="profileV__label"><?php echo e(trans('admin.phone')); ?></label>
                                        <input type="text" class="profileV__input" value="<?php echo e($project['Company']['Country']['code'].$project['Company']['phone']); ?>" disabled="">
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-12 text-block text-justify" style="line-height: 32px;">
                                        <?php echo $project[$lang.'_desc']; ?>

                                    </div>
                                </div>

                                <div class="projReport_wrap">
                                    <h5 class="ntSearch_title"><?php echo e(trans('admin.reports')); ?></h5>
                                    <div class="rTableOver_wrapper">
                                        <table class="table reports__table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><?php echo e(trans('admin.report_name')); ?></th>
                                                    <th scope="col"><?php echo e(trans('admin.print')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $project['Reports']->where('active','yes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($report[$lang.'_name']); ?></td>
                                                    <td> <a style="color: #000;" href="<?php echo e(url('upload/projects/'.$report['file'])); ?>" target="_balnk" class="printRepo_link"> <img src="<?php echo e(url('interface')); ?>/img/print.svg" alt="" class="printR_icon"><?php echo e(trans('admin.print')); ?></a> </td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <?php if(Auth::Check() && $project['user_id'] == Auth::User()->id): ?>
                                <div class="projReport_wrap">
                                    <h5 class="ntSearch_title"><?php echo e(trans('admin.donations')); ?></h5>
                                    <div class="rTableOver_wrapper">
                                        <table class="table reports__table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><?php echo e(trans('admin.customer')); ?></th>
                                                    <th scope="col"><?php echo e(trans('admin.amount')); ?></th>
                                                    <th scope="col"><?php echo e(trans('admin.as_gift')); ?></th>
                                                    <th scope="col"><?php echo e(trans('admin.date')); ?></th>
                                                    <th scope="col"><?php echo e(trans('admin.pay_type')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $project['Donations']->where('active','yes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php if($donation['user_type'] == 'user'): ?>
                                                        <?php echo e($donation['User']['name']); ?>

                                                        <?php else: ?>
                                                        <?php echo e($donation['Visitor']['name']); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($donation['amount'].' '.$donation[$lang.'_currency']); ?></td>
                                                    <td><?php echo e($donation['name']); ?></td>
                                                    <td><?php echo e($donation['created_at']->format('Y-m-d')); ?></td>
                                                    <td><?php echo e(trans('admin.'.$donation['pay_type'])); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php endif; ?>
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
<div class="modal loginModal fade" id="guarantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <img src="<?php echo e(url('interface')); ?>/img/si.png" alt="" class="check__thumb">
            <div class="modal-body">         
                <form action="<?php echo e(url('donation/projects/'.$project['id'])); ?>" method="post" class="loginV__form">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(Form::hidden('pay_type','knet',['id'=>'pay_type'])); ?>

                    <?php echo e(Form::hidden('time','one',['id'=>'time'])); ?>


                    <h3 class="loginModal_title"><?php echo e(trans('admin.donate')); ?></h3>
                    <p class="logintModal_des"><?php echo e($project[$lang.'_name']); ?></p>
                    <div class="form__row">
                        <?php if(!Auth::Check()): ?>
                        <div class="col-12 col-lg-6">
                            <label for="name" class="login__label"><?php echo e(trans('admin.name')); ?></label>
                            <?php echo e(Form::text('name',null,['class'=>'loginV__input','required'])); ?>

                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="email" class="login__label"><?php echo e(trans('admin.email')); ?></label>
                            <?php echo e(Form::text('email',null,['class'=>'loginV__input'])); ?>

                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="country_id" class="login__label"><?php echo e(trans('admin.country')); ?></label>
                            <?php echo e(Form::select('country_id',$countries, null, ['class'=>'loginV__input','id'=>'country_id','required'])); ?>

                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="phone" class="login__label"><?php echo e(trans('admin.phone')); ?></label>
                            <?php echo e(Form::text('phone',null,['class'=>'loginV__input','required'])); ?>

                        </div>
                        <?php else: ?>
                        <?php echo e(Form::hidden('country_id',Auth::User()->country_id, ['id'=>'country_id'])); ?>

                        <?php endif; ?>

                        <div class="col-12 col-lg-6">
                            <label for="amount" class="login__label"><?php echo e(trans('admin.amount').' ( '.$currency_info[$lang.'_currency'].' )'); ?></label>
                            <?php echo e(Form::number('amount', 10, ['class'=>'loginV__input','id'=>'amount','required'])); ?>

                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="gift" class="login__label"><?php echo e(trans('admin.as_gift')); ?></label>
                            <?php echo e(Form::select('gift',['no'=>trans('admin.no'),'yes'=>trans('admin.yes')], null, ['class'=>'loginV__input nice-select','id'=>'gift','required'])); ?>

                        </div>
                        <div class="col-12 col-lg-12 gift_name">
                            <label for="gift_name" class="login__label"><?php echo e(trans('admin.name')); ?></label>
                            <?php echo e(Form::text('gift_name',null,['class'=>'loginV__input'])); ?>

                        </div>

                        <ul class="nav nav-pills Gurpayment__pills">
                            <li class="nav-item">
                                <a class="nav-link pay_type active" value="knet" href="#payOne__wrapper" data-toggle="tab"> 
                                    <span class="showG__radio"></span>
                                    <span><?php echo e(trans('admin.knet')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pay_type" value="visit" href="#visitM__wrapper" data-toggle="tab"> 
                                    <span class="showG__radio"></span>
                                    <span><?php echo e(trans('admin.visit')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pay_type" value="headquarter" href="#branch__wrapper" data-toggle="tab"> 
                                    <span class="showG__radio"></span>
                                    <span><?php echo e(trans('admin.headquarter')); ?></span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content"  id="allGurntPay__tabs">
                            <div class="curr__wrapper tab-pane fade in active show" role="tabpanel" id="payOne__wrapper">

                            </div>
                            <div class="curr__wrapper tab-pane fade" role="tabpanel" id="visitM__wrapper">

                            </div>
                            <div class="curr__wrapper tab-pane fade" role="tabpanel" id="branch__wrapper">

                            </div>
                        </div> 

                    </div>
                    <button class="login__btn" type='submiut'><?php echo e(trans('admin.donate')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

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

<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/project.blade.php ENDPATH**/ ?>
<div class="modal loginModal fade" id="guarantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <img src="<?php echo e(url('interface')); ?>/img/si.png" alt="" class="check__thumb">
            <div class="modal-body">         
                <form action="<?php echo e(url('donation/childern/'.$child['id'])); ?>" method="post" class="loginV__form">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(Form::hidden('pay_type','knet',['id'=>'pay_type'])); ?>


                    <h3 class="loginModal_title"><?php echo e(trans('admin.donate')); ?> : <?php echo e($child[$lang.'_name']); ?></h3>
                    <p class="logintModal_des"><?php echo e(number_format($child['amount'] / $currency_info['equal'], $currency_info['currency_format'], '.', '') . ' ' . $currency_info[$lang . '_currency']); ?></p>
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
                        <?php endif; ?>

                        <div class="col-12 col-lg-6">
                            <label for="time" class="login__label"><?php echo e(trans('admin.donate_type')); ?></label>
                            <?php echo e(Form::select('time',['always'=>trans('admin.always_time'),'one'=>trans('admin.one_time')], null, ['class'=>'loginV__input nice-select','id'=>'time','required'])); ?>

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

<div class="modal loginModal fade" id="giftModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <img src="<?php echo e(url('interface')); ?>/img/si.png" alt="" class="check__thumb">
            <div class="modal-body">         
                <form action="<?php echo e(url('gift/childern/'.$child['id'])); ?>" method="post" class="loginV__form">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(Form::hidden('gift_id',null,['id'=>'gift_id'])); ?>


                    <h3 class="loginModal_title"><?php echo e(trans('admin.child_gift')); ?></h3>
                    <p class="logintModal_des"><?php echo e($child[$lang.'_name']); ?></p>
                    <div class="form__row">
                        <div class="col-12 col-lg-6">
                            <label for="gift_name" class="login__label"><?php echo e(trans('admin.gift_name')); ?></label>
                            <?php echo e(Form::text('gift_name',null,['class'=>'loginV__input','id'=>'gift_name','readonly'])); ?>

                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="gift_amount" class="login__label"><?php echo e(trans('admin.amount')); ?></label>
                            <?php echo e(Form::text('gift_amount',null,['class'=>'loginV__input','id'=>'gift_amount','readonly'])); ?>

                        </div>

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
                            <label for="gift_country_id" class="login__label"><?php echo e(trans('admin.country')); ?></label>
                            <?php echo e(Form::select('country_id',$countries, null, ['class'=>'loginV__input','id'=>'gift_country_id','required'])); ?>

                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="phone" class="login__label"><?php echo e(trans('admin.phone')); ?></label>
                            <?php echo e(Form::text('phone',null,['class'=>'loginV__input','required'])); ?>

                        </div>
                        <?php endif; ?>

                    </div>
                    <button class="login__btn" type='submiut'><?php echo e(trans('admin.child_gift')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/child_modal.blade.php ENDPATH**/ ?>
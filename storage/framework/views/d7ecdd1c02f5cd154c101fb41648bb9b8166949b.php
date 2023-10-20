<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));

if ($lang == 'en') {
    $dir = 'ltr';
} else {
    $dir = 'rtl';
}
if (Session::has('currency') && Session::get('currency') != '') {
    $static = '';
} else {
    $static = 'data-backdrop="static" data-keyboard="false"';
}
?>
<!doctype html>
<html lang="<?php echo e($lang); ?>" dir="<?php echo e($dir); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo e($site[$lang.'_title']); ?> | <?php echo $__env->yieldContent('title'); ?></title>
        <meta name="description" content="<?php echo e($site[$lang.'_desc']); ?>">
        <meta name="author" content="<?php echo e($site[$lang.'_title']); ?>">
        <meta name="keywords" content="<?php echo e($site['tags']); ?>">

        <link href="<?php echo e(url('interface')); ?>/css/animate.min.css" rel="stylesheet" />
        <link href="<?php echo e(url('interface')); ?>/css/hover.css" rel="stylesheet">
        <link href="<?php echo e(url('interface')); ?>/css/slick.css" rel="stylesheet">
        <link href="<?php echo e(url('interface')); ?>/css/slick-theme.css" rel="stylesheet">
        <link href="<?php echo e(url('interface')); ?>/css/simple-lightbox.min.css" rel="stylesheet">
        <link href="<?php echo e(url('interface')); ?>/css/nice-select.css" rel="stylesheet">
        <link href="<?php echo e(url('interface')); ?>/css/intlTelInput.min.css" rel="stylesheet">
        <link href="<?php echo e(url('interface')); ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo e(url('interface')); ?>/css/main.css" rel="stylesheet">
        <link href="<?php echo e(url('interface')); ?>/css/media.css" rel="stylesheet">
        <link href="<?php echo e(url('interface')); ?>/css/style-<?php echo e($lang); ?>.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(url('favicon')); ?>/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(url('favicon')); ?>/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(url('favicon')); ?>/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(url('favicon')); ?>/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(url('favicon')); ?>/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(url('favicon')); ?>/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(url('favicon')); ?>/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(url('favicon')); ?>/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(url('favicon')); ?>/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo e(url('favicon')); ?>/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(url('favicon')); ?>/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(url('favicon')); ?>/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(url('favicon')); ?>/favicon-16x16.png">
        <link rel="manifest" href="<?php echo e(url('favicon')); ?>/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">        
    </head>
    <body>
        <!--start loader section-->
        <div class="loader-container" id="loader-container">
            <div class="loader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <!--sidebar-->
        <div class="mob-overlay"></div>
        <div class="sidebar-wrapper">
            <div class="container">
                <div id="burgerBtn"></div>
                <ul class="navigation desktop__nav">
                    <li class="nav-item">
                        <a href="<?php echo e(url('/')); ?>" class="nav-link"><?php echo e(trans('admin.home')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(url('projects')); ?>" class="nav-link"><?php echo e(trans('admin.projects')); ?></a>
                    </li>
                    <li class="nav-item item_has_child">
                        <a class="nav-link dropdown-toggle"> <?php echo e(trans('admin.sponsorships')); ?> <i class="fa-solid fa-plus"></i> </a>
                        <ul class="dropdown__Firstmenu" style="width: 220px;">
                            <li class="nav-item"><a href="<?php echo e(url('childern')); ?>" class="nav-link"><?php echo e(trans('admin.childern')); ?></a></li>
                            <li class="nav-item"><a href="<?php echo e(url('families')); ?>" class="nav-link"><?php echo e(trans('admin.families')); ?></a></li>
                            <li class="nav-item"><a href="<?php echo e(url('teachers')); ?>" class="nav-link"><?php echo e(trans('admin.teachers')); ?></a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(url('calculator')); ?>" class="nav-link"><?php echo e(trans('admin.calculator')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(url('contact')); ?>" class="nav-link"><?php echo e(trans('admin.contact')); ?></a>
                    </li>
                    <?php if(Session::has('currency') && Session::get('currency') != ''): ?>
                    <li class="nav-item">
                        <a href="#" data-toggle="modal" data-target="#currencyModal" class="nav-link"><?php echo e($currency_info[$lang.'_currency']); ?></a>
                    </li> 
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="<?php echo e(url('lang')); ?>" class="nav-link"> 
                            <?php if($lang == 'ar'): ?>
                            English
                            <?php else: ?>
                            العربية
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
                <?php if(Auth::Check()): ?>
                <a href="<?php echo e(url('profile')); ?>" class="main__btn medium__btn hvr-bounce-to-right mXMD__auto"><?php echo e(trans('admin.profile')); ?></a>
                <?php else: ?>
                <a href="#" class="main__btn medium__btn hvr-bounce-to-right mXMD__auto" data-toggle="modal" data-target="#loginModal"><?php echo e(trans('admin.login')); ?></a>
                <?php endif; ?>
            </div>
        </div>

        <!--start header section-->
        <header>
            <div class="container header__container pxLG-0">
                <a href="<?php echo e(url('/')); ?>" class="my_logo">
                    <img src="<?php echo e(url('interface')); ?>/img/logo.png" alt="<?php echo e(trans('admin.home')); ?>">
                </a>
                <ul class="navigation desktop__nav d__mob__none">
                    <li class="nav-item">
                        <a href="<?php echo e(url('projects')); ?>" class="nav-link"><?php echo e(trans('admin.projects')); ?></a>
                    </li>
                    <li class="nav-item item_has_child">
                        <a class="nav-link dropdown-toggle"> <?php echo e(trans('admin.sponsorships')); ?> <i class="fa-solid fa-plus"></i> </a>
                        <ul class="dropdown__Firstmenu" style="width: 220px;">
                            <li class="nav-item"><a href="<?php echo e(url('childern')); ?>" class="nav-link"><?php echo e(trans('admin.childern')); ?></a></li>
                            <li class="nav-item"><a href="<?php echo e(url('families')); ?>" class="nav-link"><?php echo e(trans('admin.families')); ?></a></li>
                            <li class="nav-item"><a href="<?php echo e(url('teachers')); ?>" class="nav-link"><?php echo e(trans('admin.teachers')); ?></a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(url('calculator')); ?>" class="nav-link"><?php echo e(trans('admin.calculator')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(url('contact')); ?>" class="nav-link"><?php echo e(trans('admin.contact')); ?></a>
                    </li>
                    <?php if(Session::has('currency') && Session::get('currency') != ''): ?>
                    <li class="nav-item">
                        <a href="#" data-toggle="modal" data-target="#currencyModal" class="nav-link"><?php echo e($currency_info[$lang.'_currency']); ?></a>
                    </li> 
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="<?php echo e(url('lang')); ?>" class="nav-link"> 
                            <?php if($lang == 'ar'): ?>
                            English
                            <?php else: ?>
                            العربية
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
                <?php if(Auth::Check()): ?>
                <a href="<?php echo e(url('profile')); ?>" class="main__btn medium__btn hvr-bounce-to-right d__mob__none"><?php echo e(trans('admin.profile')); ?></a>
                <?php else: ?>
                <a href="#" class="main__btn medium__btn hvr-bounce-to-right d__mob__none" data-toggle="modal" data-target="#loginModal"><?php echo e(trans('admin.login')); ?></a>
                <?php endif; ?>
                <button class="navbar_toggler" type="button" id="sidebar_toggler">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </header>    

        <?php echo $__env->yieldContent('content'); ?>

        <section class="joinTeam_section"  id="discover_section">
            <div class="container pxLG-0">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="joinFlex">
                            <img src="<?php echo e(url('interface')); ?>/img/join.png" alt="" class="join_thumb">
                            <h3><?php echo e(trans('admin.idea_desc')); ?></h3>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <a href="<?php echo e(url('idea')); ?>" class="main__btn wide__btn hvr-bounce-to-left"><?php echo e(trans('admin.more')); ?></a>
                    </div>
                </div>
            </div>
            <img src="<?php echo e(url('interface')); ?>/img/j.png" alt="" class="absBack_img">
        </section>

        <!--start footer section-->
        <footer class="footer">
            <div class="footer__wrapper">
                <div class="container pxLG-0">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="footer__col">
                                <h3 class="footer_title"><?php echo e(trans('admin.links')); ?></h3>
                                <ul class="ftLinks_list">
                                    <li> <a href="<?php echo e(url('/')); ?>" class="footer__link"> <?php echo e(trans('admin.home')); ?> </a> </li>
                                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href=""></a></li>
                                    <li> <a href="<?php echo e(url('page/'.$page['id'])); ?>" class="footer__link"> <?php echo e($page[$lang.'_title']); ?></a> </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="footer__col">
                                <h3 class="footer_title"><?php echo e(trans('admin.contact')); ?></h3>
                                <div class="ftContact_wrap">
                                    <div class="contFT_flex">
                                        <img src="<?php echo e(url('interface')); ?>/img/call.svg" alt="" class="grCont_icon">
                                        <h3 class="ftCont_title"> <?php echo e(trans('admin.phone')); ?></h3>
                                    </div>
                                    <a href="tel:<?php echo e($site['phone']); ?>" class="ftContUs_link"><?php echo e($site['phone']); ?></a>
                                </div>
                                <div class="ftContact_wrap">
                                    <div class="contFT_flex">
                                        <img src="<?php echo e(url('interface')); ?>/img/sms.svg" alt="" class="grCont_icon">
                                        <h3 class="ftCont_title"> <?php echo e(trans('admin.whatsapp')); ?></h3>
                                    </div>
                                    <a href="https://wa.me/<?php echo e($site['whatsapp']); ?>" class="ftContUs_link"><?php echo e($site['whatsapp']); ?></a>
                                </div>
                                <div class="ftContact_wrap">
                                    <div class="contFT_flex">
                                        <img src="<?php echo e(url('interface')); ?>/img/mail.svg" alt="" class="grCont_icon">
                                        <h3 class="ftCont_title"> <?php echo e(trans('admin.email')); ?></h3>
                                    </div>
                                    <a href="mailto:<?php echo e($site['email']); ?>" class="ftContUs_link"><?php echo e($site['email']); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="footer__col">
                                <p class="footer__Des"><?php echo e(trans('admin.subscribee')); ?></p>
                                <form class="ftCont__form">
                                    <div class="ftForm_group">
                                        <input id='subscribe_email' type="email" class="ftForm_input" placeholder="<?php echo e(trans('admin.enter_mail')); ?>">
                                        <button type="button" class="ftForm_submit hvr-bounce-to-left" id="subscribe"><?php echo e(trans('admin.subscribe')); ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyrights">
                <div class="container pxLG-0 copyWr__flex">
                    <p class="rights_des"><?php echo e(trans('admin.rights')); ?> <?php echo e($site[$lang.'_title']); ?> &copy; <?php echo e(date('Y')); ?></p>
                    <div class="socialFt__wrapper">
                        <?php $__currentLoopData = $social_media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $one): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($one['link']); ?>" target="_blank" title="<?php echo e($one['type']); ?>" class="socilFT_link"> <i class="fa-brands fa-<?php echo e($one['type']); ?>"></i> </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </footer>


        <!-- to top button-->
        <a href="#" class="go-top" data-toggle="tooltip" title="" data-placement="left" data-original-title="go to top" >
            <i class="fa-solid fa-caret-up"></i>
        </a>

        <?php if(!Auth::Check()): ?>
        <!-- login modal-->
        <div class="modal loginModal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">      
                        <img src="<?php echo e(url('interface')); ?>/img/si.png" alt="" class="check__thumb">
                        <form action="<?php echo e(url('login')); ?>" class="loginV__form" method="post">
                            <?php echo e(csrf_field()); ?>


                            <h3 class="loginModal_title"><?php echo e(trans('admin.login')); ?></h3>
                            <p class="logintModal_des"><?php echo e(trans('admin.login_desc')); ?></p>

                            <label for="email" class="login__label"><?php echo e(trans('admin.email')); ?></label>
                            <?php echo e(Form::text('email', null, ['class'=>'loginV__input','id'=>'email', 'placeholder'=>trans('admin.email')])); ?>


                            <label for="password" class="login__label"><?php echo e(trans('admin.password')); ?></label>
                            <?php echo e(Form::input('password','password', null, ['class'=>'loginV__input','id'=>'password', 'placeholder'=>trans('admin.password')])); ?>


                            <button type="submit" class="login__btn"><?php echo e(trans('admin.login')); ?></button>
                            <p class="have__account"><?php echo e(trans('admin.donot_have_account')); ?> <a href="#" class="account__link" data-toggle="modal" data-target="#rigestModal" data-dismiss="modal"><?php echo e(trans('admin.register')); ?></a>   </p>
                            <p class="have__account"><a href="#" class="account__link" data-toggle="modal" data-target="#forgetModal" data-dismiss="modal"><?php echo e(trans('admin.forget_password')); ?></a>   </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- rigest modal-->
        <div class="modal loginModal fade" id="rigestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-body">      
                        <form action="<?php echo e(url('register')); ?>" class="loginV__form" method="post">
                            <?php echo e(csrf_field()); ?>


                            <img src="<?php echo e(url('interface')); ?>/img/si.png" alt="" class="check__thumb">
                            <h3 class="loginModal_title"><?php echo e(trans('admin.register')); ?></h3>
                            <p class="logintModal_des"><?php echo e(trans('admin.welcome_message')); ?></p>

                            <div class="form__row">                                
                                <div class="col-12 col-lg-6">
                                    <label for="name" class="login__label"><?php echo e(trans('admin.name')); ?></label>
                                    <?php echo e(Form::text('name', null, ['class'=>'loginV__input','id'=>'name', 'placeholder'=>trans('admin.name'),'required'])); ?>

                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="email" class="login__label"><?php echo e(trans('admin.email')); ?></label>
                                    <?php echo e(Form::text('email', null, ['class'=>'loginV__input','id'=>'email', 'placeholder'=>trans('admin.email'),'required'])); ?>

                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="password" class="login__label"><?php echo e(trans('admin.password')); ?></label>
                                    <?php echo e(Form::input('password','password', null, ['class'=>'loginV__input','id'=>'password', 'placeholder'=>trans('admin.password'),'required'])); ?>

                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="password_confirmation" class="login__label"><?php echo e(trans('admin.password_confirmation')); ?></label>
                                    <?php echo e(Form::input('password','password_confirmation', null, ['class'=>'loginV__input','id'=>'password_confirmation', 'placeholder'=>trans('admin.password_confirmation'),'required'])); ?>

                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="country_id" class="login__label"><?php echo e(trans('admin.country_code')); ?></label>
                                    <?php echo e(Form::select('country_id',$codes, null, ['class'=>'loginV__input','id'=>'country_id','required'])); ?>

                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="phone" class="login__label"><?php echo e(trans('admin.phone')); ?></label>
                                    <?php echo e(Form::text('phone', null, ['class'=>'loginV__input','id'=>'phone', 'placeholder'=>trans('admin.phone'),'required'])); ?>

                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="whatsapp" class="login__label"><?php echo e(trans('admin.whatsapp')); ?></label>
                                    <?php echo e(Form::text('whatsapp', null, ['class'=>'loginV__input','id'=>'whatsapp', 'placeholder'=>trans('admin.whatsapp')])); ?>

                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="governate" class="login__label"><?php echo e(trans('admin.governate')); ?></label>
                                    <?php echo e(Form::text('governate', null, ['class'=>'loginV__input','id'=>'governate', 'placeholder'=>trans('admin.governate')])); ?>

                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="city" class="login__label"><?php echo e(trans('admin.city')); ?></label>
                                    <?php echo e(Form::text('city', null, ['class'=>'loginV__input','id'=>'city', 'placeholder'=>trans('admin.city')])); ?>

                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="street" class="login__label"><?php echo e(trans('admin.street')); ?></label>
                                    <?php echo e(Form::text('street', null, ['class'=>'loginV__input','id'=>'street', 'placeholder'=>trans('admin.street')])); ?>

                                </div>
                            </div>
                            <button type="submit" class="login__btn"><?php echo e(trans('admin.register')); ?></button>
                            <p class="have__account" style="margin-bottom: 50px;"><?php echo e(trans('admin.have_account')); ?> <a href="#" class="account__link" data-toggle="modal" data-target="#loginModal" data-dismiss="modal"><?php echo e(trans('admin.login')); ?></a>   </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>    

        <!-- forget modal-->
        <div class="modal loginModal fade" id="forgetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">      
                        <img src="<?php echo e(url('interface')); ?>/img/si.png" alt="" class="check__thumb">
                        <form action="<?php echo e(url('forget_password')); ?>" class="loginV__form" method="post">
                            <?php echo e(csrf_field()); ?>


                            <h3 class="loginModal_title"><?php echo e(trans('admin.forget_password')); ?></h3>
                            <p class="logintModal_des"><?php echo e(trans('admin.forget_password_1')); ?></p>

                            <label for="email" class="login__label"><?php echo e(trans('admin.email')); ?></label>
                            <?php echo e(Form::text('email', null, ['class'=>'loginV__input','id'=>'email','required', 'placeholder'=>trans('admin.email')])); ?>


                            <button type="submit" class="login__btn"><?php echo e(trans('admin.reset_password')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="modal loginModal fade" id="currencyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  <?php echo $static; ?> >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">      
                        <img src="<?php echo e(url('interface')); ?>/img/si.png" alt="" class="check__thumb">
                        <form action="" class="loginV__form">
                            <h3 class="loginModal_title"><?php echo e(trans('admin.choose_currency')); ?></h3>
                            <p class="logintModal_des"><?php echo e(trans('admin.currencies')); ?></p>
                            <div class="form__row">
                                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12 col-lg-6" style="padding-bottom: 20px;">
                                    <a href="<?php echo e(url('currency/'.$currency['id'])); ?>" style="font-size: 14px; color: #000;">
                                        <img src="<?php echo e(url('upload/currencies/'.$currency['image'])); ?>" class="img-rounded" style="height: 35px;"> <?php echo e($currency[$lang.'_name']); ?> ( <?php echo e($currency[$lang.'_currency']); ?> )
                                    </a>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
         <?php echo $__env->yieldContent('modals'); ?>

        <script src="<?php echo e(url('interface')); ?>/js/jquery-3.2.1.min.js"></script>
        <script src="<?php echo e(url('interface')); ?>/js/slick.min.js"></script>
        <script src="<?php echo e(url('interface')); ?>/js/simple-lightbox.min.js"></script>
        <script src="<?php echo e(url('interface')); ?>/js/jquery.nice-select.js"></script>
        <script src="<?php echo e(url('interface')); ?>/js/intlTelInput.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.3/lottie.min.js" integrity="sha512-35O/v2b9y+gtxy3HK+G3Ah60g1hGfrxv67nL6CJ/T56easDKE2TAukzxW+/WOLqyGE7cBg0FR2KhiTJYs+FKrw==" crossorigin="anonymous"></script>
        <script src="<?php echo e(url('interface')); ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo e(url('interface')); ?>/js/main.js"></script>
        <script src="<?php echo e(url('interface')); ?>/js/wow.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
new WOW().init();
        </script>

        <?php if($static != ''): ?>
        <script>
            $(document).ready(function () {
                $('#currencyModal').modal('show');
            });
        </script>
        <?php endif; ?>

        <script>
            $('#subscribe').on('click', function (event) {
                email = $('#subscribe_email').val();
                $.ajax({
                    url: '<?php echo url('subscribe'); ?>',
                    type: 'GET',
                    dataType: 'json',
                    data: {email: email},
                }).done(function (response) {
                    switch (response.response) {
                        case 'notValid':
                            swal('<?php echo trans("admin.error"); ?>', '<?php echo trans('admin.wrong_email'); ?>', 'error');
                            break;
                        case 'error':
                            swal('<?php echo trans("admin.error"); ?>', '<?php echo trans('admin.try_again'); ?>', 'error');
                            break;
                        case 'saved':
                            $('#subscribe_email').val('');
                            swal('<?php echo trans("admin.success"); ?>', '<?php echo trans('admin.suc_subscribe'); ?>', 'success');
                            break;
                        case 'exsits':
                            swal('<?php echo trans("admin.error"); ?>', '<?php echo trans('admin.email_exists'); ?>', 'error');
                            break;
                        default:
                            break;
                    }
                });
            });
        </script>

        <?php echo $__env->yieldContent('scripts'); ?>

        <?php if(Session::has('error')): ?>
        <script>
            swal('<?php echo trans('admin.error'); ?>', '<?php echo Session::get('error'); ?>', 'error');
        </script>
        <?php endif; ?>

        <?php if(Session::has('success')): ?>
        <script>
            swal('<?php echo trans('admin.success'); ?>', '<?php echo Session::get('success'); ?>', 'success');
        </script>
        <?php endif; ?>
    </body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/layout.blade.php ENDPATH**/ ?>
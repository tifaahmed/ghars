<?php
$lang = App::getLocale();

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
<html lang="{{$lang}}" dir="{{$dir}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$site[$lang.'_title']}} | @yield('title')</title>
        <meta name="description" content="{{$site[$lang.'_desc']}}">
        <meta name="author" content="{{$site[$lang.'_title']}}">
        <meta name="keywords" content="{{$site['tags']}}">

        <link href="{{url('interface')}}/css/animate.min.css" rel="stylesheet" />
        <link href="{{url('interface')}}/css/hover.css" rel="stylesheet">
        <link href="{{url('interface')}}/css/slick.css" rel="stylesheet">
        <link href="{{url('interface')}}/css/slick-theme.css" rel="stylesheet">
        <link href="{{url('interface')}}/css/simple-lightbox.min.css" rel="stylesheet">
        <link href="{{url('interface')}}/css/nice-select.css" rel="stylesheet">
        <link href="{{url('interface')}}/css/intlTelInput.min.css" rel="stylesheet">
        <link href="{{url('interface')}}/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{url('interface')}}/css/main.css" rel="stylesheet">
        <link href="{{url('interface')}}/css/media.css" rel="stylesheet">
        <link href="{{url('interface')}}/css/style-{{$lang}}.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="apple-touch-icon" sizes="57x57" href="{{url('favicon')}}/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="{{url('favicon')}}/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="{{url('favicon')}}/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="{{url('favicon')}}/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="{{url('favicon')}}/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="{{url('favicon')}}/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="{{url('favicon')}}/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="{{url('favicon')}}/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="{{url('favicon')}}/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{url('favicon')}}/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="{{url('favicon')}}/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="{{url('favicon')}}/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('favicon')}}/favicon-16x16.png">
        <link rel="manifest" href="{{url('favicon')}}/manifest.json">
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
                        <a href="{{url('/')}}" class="nav-link">{{trans('admin.home')}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('projects')}}" class="nav-link">{{trans('admin.projects')}}</a>
                    </li>
                    <li class="nav-item item_has_child">
                        <a class="nav-link dropdown-toggle"> {{trans('admin.sponsorships')}} <i class="fa-solid fa-plus"></i> </a>
                        <ul class="dropdown__Firstmenu" style="width: 220px;">
                            <li class="nav-item"><a href="{{url('childern')}}" class="nav-link">{{trans('admin.childern')}}</a></li>
                            <li class="nav-item"><a href="{{url('families')}}" class="nav-link">{{trans('admin.families')}}</a></li>
                            <li class="nav-item"><a href="{{url('teachers')}}" class="nav-link">{{trans('admin.teachers')}}</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('calculator')}}" class="nav-link">{{trans('admin.calculator')}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('contact')}}" class="nav-link">{{trans('admin.contact')}}</a>
                    </li>
                    @if (Session::has('currency') && Session::get('currency') != '')
                    <li class="nav-item">
                        <a href="#" data-toggle="modal" data-target="#currencyModal" class="nav-link">{{$currency_info[$lang.'_currency']}}</a>
                    </li> 
                    @endif
                    <li class="nav-item">
                        <a href="{{url('lang')}}" class="nav-link"> 
                            @if($lang == 'ar')
                            English
                            @else
                            العربية
                            @endif
                        </a>
                    </li>
                </ul>
                @if(Auth::Check())
                <a href="{{url('profile')}}" class="main__btn medium__btn hvr-bounce-to-right mXMD__auto">{{trans('admin.profile')}}</a>
                @else
                <a href="#" class="main__btn medium__btn hvr-bounce-to-right mXMD__auto" data-toggle="modal" data-target="#loginModal">{{trans('admin.login')}}</a>
                @endif
            </div>
        </div>

        <!--start header section-->
        <header>
            <div class="container header__container pxLG-0">
                <a href="{{url('/')}}" class="my_logo">
                    <img src="{{url('interface')}}/img/logo.png" alt="{{trans('admin.home')}}">
                </a>
                <ul class="navigation desktop__nav d__mob__none">
                    <li class="nav-item">
                        <a href="{{url('projects')}}" class="nav-link">{{trans('admin.projects')}}</a>
                    </li>
                    <li class="nav-item item_has_child">
                        <a class="nav-link dropdown-toggle"> {{trans('admin.sponsorships')}} <i class="fa-solid fa-plus"></i> </a>
                        <ul class="dropdown__Firstmenu" style="width: 220px;">
                            <li class="nav-item"><a href="{{url('childern')}}" class="nav-link">{{trans('admin.childern')}}</a></li>
                            <li class="nav-item"><a href="{{url('families')}}" class="nav-link">{{trans('admin.families')}}</a></li>
                            <li class="nav-item"><a href="{{url('teachers')}}" class="nav-link">{{trans('admin.teachers')}}</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('calculator')}}" class="nav-link">{{trans('admin.calculator')}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('contact')}}" class="nav-link">{{trans('admin.contact')}}</a>
                    </li>
                    @if (Session::has('currency') && Session::get('currency') != '')
                    <li class="nav-item">
                        <a href="#" data-toggle="modal" data-target="#currencyModal" class="nav-link">{{$currency_info[$lang.'_currency']}}</a>
                    </li> 
                    @endif
                    <li class="nav-item">
                        <a href="{{url('lang')}}" class="nav-link"> 
                            @if($lang == 'ar')
                            English
                            @else
                            العربية
                            @endif
                        </a>
                    </li>
                </ul>
                @if(Auth::Check())
                <a href="{{url('profile')}}" class="main__btn medium__btn hvr-bounce-to-right d__mob__none">{{trans('admin.profile')}}</a>
                @else
                <a href="#" class="main__btn medium__btn hvr-bounce-to-right d__mob__none" data-toggle="modal" data-target="#loginModal">{{trans('admin.login')}}</a>
                @endif
                <button class="navbar_toggler" type="button" id="sidebar_toggler">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </header>    

        @yield('content')

        <section class="joinTeam_section"  id="discover_section">
            <div class="container pxLG-0">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="joinFlex">
                            <img src="{{url('interface')}}/img/join.png" alt="" class="join_thumb">
                            <h3>{{trans('admin.idea_desc')}}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <a href="{{url('idea')}}" class="main__btn wide__btn hvr-bounce-to-left">{{trans('admin.more')}}</a>
                    </div>
                </div>
            </div>
            <img src="{{url('interface')}}/img/j.png" alt="" class="absBack_img">
        </section>

        <!--start footer section-->
        <footer class="footer">
            <div class="footer__wrapper">
                <div class="container pxLG-0">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="footer__col">
                                <h3 class="footer_title">{{trans('admin.links')}}</h3>
                                <ul class="ftLinks_list">
                                    <li> <a href="{{url('/')}}" class="footer__link"> {{trans('admin.home')}} </a> </li>
                                    @foreach($pages as $page)
                                    <a href=""></a></li>
                                    <li> <a href="{{url('page/'.$page['id'])}}" class="footer__link"> {{$page[$lang.'_title']}}</a> </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="footer__col">
                                <h3 class="footer_title">{{trans('admin.contact')}}</h3>
                                <div class="ftContact_wrap">
                                    <div class="contFT_flex">
                                        <img src="{{url('interface')}}/img/call.svg" alt="" class="grCont_icon">
                                        <h3 class="ftCont_title"> {{trans('admin.phone')}}</h3>
                                    </div>
                                    <a href="tel:{{$site['phone']}}" class="ftContUs_link">{{$site['phone']}}</a>
                                </div>
                                <div class="ftContact_wrap">
                                    <div class="contFT_flex">
                                        <img src="{{url('interface')}}/img/sms.svg" alt="" class="grCont_icon">
                                        <h3 class="ftCont_title"> {{trans('admin.whatsapp')}}</h3>
                                    </div>
                                    <a href="https://wa.me/{{$site['whatsapp']}}" class="ftContUs_link">{{$site['whatsapp']}}</a>
                                </div>
                                <div class="ftContact_wrap">
                                    <div class="contFT_flex">
                                        <img src="{{url('interface')}}/img/mail.svg" alt="" class="grCont_icon">
                                        <h3 class="ftCont_title"> {{trans('admin.email')}}</h3>
                                    </div>
                                    <a href="mailto:{{$site['email']}}" class="ftContUs_link">{{$site['email']}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="footer__col">
                                <p class="footer__Des">{{trans('admin.subscribee')}}</p>
                                <form class="ftCont__form">
                                    <div class="ftForm_group">
                                        <input id='subscribe_email' type="email" class="ftForm_input" placeholder="{{trans('admin.enter_mail')}}">
                                        <button type="button" class="ftForm_submit hvr-bounce-to-left" id="subscribe">{{trans('admin.subscribe')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyrights">
                <div class="container pxLG-0 copyWr__flex">
                    <p class="rights_des">{{trans('admin.rights')}} {{$site[$lang.'_title']}} &copy; {{date('Y')}}</p>
                    <div class="socialFt__wrapper">
                        @foreach($social_media as $one)
                        <a href="{{$one['link']}}" target="_blank" title="{{$one['type']}}" class="socilFT_link"> <i class="fa-brands fa-{{$one['type']}}"></i> </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </footer>


        <!-- to top button-->
        <a href="#" class="go-top" data-toggle="tooltip" title="" data-placement="left" data-original-title="go to top" >
            <i class="fa-solid fa-caret-up"></i>
        </a>

        @if(!Auth::Check())
        <!-- login modal-->
        <div class="modal loginModal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">      
                        <img src="{{url('interface')}}/img/si.png" alt="" class="check__thumb">
                        <form action="{{url('login')}}" class="loginV__form" method="post">
                            {{ csrf_field() }}

                            <h3 class="loginModal_title">{{trans('admin.login')}}</h3>
                            <p class="logintModal_des">{{trans('admin.login_desc')}}</p>

                            <label for="email" class="login__label">{{trans('admin.email')}}</label>
                            {{ Form::text('email', null, ['class'=>'loginV__input','id'=>'email', 'placeholder'=>trans('admin.email')]) }}

                            <label for="password" class="login__label">{{trans('admin.password')}}</label>
                            {{ Form::input('password','password', null, ['class'=>'loginV__input','id'=>'password', 'placeholder'=>trans('admin.password')]) }}

                            <button type="submit" class="login__btn">{{trans('admin.login')}}</button>
                            <p class="have__account">{{trans('admin.donot_have_account')}} <a href="#" class="account__link" data-toggle="modal" data-target="#rigestModal" data-dismiss="modal">{{trans('admin.register')}}</a>   </p>
                            <p class="have__account"><a href="#" class="account__link" data-toggle="modal" data-target="#forgetModal" data-dismiss="modal">{{trans('admin.forget_password')}}</a>   </p>
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
                        <form action="{{url('register')}}" class="loginV__form" method="post">
                            {{ csrf_field() }}

                            <img src="{{url('interface')}}/img/si.png" alt="" class="check__thumb">
                            <h3 class="loginModal_title">{{trans('admin.register')}}</h3>
                            <p class="logintModal_des">{{trans('admin.welcome_message')}}</p>

                            <div class="form__row">                                
                                <div class="col-12 col-lg-6">
                                    <label for="name" class="login__label">{{trans('admin.name')}}</label>
                                    {{ Form::text('name', null, ['class'=>'loginV__input','id'=>'name', 'placeholder'=>trans('admin.name'),'required']) }}
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="email" class="login__label">{{trans('admin.email')}}</label>
                                    {{ Form::text('email', null, ['class'=>'loginV__input','id'=>'email', 'placeholder'=>trans('admin.email'),'required']) }}
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="password" class="login__label">{{trans('admin.password')}}</label>
                                    {{ Form::input('password','password', null, ['class'=>'loginV__input','id'=>'password', 'placeholder'=>trans('admin.password'),'required']) }}
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="password_confirmation" class="login__label">{{trans('admin.password_confirmation')}}</label>
                                    {{ Form::input('password','password_confirmation', null, ['class'=>'loginV__input','id'=>'password_confirmation', 'placeholder'=>trans('admin.password_confirmation'),'required']) }}
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="country_id" class="login__label">{{trans('admin.country_code')}}</label>
                                    {{ Form::select('country_id',$codes, null, ['class'=>'loginV__input','id'=>'country_id','required']) }}
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="phone" class="login__label">{{trans('admin.phone')}}</label>
                                    {{ Form::text('phone', null, ['class'=>'loginV__input','id'=>'phone', 'placeholder'=>trans('admin.phone'),'required']) }}
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="whatsapp" class="login__label">{{trans('admin.whatsapp')}}</label>
                                    {{ Form::text('whatsapp', null, ['class'=>'loginV__input','id'=>'whatsapp', 'placeholder'=>trans('admin.whatsapp')]) }}
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="governate" class="login__label">{{trans('admin.governate')}}</label>
                                    {{ Form::text('governate', null, ['class'=>'loginV__input','id'=>'governate', 'placeholder'=>trans('admin.governate')]) }}
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="city" class="login__label">{{trans('admin.city')}}</label>
                                    {{ Form::text('city', null, ['class'=>'loginV__input','id'=>'city', 'placeholder'=>trans('admin.city')]) }}
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="street" class="login__label">{{trans('admin.street')}}</label>
                                    {{ Form::text('street', null, ['class'=>'loginV__input','id'=>'street', 'placeholder'=>trans('admin.street')]) }}
                                </div>
                            </div>
                            <button type="submit" class="login__btn">{{trans('admin.register')}}</button>
                            <p class="have__account" style="margin-bottom: 50px;">{{trans('admin.have_account')}} <a href="#" class="account__link" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">{{trans('admin.login')}}</a>   </p>
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
                        <img src="{{url('interface')}}/img/si.png" alt="" class="check__thumb">
                        <form action="{{url('forget_password')}}" class="loginV__form" method="post">
                            {{ csrf_field() }}

                            <h3 class="loginModal_title">{{trans('admin.forget_password')}}</h3>
                            <p class="logintModal_des">{{trans('admin.forget_password_1')}}</p>

                            <label for="email" class="login__label">{{trans('admin.email')}}</label>
                            {{ Form::text('email', null, ['class'=>'loginV__input','id'=>'email','required', 'placeholder'=>trans('admin.email')]) }}

                            <button type="submit" class="login__btn">{{trans('admin.reset_password')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="modal loginModal fade" id="currencyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  <?php echo $static; ?> >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">      
                        <img src="{{url('interface')}}/img/si.png" alt="" class="check__thumb">
                        <form action="" class="loginV__form">
                            <h3 class="loginModal_title">{{trans('admin.choose_currency')}}</h3>
                            <p class="logintModal_des">{{trans('admin.currencies')}}</p>
                            <div class="form__row">
                                @foreach($currencies as $currency)
                                <div class="col-12 col-lg-6" style="padding-bottom: 20px;">
                                    <a href="{{url('currency/'.$currency['id'])}}" style="font-size: 14px; color: #000;">
                                        <img src="{{url('upload/currencies/'.$currency['image'])}}" class="img-rounded" style="height: 35px;"> {{$currency[$lang.'_name']}} ( {{$currency[$lang.'_currency']}} )
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
         @yield('modals')

        <script src="{{url('interface')}}/js/jquery-3.2.1.min.js"></script>
        <script src="{{url('interface')}}/js/slick.min.js"></script>
        <script src="{{url('interface')}}/js/simple-lightbox.min.js"></script>
        <script src="{{url('interface')}}/js/jquery.nice-select.js"></script>
        <script src="{{url('interface')}}/js/intlTelInput.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.3/lottie.min.js" integrity="sha512-35O/v2b9y+gtxy3HK+G3Ah60g1hGfrxv67nL6CJ/T56easDKE2TAukzxW+/WOLqyGE7cBg0FR2KhiTJYs+FKrw==" crossorigin="anonymous"></script>
        <script src="{{url('interface')}}/js/bootstrap.min.js"></script>
        <script src="{{url('interface')}}/js/main.js"></script>
        <script src="{{url('interface')}}/js/wow.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
new WOW().init();
        </script>

        @if ($static != '')
        <script>
            $(document).ready(function () {
                $('#currencyModal').modal('show');
            });
        </script>
        @endif

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

        @yield('scripts')

        @if (Session::has('error'))
        <script>
            swal('<?php echo trans('admin.error'); ?>', '<?php echo Session::get('error'); ?>', 'error');
        </script>
        @endif

        @if (Session::has('success'))
        <script>
            swal('<?php echo trans('admin.success'); ?>', '<?php echo Session::get('success'); ?>', 'success');
        </script>
        @endif
    </body>
</html>
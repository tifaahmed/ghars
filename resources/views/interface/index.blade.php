<?php

use Illuminate\Support\Str;

$lang = App::getLocale();
?>
@extends('interface.layout')

@section('title')
{{trans('admin.home')}}
@endsection

@section('content')
<section class="main_section"> 
    <div id="mainCarousel" class="carousel slide main__carousel" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $active = 'active';
            $i = 0;
            ?>
            @foreach($slider as $slide)
            <li data-target="#mainCarousel" data-slide-to="{{$i}}" class="{{$active}}"></li>
            <?php
            $active = '';
            $i++;
            ?>
            @endforeach
            <li data-target="#mainCarousel" data-slide-to="4"></li>
        </ol>
        <div class="carousel-inner">
            <?php $active = 'active'; ?>
            @foreach($slider as $slide)
            <div class="carousel-item {{$active}}">
                <div class="welcome_section">
                    <div class="container welcmInner_container pxLG-0">
                        <h3>{{$slide[$lang.'_name']}}</h3>
                        <p>{{$slide[$lang.'_desc']}}</p>
                        <a href="{{$slide['link']}}" class="main__btn wide__btn hvr-bounce-to-right">{{trans('admin.more')}}</a>
                    </div>
                    <img src="{{url('upload/slider/'.$slide['image'])}}" alt="" class="header__img">
                    <div class="mainSC__overlay"></div>
                </div>
            </div>
            <?php $active = ''; ?>
            @endforeach
        </div>
    </div>

    <div class="container inovIcon_container pxLG-0">
        <div class="inovIcon_conOverlay"></div>
        <div class="row cardFlex__end">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="innovForm__card" id="innovForm__card">
                    <ul class="nav nav-pills allInovation__pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#oneInoV__wrapper" data-toggle="tab">{{trans('admin.donation_always')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#allInov__wrapper" data-toggle="tab">{{trans('admin.donation_one')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="allInovation__tabs">
                        <div class="curr__wrapper tab-pane fade in active show" role="tabpanel" id="oneInoV__wrapper">
                            <form action="{{url('donate')}}" class="innoVchs__form" method="post">
                                {{ csrf_field() }}
                                {{ Form::hidden('type','always') }}

                                <h3 class="innoV_title">{{trans('admin.choose_amount')}}</h3>
                                <div class="priceFlex_wrap">
                                    <div class="HDVcheck__label">
                                        <input type="radio" value="10" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 10 {{$currency_info[$lang.'_currency']}} </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" value="20" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 20 {{$currency_info[$lang.'_currency']}} </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" value="50" class="HDnCh_radio" name="money" checked>
                                        <span class="myNew_Dgradio"> 50 {{$currency_info[$lang.'_currency']}} </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" value="100" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 100 {{$currency_info[$lang.'_currency']}} </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" value="200" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 200 {{$currency_info[$lang.'_currency']}} </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" value="250" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 250 {{$currency_info[$lang.'_currency']}} </span>
                                    </div>
                                </div>
                                <div class="innVForm_Group">
                                    <input type="number" class="innVForm_input" value='50' name="amount" id="amount">
                                    <span class="abs__dollar">{{$currency_info[$lang.'_currency']}}</span>
                                </div>
                                <select name="category" class="innVForm_select nice-select">
                                    <option value="general" selected>{{trans('admin.general')}}</option>
                                    <option value="projects">{{trans('admin.projects')}}</option>
                                    <option value="childern">{{trans('admin.childern')}}</option>
                                    <option value="families">{{trans('admin.families')}}</option>
                                    <option value="teachers">{{trans('admin.teachers')}}</option>
                                </select>

                                <button type="submit" class="innvSubmit__btn">{{trans('admin.donate')}}</button>
                            </form>
                        </div>
                        <div class="curr__wrapper tab-pane fade" role="tabpanel" id="allInov__wrapper">
                            <form action="{{url('donate')}}" class="innoVchs__form" method="post">
                                {{ csrf_field() }}
                                {{ Form::hidden('type','one') }}

                                <h3 class="innoV_title">{{trans('admin.choose_amount')}}</h3>
                                <div class="priceFlex_wrap">
                                    <div class="HDVcheck__label">
                                        <input type="radio" value="10" class="HDnCh_radio" name="money_2">
                                        <span class="myNew_Dgradio"> 10 {{$currency_info[$lang.'_currency']}} </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" value="20" class="HDnCh_radio" name="money_2">
                                        <span class="myNew_Dgradio"> 20 {{$currency_info[$lang.'_currency']}} </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" value="50" class="HDnCh_radio" name="money_2" checked>
                                        <span class="myNew_Dgradio"> 50 {{$currency_info[$lang.'_currency']}} </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" value="100" class="HDnCh_radio" name="money_2">
                                        <span class="myNew_Dgradio"> 100 {{$currency_info[$lang.'_currency']}} </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" value="200" class="HDnCh_radio" name="money_2">
                                        <span class="myNew_Dgradio"> 200 {{$currency_info[$lang.'_currency']}} </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" value="250" class="HDnCh_radio" name="money_2">
                                        <span class="myNew_Dgradio"> 250 {{$currency_info[$lang.'_currency']}} </span>
                                    </div>
                                </div>
                                <div class="innVForm_Group">
                                    <input type="number" class="innVForm_input" value='50' name="amount" id="amount_2">
                                    <span class="abs__dollar">{{$currency_info[$lang.'_currency']}}</span>
                                </div>
                                <select name="category" class="innVForm_select nice-select">
                                    <option value="general" selected>{{trans('admin.general')}}</option>
                                    <option value="projects">{{trans('admin.projects')}}</option>
                                    <option value="childern">{{trans('admin.childern')}}</option>
                                    <option value="families">{{trans('admin.families')}}</option>
                                    <option value="teachers">{{trans('admin.teachers')}}</option>
                                </select>

                                <button type="submit" class="innvSubmit__btn">{{trans('admin.donate')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="open__menu">
            <img src="{{url('interface')}}/img/heart.png" alt="" class="inoV_icon">
        </div>
    </div>
</section>

<section class="about_section">
    <div class="container pxLG-0">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="whiteThumb_wrap">
                    <img src="{{url('upload/pages/'.$pages[0]['image'])}}" alt="{{$pages[0][$lang.'_title']}}" class="img-fluid">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="aboutInfo_wrap wow zoomIn" data-wow-offset="100" data-wow-duration="1s">
                    <h5>{{trans('admin.about')}}</h5>
                    <h3>{{$pages[0][$lang.'_title']}}</h3>
                    <p>{{Str::limit(strip_tags($pages[0][$lang.'_desc']),300)}}</p>
                    <a href="{{url('page/'.$pages[0]['id'])}}" class="main__btn wide__btn green_btn hvr-bounce-to-left">{{trans('admin.more')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="discover_section" style="background-image: url('{{url('upload/pages/'.$pages[1]['image'])}}')">
    <div class="dicover__overlay"></div>
    <div class="bottom__grid"></div>
    <div class="discoverInfo_wrap wow zoomIn" data-wow-offset="100" data-wow-duration="1s">
        <h5>{{trans('admin.about')}}</h5>
        <h3>{{$pages[1][$lang.'_title']}}</h3>
        <p>{{Str::limit(strip_tags($pages[1][$lang.'_desc']),250)}}</p>
        <a href="{{url('page/'.$pages[1]['id'])}}" class="main__btn wide__btn hvr-bounce-to-right mx-auto">{{trans('admin.more')}}</a>
    </div>
</section>

<section class="projects_section"  id="projects_section">
    <div class="container pxLG-0">
        <div class="centerTile_wrap">
            <h5>{{$site[$lang.'_title']}}</h5>
            <h3>{{trans('admin.discover')}}</h3>
        </div>
        <div class="row projects__row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="project__Card wow zoomIn" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="proThumb_cont prODone__bk">
                        <img src="{{url('interface')}}/img/p1.png" alt="" class="prodIconS">
                    </div>
                    <div class="proCard__CBody">
                        <a href="{{url('projects')}}" class="morePdk__link prODone__color">{{trans('admin.projects')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="project__Card wow zoomIn" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0.4s">
                    <div class="proThumb_cont prODtwo__bk">
                        <img src="{{url('interface')}}/img/p2.png" alt="" class="prodIconS">
                    </div>
                    <div class="proCard__CBody">
                        <a href="{{url('project_add')}}" class="morePdk__link prODtwo__color">{{trans('admin.project_private_add')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="project__Card wow zoomIn" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0.6s">
                    <div class="proThumb_cont prODthree__bk">
                        <img src="{{url('interface')}}/img/p3.png" alt="" class="prodIconS">
                    </div>
                    <div class="proCard__CBody">
                        <a href="{{url('sponsorships')}}" class="morePdk__link prODthree__color">{{trans('admin.sponsorships')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="project__Card wow zoomIn" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0.8s">
                    <div class="proThumb_cont prODfour__bk">
                        <img src="{{url('interface')}}/img/p4.png" alt="" class="prodIconS">
                    </div>
                    <div class="proCard__CBody">
                        <a href="{{url('calculator')}}" class="morePdk__link prODfour__color">{{trans('admin.calculator')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="aboutBlue_section"  id="aboutBlue_section">
    <img src="{{url('upload/pages/'.$pages[2]['image'])}}" alt="{{$pages[2][$lang.'_title']}}" class="blueThumb__child">
    <div class="container pxLG-0">
        <div class="aboutBlue_row">
            <div class="col-12 col-lg-6 pxLG-0">
                <div class="blueInfo_wrap wow zoomIn" data-wow-offset="100" data-wow-duration="1s">
                    <h5>{{trans('admin.about')}}</h5>
                    <h3>{{$pages[2][$lang.'_title']}}</h3>
                    <p>{{Str::limit(strip_tags($pages[2][$lang.'_desc']),300)}}</p>
                    <a href="{{url('page/'.$pages[2]['id'])}}" class="main__btn wide__btn hvr-bounce-to-left">{{trans('admin.more')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about_section"  id="about_section2">
    <div class="container pxLG-0">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="whiteThumb_wrap">
                    <img src="{{url('upload/pages/'.$pages[3]['image'])}}" alt="{{$pages[3][$lang.'_title']}}" class="img-fluid">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="aboutInfo_wrap wow zoomIn" data-wow-offset="100" data-wow-duration="1s">
                    <h5>{{trans('admin.about')}}</h5>
                    <h3>{{$pages[3][$lang.'_title']}}</h3>
                    <p>{{Str::limit(strip_tags($pages[3][$lang.'_desc']),300)}}</p>
                    <a href="{{url('page/'.$pages[3]['id'])}}" class="main__btn wide__btn green_btn hvr-bounce-to-left">{{trans('admin.more')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('scripts')
<script>
    $('input[type=radio][name=money]').change(function () {
        var amount = this.value;
        $('#amount').val(amount);
    });
    
    $('input[type=radio][name=money_2]').change(function () {
        var amount = this.value;
        $('#amount_2').val(amount);
    });
</script>
@endsection
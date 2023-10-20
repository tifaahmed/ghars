<?php
$lang = App::getLocale();
?>
@extends('interface.layout')

@section('title')
{{trans('admin.idea_desc')}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{trans('admin.idea_desc')}}</h3>
    </div>
</section>

<!--start contact section-->
<section class="contact_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row">
            <div class="col-12 col-lg-6">
                <form class="contact__form" action="{{url('idea')}}" method="post">
                    {{ csrf_field() }}

                    <div class="form__row">
                        <div class="col-12 col-lg-12">
                            <label class="login__label">{{trans('admin.name')}}</label>
                            {{ Form::text('name', null, ['class'=>'loginV__input','id'=>'name', 'placeholder'=>trans('admin.name')]) }}
                            @if($errors->has('name'))
                            <div class="alert alert-danger">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                        <div class="col-12 col-lg-12">
                            <label class="login__label">{{trans('admin.email')}}</label>
                            {{ Form::text('email', null, ['class'=>'loginV__input','id'=>'email', 'placeholder'=>trans('admin.email')]) }}
                            @if($errors->has('email'))
                            <div class="alert alert-danger">{{$errors->first('email')}}</div>
                            @endif
                        </div>
                        <div class="col-12 col-lg-12">
                            <label class="login__label">{{trans('admin.phone')}}</label>
                            {{ Form::text('phone', null, ['class'=>'loginV__input','id'=>'phone', 'placeholder'=>trans('admin.phone')]) }}
                            @if($errors->has('phone'))
                            <div class="alert alert-danger">{{$errors->first('phone')}}</div>
                            @endif
                        </div>
                        <div class="col-12 col-lg-12">
                            <label class="login__label">{{trans('admin.type')}}</label>
                            {{ Form::select('type',['marketing'=>trans('admin.marketing') , 'voluntary'=>trans('admin.voluntary') , 'initiatives'=>trans('admin.initiatives') , 'helps'=>trans('admin.helps') , 'advertising'=>trans('admin.advertising') , 'events'=>trans('admin.events') , 'seminars'=>trans('admin.seminars') , 'messages'=>trans('admin.messages') , 'endowment'=>trans('admin.endowment')], null, ['class'=>'loginV__input','id'=>'type']) }}
                            @if($errors->has('type'))
                            <div class="alert alert-danger">{{$errors->first('type')}}</div>
                            @endif
                        </div>
                        <div class="col-12 col-lg-12">
                            <label class="login__label">{{trans('admin.ideas')}}</label>
                            {{ Form::textarea('message', null, ['class'=>'loginV__input','id'=>'message', 'placeholder'=>trans('admin.ideas')]) }}
                            @if($errors->has('message'))
                            <div class="alert alert-danger">{{$errors->first('message')}}</div>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="contSubmit__btn">{{trans('admin.send')}}</button>
                </form>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mapSec_wrap">
                    <iframe src="{{$site['map']}}" width="100%" height="348" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    <a class="GHas_INvlogo"> <img src="{{url('interface')}}/img/lg2.png" alt=""> </a>
                </div>
                <div class="address__Details">
                    <div class="addOne_list">{{trans('admin.contact')}}</div>
                    <div class="addOne_list"> 
                        <img src="{{url('interface')}}/img/mail.svg" alt="" class="contT_icon">
                        <a href="mailto:{{$site['email']}}">{{$site['email']}}</a>
                    </div>
                    <div class="addOne_list"> 
                        <img src="{{url('interface')}}/img/call.svg" alt="" class="contT_icon">
                        <a href="tel:{{$site['phone']}}">{{$site['phone']}}</a>
                    </div>
                    <div class="addOne_list"> 
                        <img src="{{url('interface')}}/img/sms.svg" alt="" class="contT_icon">
                        <a href="https://wa.me/{{$site['whatsapp']}}">{{$site['whatsapp']}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

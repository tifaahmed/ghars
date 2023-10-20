<?php $lang = App::getLocale(); ?>
@extends('interface.layout')

@section('title')
{{trans('admin.profile')}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{trans('admin.profile')}}</h3>
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
                            <a href="{{url('profile')}}" class="sideBar__link active_link">
                                <img src="{{url('interface')}}/img/profile-circle.png" alt="{{trans('admin.profile')}}" class="profileTH_icon">
                                <span>{{trans('admin.profile')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('my_projects')}}" class="sideBar__link ">
                                <img src="{{url('interface')}}/img/archive-book.png" alt="{{trans('admin.my_projects')}}" class="profileTH_icon">
                                <span>{{trans('admin.my_projects')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('my_projects_donations')}}" class="sideBar__link ">
                                <img src="{{url('interface')}}/img/routing.png" alt="{{trans('admin.projects_donations')}}" class="profileTH_icon">
                                <span>{{trans('admin.projects_donations')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('my_childern')}}" class="sideBar__link ">
                                <img src="{{url('interface')}}/img/wallet.png" alt="{{trans('admin.childern')}}" class="profileTH_icon">
                                <span>{{trans('admin.childern')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('my_families')}}" class="sideBar__link ">
                                <img src="{{url('interface')}}/img/receipt-text.png" alt="{{trans('admin.families')}}" class="profileTH_icon">
                                <span>{{trans('admin.families')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('my_teachers')}}" class="sideBar__link ">
                                <img src="{{url('interface')}}/img/routing.png" alt="{{trans('admin.teachers')}}" class="profileTH_icon">
                                <span>{{trans('admin.teachers')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('delayed_donations')}}" class="sideBar__link ">
                                <img src="{{url('interface')}}/img/wallet.png" alt="{{trans('admin.delayed_donations')}}" class="profileTH_icon">
                                <span>{{trans('admin.delayed_donations')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('logout')}}" class="sideBar__link ">
                                <img src="{{url('interface')}}/img/task-square.png" alt="{{trans('admin.logout')}}" class="profileTH_icon">
                                <span>{{trans('admin.logout')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-9">
                <div class="profInner_WrapDes">
                    <div class="myInfo__taBorder">
                        <h3 class="myInfo_title">{{trans('admin.profile')}}</h3>
                        <div class="myINForm__Wrapz">
                            <form action="{{url('profile')}}" method="post" class="myProInfo__form">
                                {{ csrf_field() }}

                                <div class="form__row">
                                    <div class="col-12 col-lg-6">
                                        <label for="name" class="profileV__label">{{trans('admin.name')}}</label>
                                        {{ Form::text('name', Auth::User()->name, ['class'=>'profileV__input','id'=>'name']) }}
                                        @if($errors->has('name'))
                                        <div class="alert alert-danger">{{$errors->first('name')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="country_id" class="profileV__label">{{trans('admin.country_code')}}</label>
                                        {{ Form::select('country_id',$codes, Auth::User()->country_id, ['class'=>'profileV__input','id'=>'country_id']) }}
                                        @if($errors->has('country_id'))
                                        <div class="alert alert-danger">{{$errors->first('country_id')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="phone" class="profileV__label">{{trans('admin.phone')}}</label>
                                        {{ Form::text('phone', Auth::User()->phone, ['class'=>'profileV__input','id'=>'phone']) }}
                                        @if($errors->has('phone'))
                                        <div class="alert alert-danger">{{$errors->first('phone')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="whatsapp" class="profileV__label">{{trans('admin.whatsapp')}}</label>
                                        {{ Form::text('whatsapp', Auth::User()->whatsapp, ['class'=>'profileV__input','id'=>'whatsapp']) }}
                                        @if($errors->has('whatsapp'))
                                        <div class="alert alert-danger">{{$errors->first('whatsapp')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="email" class="profileV__label">{{trans('admin.email')}}</label>
                                        {{ Form::text('email', Auth::User()->email, ['class'=>'profileV__input','id'=>'email']) }}
                                        @if($errors->has('email'))
                                        <div class="alert alert-danger">{{$errors->first('email')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="password" class="profileV__label">{{trans('admin.password')}}</label>
                                        {{ Form::input('password','password', null, ['class'=>'profileV__input','id'=>'password']) }}
                                        @if($errors->has('password'))
                                        <div class="alert alert-danger">{{$errors->first('password')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="governate" class="profileV__label">{{trans('admin.governate')}}</label>
                                        {{ Form::text('governate', Auth::User()->governate, ['class'=>'profileV__input','id'=>'governate']) }}
                                        @if($errors->has('governate'))
                                        <div class="alert alert-danger">{{$errors->first('governate')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="city" class="profileV__label">{{trans('admin.city')}}</label>
                                        {{ Form::text('city', Auth::User()->city, ['class'=>'profileV__input','id'=>'city']) }}
                                        @if($errors->has('city'))
                                        <div class="alert alert-danger">{{$errors->first('city')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="street" class="profileV__label">{{trans('admin.street')}}</label>
                                        {{ Form::text('street', Auth::User()->street, ['class'=>'profileV__input','id'=>'street']) }}
                                        @if($errors->has('street'))
                                        <div class="alert alert-danger">{{$errors->first('street')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="contSubmit__btn mXST__auto">{{trans('admin.save')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
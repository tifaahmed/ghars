<?php $lang = App::getLocale(); ?>
@extends('interface.layout')

@section('title')
{{trans('admin.projects_donations')}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{trans('admin.projects_donations')}}</h3>
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
                            <a href="{{url('profile')}}" class="sideBar__link">
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
                            <a href="{{url('my_projects_donations')}}" class="sideBar__link active_link">
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
                        <h3 class="myInfo_title">{{trans('admin.projects_donations')}}</h3>
                        <div class="rTableOver_wrapper">
                            <table class="table reports__table">
                                <thead>
                                    <tr>
                                        <th scope="col">{{trans('admin.project_name')}}</th>
                                        <th scope="col">{{trans('admin.amount')}}</th>
                                        <th scope="col">{{trans('admin.pay_type')}}</th>
                                        <th scope="col">{{trans('admin.as_gift')}}</th>
                                        <th scope="col">{{trans('admin.date')}}</th>
                                        <th scope="col">{{trans('admin.status')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donations as $donation)
                                    <tr>
                                        <td>{{$donation['Project'][$lang.'_name']}}</td>
                                        <td>{{$donation['amount'].' '.$donation[$lang.'_currency']}}</td>
                                        <td>{{trans('admin.'.$donation['pay_type'])}}</td>
                                        <td>
                                            @if($donation['gift_id'] != 0)
                                            {{$donation['Gift'][$lang.'_name']}}
                                            @endif
                                        </td>
                                        <td>{{$donation['created_at']->format('Y-m-d')}}</td>
                                        <td>{{trans('admin.paid_'.$donation['active'])}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
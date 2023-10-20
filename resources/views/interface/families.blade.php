<?php
$lang = App::getLocale();
?>
@extends('interface.layout')

@section('title')
{{trans('admin.families')}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{trans('admin.families')}}</h3>
    </div>
</section>

<section class="orphans_section mainRelative_section">
    <div class="container pxLG-0">
        <h3 class="orphans__title">{{trans('admin.search')}}</h3>

        <div class="gurantINForm__Wrapz">
            <form action="{{url('families')}}" method="get" class="GuarntInfo__form">
                <div class="form__row">
                    <div class="col-12 col-md-6 col-xl-3">
                        <label for="country" class="profileV__label">{{trans('admin.country')}}</label>
                        {{Form::select('country',$countries,request()->get('country'),['class'=>'profileV__input','id'=>'country'])}}
                    </div>
                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="gender" class="profileV__label">{{trans('admin.gender')}}</label>
                        {{Form::select('gender',[''=>trans('admin.choose'),'male'=>trans('admin.male'),'female'=>trans('admin.female')],request()->get('gender'),['class'=>'profileV__input nice-select','id'=>'gender'])}}
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <label for="age" class="profileV__label">{{trans('admin.members_count')}}</label>
                        {{Form::select('age',[''=>trans('admin.choose'),'1'=>trans('admin.member_1'),'2'=>trans('admin.member_2'),'3'=>trans('admin.member_3'),'4'=>trans('admin.member_4'),'5'=>trans('admin.member_5'),'6'=>trans('admin.member_6'),'7'=>trans('admin.member_7'),'8'=>trans('admin.member_8')],request()->get('age'),['class'=>'profileV__input nice-select','id'=>'age'])}}
                    </div>
                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="required" class="profileV__label">{{trans('admin.required')}}</label>
                        {{Form::select('required',[''=>trans('admin.choose'),'yes'=>trans('admin.yes')],request()->get('required'),['class'=>'profileV__input nice-select','id'=>'required'])}}
                    </div>
                    <div class="col-12 col-md-6 col-xl-2">
                        <button type="submit" class="contSubmit__btn subMidBtn_width w-100">{{trans('admin.search')}}</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="searchResults__wrap">
            <h5 class="ntSearch_title">{{trans('admin.search_results')}} ({{count($families)}}) </h5>
            <div class="row guarantee__inRow">
                @foreach($families as $family)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="OGurant__card">
                        <a href="{{url('family/'.$family['id'])}}">
                            <div class="OGurant__CTop">
                                <span class="active__status">{{$family['amount'] / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']}}</span>
                                <img src="{{url('upload/families/'.$family['image'])}}" alt="{{$family[$lang.'_name']}}" class="OGurant__Chimg">
                                <div class="adABs__overlay">
                                    <h5 class="aDchild_name">{{$family[$lang.'_name']}}</h5>
                                    <span class="adChild_age">{{trans('admin.members_count').' : '.$family['members_count']}}</span>
                                    <div class="aDtails_wrapper">
                                        <span>{{trans('admin.'.$family['gender'])}}</span>
                                        <span> 
                                            <img src="{{url('interface')}}/img/site.svg" alt="" class="siteTH_icon">
                                            <span>{{$family['Country'][$lang.'_name']}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

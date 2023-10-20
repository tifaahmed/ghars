<?php
$lang = App::getLocale();
?>
@extends('interface.layout')

@section('title')
{{$category[$lang.'_name']}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{$category[$lang.'_name']}}</h3>
    </div>
</section>

<section class="orphans_section mainRelative_section">
    <div class="container pxLG-0">
        <h3 class="orphans__title">{{trans('admin.search')}}</h3>

        <div class="gurantINForm__Wrapz">
            <form action="{{url('category/'.$category['id'])}}" method="get" class="GuarntInfo__form">
                <div class="form__row">
                    <div class="col-12 col-md-6 col-xl-6">
                        <label for="country" class="profileV__label">{{trans('admin.country')}}</label>
                        {{Form::select('country',$countries,request()->get('country'),['class'=>'profileV__input','id'=>'country'])}}
                    </div>
                    <div class="col-12 col-md-3 col-xl-3">
                        <label for="required" class="profileV__label">{{trans('admin.required')}}</label>
                        {{Form::select('required',[''=>trans('admin.choose'),'yes'=>trans('admin.yes')],request()->get('required'),['class'=>'profileV__input nice-select','id'=>'required'])}}
                    </div>
                    <div class="col-12 col-md-3 col-xl-3">
                        <button type="submit" class="contSubmit__btn subMidBtn_width w-100">{{trans('admin.search')}}</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="searchResults__wrap">
            <h5 class="ntSearch_title">{{trans('admin.search_results')}} ({{count($projects)}}) </h5>
            <div class="row guarantee__inRow">
                @foreach($projects as $project)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="OGurant__card">
                        <a href="{{url('project/'.$project['id'])}}">
                            <div class="OGurant__CTop">
                                <img src="{{url('upload/projects/'.$project['image'])}}" alt="{{$project[$lang.'_name']}}" class="OGurant__Chimg">
                                <div class="adABs__overlay">
                                    <h5 class="aDchild_name"> {{$project[$lang.'_name']}} </h5>
                                    <h5 class="aDchild_name"> {{trans('admin.remain')}} :  {{($project['amount'] - $project['collect']) / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']}}</h5>
                                    <h5 class="aDchild_name"> {{trans('admin.total')}} :  {{$project['amount'] / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']}}</h5>
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

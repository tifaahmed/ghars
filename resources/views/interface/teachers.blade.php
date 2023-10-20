<?php
$lang = App::getLocale();
?>
@extends('interface.layout')

@section('title')
{{trans('admin.teachers')}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{trans('admin.teachers')}}</h3>
    </div>
</section>

<section class="orphans_section mainRelative_section">
    <div class="container pxLG-0">
        <h3 class="orphans__title">{{trans('admin.search')}}</h3>

        <div class="gurantINForm__Wrapz">
            <form action="{{url('teachers')}}" method="get" class="GuarntInfo__form">
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
                        <label for="age" class="profileV__label">{{trans('admin.age')}}</label>
                        {{Form::select('age',[''=>trans('admin.choose'),'20'=>trans('admin.age_20'),'25'=>trans('admin.age_25'),'30'=>trans('admin.age_30'),'35'=>trans('admin.age_35'),'40'=>trans('admin.age_40'),'45'=>trans('admin.age_45'),'50'=>trans('admin.age_50'),'55'=>trans('admin.age_55'),'60'=>trans('admin.age_60')],request()->get('age'),['class'=>'profileV__input nice-select','id'=>'age'])}}
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
            <h5 class="ntSearch_title">{{trans('admin.search_results')}} ({{count($teachers)}}) </h5>
            <div class="row guarantee__inRow">
                @foreach($teachers as $teacher)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="OGurant__card">
                        <a href="{{url('teacher/'.$teacher['id'])}}">
                            <div class="OGurant__CTop">
                                <span class="active__status">{{$teacher['amount'] / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']}}</span>
                                <img src="{{url('upload/teachers/'.$teacher['image'])}}" alt="{{$teacher[$lang.'_name']}}" class="OGurant__Chimg">
                                <div class="adABs__overlay">
                                    <h5 class="aDchild_name">{{$teacher[$lang.'_name']}}</h5>
                                    <span class="adChild_age">
                                        <?php
                                        $date1 = $teacher['birth_date'];
                                        $date2 = date('Y-m-d');
                                        $diff = abs(strtotime($date2) - strtotime($date1));
                                        ?>
                                        {{floor($diff / (365 * 60 * 60 * 24)) . ' ' . trans('admin.years')}}
                                    </span>
                                    <div class="aDtails_wrapper">
                                        <span>{{trans('admin.'.$teacher['gender'])}}</span>
                                        <span> 
                                            <img src="{{url('interface')}}/img/site.svg" alt="" class="siteTH_icon">
                                            <span>{{$teacher['Country'][$lang.'_name']}}</span>
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

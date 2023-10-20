<?php
$lang = App::getLocale();
?>
@extends('interface.layout')

@section('title')
{{trans('admin.calculator')}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{trans('admin.calculator')}}</h3>
    </div>
</section>

<section class="orphans_section mainRelative_section">
    <div class="container pxLG-0">
        <div class="searchResults__wrap">
            <h3 class="orphans__title">{{trans('admin.calculator_1')}}</h3>
            <div class="row guarantee__inRow">
                <div class="col-12 col-lg-6">
                    <div class="zakaTG__card">
                        <label for="name2" class="profileV__label">{{trans('admin.calculator_desc_1')}}</label>
                        <div class="aDInput__group mb-0">
                            <input id="calculator_1" type="text" class="profileV__input mb-0" placeholder=" 100 ">
                            <span class="absAD__label">{{$currency_info[$lang.'_currency']}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="orphans__title">{{trans('admin.calculator_2')}}</h3>
            <div class="row guarantee__inRow">
                <div class="col-12 col-lg-6">
                    <div class="zakaTG__card">
                        <label for="name2" class="profileV__label">{{trans('admin.calculator_desc_2')}}</label>
                        <div class="aDInput__group mb-0">
                            <input id="calculator_2" type="text" class="profileV__input mb-0" placeholder=" 100 ">
                            <span class="absAD__label">{{trans('admin.sahm')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="zakaTG__card">
                        <label for="name2" class="profileV__label">{{trans('admin.calculator_desc_2_2')}}</label>
                        <div class="aDInput__group mb-0">
                            <input id="calculator_2_2" type="text" class="profileV__input mb-0" placeholder=" 100 ">
                            <span class="absAD__label">{{$currency_info[$lang.'_currency']}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="orphans__title">{{trans('admin.calculator_3')}}</h3>
            <div class="row guarantee__inRow">
                <div class="col-12 col-lg-6">
                    <div class="zakaTG__card">
                        <label for="name2" class="profileV__label">{{trans('admin.calculator_desc_3')}}</label>
                        <div class="aDInput__group mb-0">
                            <input id="calculator_3" type="text" class="profileV__input mb-0" placeholder=" 100 ">
                            <span class="absAD__label">{{trans('admin.gram')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="zakaTG__card">
                        <label for="name2" class="profileV__label">{{trans('admin.calculator_desc_3_2')}}</label>
                        <div class="aDInput__group mb-0">
                            <input id="calculator_3_2" type="text" class="profileV__input mb-0" placeholder=" 100 ">
                            <span class="absAD__label">{{$currency_info[$lang.'_currency']}}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="justFlex__end">
                <div class="zkatCalc__sumD" style="font-size: 24px;">
                    <span>{{trans('admin.zakat_total')}}</span>
                    <span class="greenSumG"> 120 {{$currency_info[$lang.'_currency']}}</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<?php
$lang = App::getLocale();
$dir = 'right';
if ($lang == 'ar') {
    $dir = 'left';
}
?>
@extends('interface.layout')

@section('title')
{{trans('admin.sponsorships')}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{trans('admin.sponsorships')}}</h3>
    </div>
</section>

<section class="orphans_section mainRelative_section">
    <div class="container pxLG-0">
        <div class="row guarantee__inRow">
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{url('childern')}}" class="guarantee__card">
                    <img src="{{url('upload/site/'.$site['childern'])}}" alt="{{trans('admin.childern')}}" class="grnt_thumb">
                    <h5 class="grntee__name">{{trans('admin.childern')}}</h5>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{url('families')}}" class="guarantee__card">
                    <img src="{{url('upload/site/'.$site['families'])}}" alt="{{trans('admin.families')}}" class="grnt_thumb">
                    <h5 class="grntee__name">{{trans('admin.families')}}</h5>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{url('teachers')}}" class="guarantee__card">
                    <img src="{{url('upload/site/'.$site['teachers'])}}" alt="{{trans('admin.teachers')}}" class="grnt_thumb">
                    <h5 class="grntee__name">{{trans('admin.teachers')}}</h5>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

<?php
$lang = App::getLocale();
$dir = 'right';
if ($lang == 'ar') {
    $dir = 'left';
}
?>
@extends('interface.layout')

@section('title')
{{trans('admin.my_projects')}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{trans('admin.my_projects')}}</h3>
    </div>
</section>

<section class="orphans_section mainRelative_section">
    <div class="container pxLG-0">        
        <div class="searchResults__wrap">
            <h3 class="myInfo_title row">
                <div class="col-12 col-lg-6">
                    {{trans('admin.my_projects')}}
                </div>
                <div class="col-12 col-lg-6">
                    <a href="{{url('project_add')}}" class="contSubmit__btn subMidBtn_width" style="margin: 0; float: {{$dir}};">{{trans('admin.project_private_add')}}</a>
                </div>
            </h3>

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

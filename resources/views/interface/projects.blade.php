<?php
$lang = App::getLocale();
?>
@extends('interface.layout')

@section('title')
{{trans('admin.projects')}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{trans('admin.projects')}}</h3>
    </div>
</section>

<section class="orphans_section mainRelative_section">
    <div class="container pxLG-0">
        <div class="row guarantee__inRow">
            @foreach($categories as $category)
            <div class="col-12 col-md-6 col-lg-4" style="margin-bottom: 20px;">
                <a href="{{url('category/'.$category['id'])}}" class="guarantee__card">
                    <img src="{{url('upload/categories/'.$category['image'])}}" alt="{{$category[$lang.'_name']}}" class="grnt_thumb">
                    <h5 class="grntee__name text-center">{{$category[$lang.'_name']}}</h5>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

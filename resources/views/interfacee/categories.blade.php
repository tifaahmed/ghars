<?php
$lang = App::getLocale();
$active = 'active';
?>
@extends('interface.layout')

@section('title')
{{trans('admin.shop')}}
@endsection

@section('content')
<section class="page-header">
    <div class="container">
        <h2 class="mb-0">{{trans('admin.shop')}}</h2>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            @foreach($categoriess as $category)
            <div class="col-md-3 category-6">
                <div class="category mb-5">
                    <figure class="image-container">
                        <a href="{{url('category/'.$category['id'])}}" class="cat-image">
                            <img src="{{url('upload/categories/'.$category['image'])}}" class="mw-100" alt="{{$category[$lang.'_name']}}">
                        </a>
                    </figure>
                    <h2 class="cat-title"><a href="{{url('category/'.$category['id'])}}">{{$category[$lang.'_name']}}</a></h2>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
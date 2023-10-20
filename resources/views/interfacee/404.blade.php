<?php $lang = App::getLocale(); ?>
@extends('interface.layout')

@section('title')
{{trans('admin.not_found')}}
@endsection

@section('content')
<section class="section">
    <div class="container">
        <div class="not-found-msg">
            <span>404</span>
            <h2>{{trans('admin.not_found')}}</h2>
            <p>{{trans('admin.not_found_1')}}</p>
        </div>
    </div>
</section>
@endsection

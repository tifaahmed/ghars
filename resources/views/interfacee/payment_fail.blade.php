<?php $lang = App::getLocale(); ?>
@extends('interface.layout')

@section('title')
{{trans('admin.payment_fail')}}
@endsection

@section('content')
<section class="section">
    <div class="container">
        <div class="row py-5">
            <div class="col-md-6 offset-md-3">
                <div class="alert-msg text-center">
                    <img src="{{url('interface')}}/assets/images/icons/cart-error.svg" alt="{{trans('admin.payment_fail')}}">
                    <h4>{{trans('admin.error')}}!</h4>
                    <p>{{trans('interface.payment_fail')}}<br>{{trans('admin.try_again')}}!</p>
                    <a href="{{url('cart')}}" class="btn btn-default">{{trans('admin.try_again_1')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

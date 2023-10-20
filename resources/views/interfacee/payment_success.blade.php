<?php $lang = App::getLocale(); ?>
@extends('interface.layout')

@section('title')
{{trans('admin.payment_success_1')}}
@endsection

@section('content')
<section class="section">
    <div class="container">
        <div class="row py-5">
            <div class="col-md-6 offset-md-3">
                <div class="alert-msg text-center">
                    <img src="{{url('interface')}}/assets/images/icons/cart-success.svg" alt="{{trans('admin.payment_success_1')}}">
                    <h4>{{trans('admin.payment_success_1')}}</h4>
                    <p>{{trans('admin.payment_success')}}
                </div>
                <div class="card card-dark">
                    <table class="table info-table mb-0">
                        <tbody>
                            <tr>
                                <td>{{trans('admin.order_id')}}</td>
                                <td dir="ltr">#AM{{$order['id']}}</td>
                            </tr>
                            <tr>
                                <td>{{trans('admin.payment_id')}}</td>
                                <td>{{$order['payment_id']}}</td>
                            </tr>
                            <tr>
                                <td>{{trans('admin.transaction_id')}}</td>
                                <td>{{$order['transaction_id']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <a href="{{url('orders')}}" class="btn btn-default">{{trans('admin.my_orders')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

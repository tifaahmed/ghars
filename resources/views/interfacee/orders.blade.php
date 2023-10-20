<?php $lang = App::getLocale(); ?>
@extends('interface.layout')

@section('title')
{{trans('admin.my_orders')}}
@endsection

@section('content')
<section class="section">
    <div class="container">
        @include('interface.account')

        <div class="">
            <ul class="nav nav-pills justify-content-center" id="accountTabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{url('orders')}}">{{trans('admin.my_orders')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('addresses')}}">{{trans('admin.my_addresses')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('favorites')}}">{{trans('admin.wishlist')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('profile')}}">{{trans('admin.edit_profile')}}</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active">
                    <div class="row">
                        @if(count($orders) == 0)
                        <div class="col-sm-12">
                            <div class="category-empty">
                                <p>{{trans('admin.no_orders')}}</p>
                            </div>
                        </div>
                        @endif
                        @foreach($orders as $order)
                        <div class="col-sm-6">
                            <div class="card">
                                <table class="mb-0 table-order">
                                    <tbody>
                                        <tr>
                                            <td>{{trans('admin.order_placed')}}<b>{{$order['date']}}</b></td>
                                            <td>{{trans('admin.order_id')}}<b dir="ltr">#AM{{$order['id']}}</b></td>
                                            <td>{{trans('admin.items')}}<b>{{count($order['Products'])}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>{{trans('admin.amount')}}<b>{{number_format($order['total'] + $order['delivery'] + $order['fees'] - $order['promo_code_amount'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]}}</b></td>
                                            <td>{{trans('admin.order_status')}}<b>{{trans('admin.order_'.$order['status'])}}</b></td>
                                            <td><a href="{{url('order/'.$order['id'])}}" class="btn btn-sm btn-default">{{trans('admin.view')}}</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@if (Session::has('error'))
<script>
    $('.result_div').html('<i class="fas fa-exclamation-circle"></i><h4><?php echo trans('admin.error'); ?>!</h4><p><?php echo Session::get('error'); ?></p>');
    $('#result_message').modal('show');
</script>
@endif
@endsection

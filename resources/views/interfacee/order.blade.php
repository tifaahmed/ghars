<?php 
$lang = App::getLocale();
if($lang == 'en'){
    $dir = 'right';
}else{
    $dir = 'left';
}
?>
@extends('interface.layout')

@section('title')
{{trans('admin.orders_details_no').' : '.$order['id']}}
@endsection

@section('content')
<section class="section">
    <div class="container">
        <div class="order-header">
            <div class="row align-items-center">
                <div class="col-sm-8">
                    <div class="order-shipping-address">
                        <h5>{{trans('admin.shipping_address')}}</h5>
                        <p>
                            {{$order['country_'.$lang]}}, {{$order['city_'.$lang]}} , <span dir='ltr'>{{$order['phone']}}</span><br>
                            {{$order['address_line_1']}}, {{$order['address_line_2']}},  {{$order['postal_code']}}<br>
                            {{$order['address_name']}}
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 text-md-{{$dir}}  mb-md-0 mb-4">
                    <button class="btn btn-default" data-toggle="modal" data-target="#reorder">{{trans('admin.reorder')}}</button>
                </div>
            </div>
            <div class="card">
                <div class="table-responsive border-0">
                    <table class="mb-0 table table-order">
                        <tbody>
                            <tr>
                                <td>{{trans('admin.order_placed')}}<b>{{$order['date']}}</b></td>
                                <td>{{trans('admin.order_id')}}<b dir="ltr">#AM{{$order['id']}}</b></td>
                                <td>{{trans('admin.payment_id')}}<b>{{$order['payment_id']}}</b></td>
                                <td>{{trans('admin.transaction_id')}}<b>{{$order['transaction_id']}}</b></td>
                                <td>{{trans('admin.items')}}<b>{{count($order['Products'])}}</b></td>
                                <td>{{trans('admin.amount')}}<b>{{number_format($order['total'] + $order['delivery'] + $order['fees'] - $order['promo_code_amount'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]}}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="order-status text-center py-4 mb-3">
            <h6>{{trans('admin.order_status')}}</h6>
            <h2>{{trans('admin.order_'.$order['status'])}}</h2>
        </div>
        <div class="row">
            <div class="col-md-8">
                <h2 class="mb-3">{{trans('admin.products')}}</h2>
                <div class="table-responsive"> 
                    <table class="table cart-table mb-5">
                        <thead>
                            <tr>
                                <th>{{trans('admin.product')}}</th>
                                <th class="text-center">{{trans('admin.qunatity')}}</th>
                                <th>{{trans('admin.price')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order['Products'] as $product)
                            <tr>
                                <td>
                                    <img src="{{url('upload/products/'.$product['Product']['image'])}}" style="width:80px"> {{$product['Product'][$lang.'_name']}}
                                </td>
                                <td class="text-center">{{$product['count']}}</td>
                                <td>{{number_format($product['price']*$product['count'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div>
                    <h6 class="mb-3">{{trans('admin.gift_message')}}</h6>
                    <p>{{$order['gift']}}</p>
                </div> 
                <div class="card">
                    <h5 class="mb-4">{{trans('admin.payment_summary')}}</h5>
                    <div class="table-responsive">
                        <table class="table table-totals mb-0">
                            <tbody>
                                <tr>
                                    <td>{{trans('admin.products_total')}}</td>
                                    <td>{{number_format($order['total'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]}}</td>
                                </tr>

                                <tr>
                                    <td>{{trans('admin.delivery_fee')}}</td>
                                    <td>{{number_format($order['delivery'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]}}</td>
                                </tr>

                                <tr>
                                    <td>{{trans('admin.fees')}}</td>
                                    <td>{{number_format($order['fees'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]}}</td>
                                </tr>

                                <tr>
                                    <td>{{trans('admin.discount')}}</td>
                                    <td>{{number_format($order['promo_code_amount'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]}}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>{{trans('admin.total')}}</td>
                                    <td>{{number_format($order['total'] + $order['delivery'] + $order['fees'] - $order['promo_code_amount'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</section>

<div class="modal fade" id="reorder" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert-msg text-center">
                    <i class="fas fa-sync"></i>
                    <h4>{{trans('admin.reorder')}}</h4>
                    <p>{{trans('admin.reorder_1')}}</p>
                    <a href="#" data-dismiss="modal" class="btn btn-link text-uppercase">{{trans('admin.cancel')}}</a>
                    <a href="{{url('reorder/'.$order['id'])}}" class="btn btn-default">{{trans('admin.reorder')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
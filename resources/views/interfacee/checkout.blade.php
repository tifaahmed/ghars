<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
if ($lang == 'en') {
    $dir = 'right';
    $m = 'mr-3';
} else {
    $dir = 'left';
    $m = 'ml-3';
}
?>
@extends('interface.layout')

@section('title')
{{trans('admin.checkoutt')}}
@endsection

@section('content')
<section class="section">
    <div class="container">
        <h2 class="page-title">{{trans('admin.checkoutt')}} <a href="{{url('cart')}}" class="btn btn-lg btn-default float-{{$dir}}">{{trans('admin.back_cart')}}</a></h2>
        <div class="row">
            <div class="col-md-8">
                <div class="shipping-address mb-4">
                    <h4 class="mb-4">{{trans('admin.shipping_address')}}</h4>
                    <div class="adresses row">
                        <div class="col-md-6">
                            <div class="card">
                                <label class="mb-0">
                                    <strong>{{$address['address_name']}}</strong><br>
                                    {{$address['Country'][$lang.'_name']}}, {{$address['City'][$lang.'_name']}}<br>
                                    <span dir="ltr">{{$address['Country']['code'].$address['phone']}}</span><br>
                                    {{$address['address_line_1']}}<br>
                                    {{$address['address_line_2']}}<br>
                                    {{$address['postal_code']}}<br>
                                    {{$address['notes']}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shipping-duration">
                    <h4 class="mb-4">{{trans('admin.delivery_time')}}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="w-100">
                                    <img src="{{url('interface')}}/assets/images/icons/duration.svg" class="{{$m}}" alt=""><span class="d-inline-block">{{$address['Country'][$lang.'_delivery']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <form action="{{URL::to('payment')}}" method="post" id="payment_form">
                    {{ csrf_field() }}

                    <div class="shipping-address ">
                        <h4 class="mb-4">{{trans('admin.pay_type')}}</h4>
                        <div class="adresses row">                       
                            @foreach($payment_methods as $payment_method)
                            <div class="col-6" style="cursor: pointer;">
                                <div class="mb-0" style="background: #fff; padding: 10px;">
                                    <label class="custom-control-labell" for="payment_method_{{$payment_method['id']}}" style="cursor: pointer;">
                                        <div class="w-100">
                                            <img src="{{$payment_method['image']}}" class="{{$m}}" alt=""><span style="font-weight: normal;" class="d-inline-block">{{$payment_method['name']}}</span>
                                        </div>
                                    </label>
                                    <input type="radio" name="payment_method" id="payment_method_{{$payment_method['id']}}" class="payment_input" value="{{$payment_method['id']}}" style="cursor: pointer;">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <br>
                    </div>

                    <div class="card">
                        <table class="table table-totals mb-4">
                            <tbody>
                                <tr>
                                    <td>{{trans('admin.products_total')}}</td>
                                    <td>{{$products_total}}</td>
                                </tr>
                                <tr>
                                    <td>{{trans('admin.discount')}}</td>
                                    <td>{{$discount}}</td>
                                </tr>
                                <tr>
                                    <td>{{trans('admin.fees')}}</td>
                                    <td>{{$fees}}</td>
                                </tr>
                                <tr>
                                    <td>{{trans('admin.delivery_fee')}}</td>
                                    <td>{{$delivery}}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>{{trans('admin.total')}}</td>
                                    <td id="total">{{$total}}</td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="custom-control custom-checkbox">
                            {{ Form::checkbox('agree','yes', false, ['class'=>'custom-control-input','id'=>'acceptTerms']) }}
                            <label class="custom-control-label" for="acceptTerms">{{trans('admin.agree')}} <a href="{{url('page/2')}}" target="_blank">{{$pages[1][$lang.'_title']}}</a>, <a href="{{url('page/3')}}" target="_blank">{{$pages[2][$lang.'_title']}}</a> {{trans('admin.and')}} <a href="{{url('page/4')}}" target="_blank">{{$pages[3][$lang.'_title']}}</a> {{trans('admin.of')}}</label>
                        </div>
                        {{Form::hidden('coupon',$coupon)}}
                        {{Form::hidden('address_id',$address['id'])}}
                        {{Form::hidden('gift_message',$gift_message)}}
                        <button type="submit" class="btn btn-default">{{trans('admin.payment')}}</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</section>
@endsection

@section('scripts')
<script>
    $("body").on('submit', '#payment_form', function () {
        if ($('#acceptTerms:checkbox:checked').length == 0 || $("input[name='payment_method']:checked").length == 0) {
            $('.result_div').html('<i class="fas fa-exclamation-circle"></i><h4><?php echo trans('admin.error'); ?>!</h4><p><?php echo trans('admin.checkout_error'); ?></p>');
            $('#result_message').modal('show');
            return false;
        }
    });
</script>
@endsection

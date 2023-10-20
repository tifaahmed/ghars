<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
$user_id = 0;
if (Auth::Check()) {
    $user_id = Auth::User()->id;
}
?>
@extends('interface.layout')

@section('title')
{{trans('admin.wishlist')}}
@endsection

@section('content')
<section class="section">
    <div class="container">
        @include('interface.account')

        <div class="">
            <ul class="nav nav-pills justify-content-center" id="accountTabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('orders')}}">{{trans('admin.my_orders')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('addresses')}}">{{trans('admin.my_addresses')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{url('favorites')}}">{{trans('admin.wishlist')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('profile')}}">{{trans('admin.edit_profile')}}</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active">
                    <div class="row">
                        @if(count($products) == 0)
                        <div class="col-sm-12">
                            <div class="category-empty">
                                <p>{{trans('admin.no_products')}}</p>
                            </div>
                        </div>
                        @endif
                        @foreach($products as $product)
                        <?php $price = \App\Models\ProductPrice::where('currency_id', Session::get('currency'))->where('product_id', $product['id'])->first(); ?>
                        <div class="col-md-4 col-6">
                            <div class="product">
                                <figure class="image-container d-flex flex-column justify-content-center">
                                    <a href="{{url('product/'.$product['id'])}}" class="product-image">
                                        <img src="{{url('upload/products/'.$product['image'])}}" class="mw-100" alt="{{$product[$lang.'_name']}}">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h2 class="product-title"><a href="{{url('product/'.$product['id'])}}">{{$product[$lang.'_name']}}</a></h2>
                                    <div class="product-price">
                                        @if ($product['Category']['offer'] > 0)
                                        <span class="price">{{number_format($price['price'] - ($price['price'] * $product['Category']['offer'] / 100), $price['Currency']['currency_format'], '.', '') . ' ' . $price['Currency'][$lang . '_currency']}}</span>
                                        <span class="old-price">{{number_format($price['price'], $price['Currency']['currency_format'], '.', '') . ' ' . $price['Currency'][$lang . '_currency']}}</span>
                                        @elseif ($price['offer'] > 0) 
                                        <span class="price">{{number_format($price['offer'], $price['Currency']['currency_format'], '.', '') . ' ' . $price['Currency'][$lang . '_currency']}}</span>
                                        <span class="old-price">{{number_format($price['price'], $price['Currency']['currency_format'], '.', '') . ' ' . $price['Currency'][$lang . '_currency']}}</span>
                                        @else
                                        <span class="price">{{number_format($price['price'], $price['Currency']['currency_format'], '.', '') . ' ' . $price['Currency'][$lang . '_currency']}}</span>
                                        @endif
                                    </div>
                                    <div class="product-details-inner">
                                        <div class="product-action">
                                            @if($product['quantity'] > 0)
                                            <a style="color:#fff;" class="btn add-cart" id="add_cart" product='{{$product['id']}}' user='{{$user_id}}' title="{{trans('admin.add_cart')}}">
                                                <i class="icon icon-bag-white"></i>{{trans('admin.add_cart')}}
                                            </a>
                                            @else
                                            <a style="color:#fff;" class="btn add-cart" disabled="" title="{{trans('admin.sold_out')}}">
                                                <i class="icon icon-bag-white"></i>{{trans('admin.sold_out')}}
                                            </a>
                                            @endif
                                            <a href='{{url('remove_favorite/'.$product['id'])}}' class="btn add-wishlist" title="{{trans('admin.del_fav')}}">
                                                <i class="icon icon-sheart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
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

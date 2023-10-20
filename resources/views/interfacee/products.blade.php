<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
if (request()->has('word')) {
    $class = 'col-md-3 col-6';
} else {
    $class = 'col-md-6 col-xl-4 col-6';
}
$user_id = 0;
if (Auth::Check()) {
    $user_id = Auth::User()->id;
}
?>

@foreach($products as $product)
<div class="{{$class}}">
    <div class="product">
        <figure class="image-container d-flex flex-column justify-content-center">
            <a href="{{url('product/'.$product['product_id'])}}" class="product-image">
                <img src="{{url('upload/products/'.$product['image'])}}" class="mw-100" alt="{{$product[$lang.'_name']}}">
            </a>
        </figure>
        <div class="product-details">
            <h2 class="product-title"><a href="{{url('product/'.$product['product_id'])}}">{{$product[$lang.'_name']}}</a></h2>
            <div class="product-price">
                @if ($product['Category']['offer'] > 0)
                <span class="price">{{number_format($product['price'] - ($product['price'] * $product['Category']['offer'] / 100), $currency_info['currency_format'], '.', '') . ' ' . $currency_info[$lang . '_currency']}}</span>
                <span class="old-price">{{number_format($product['price'], $currency_info['currency_format'], '.', '') . ' ' . $currency_info[$lang . '_currency']}}</span>
                @elseif ($product['offer'] > 0) 
                <span class="price">{{number_format($product['offer'], $currency_info['currency_format'], '.', '') . ' ' . $currency_info[$lang . '_currency']}}</span>
                <span class="old-price">{{number_format($product['price'], $currency_info['currency_format'], '.', '') . ' ' . $currency_info[$lang . '_currency']}}</span>
                @else
                <span class="price">{{number_format($product['price'], $currency_info['currency_format'], '.', '') . ' ' . $currency_info[$lang . '_currency']}}</span>
                @endif
            </div>
            <div class="product-details-inner">
                <div class="product-action">
                    @if($product['quantity'] > 0)
                    <a style="color:#fff;" class="btn add-cart" id="add_cart" product='{{$product['product_id']}}' user='{{$user_id}}' title="{{trans('admin.add_cart')}}">
                        <i class="icon icon-bag-white"></i>{{trans('admin.add_cart')}}
                    </a>
                    @else
                    <a style="color:#fff;" class="btn add-cart" disabled="" title="{{trans('admin.sold_out')}}">
                        <i class="icon icon-bag-white"></i>{{trans('admin.sold_out')}}
                    </a>
                    @endif
                    <a style="cursor: pointer;" class="btn add-wishlist favorite" product_id="{{$product['product_id']}}" title="{{trans('admin.add_fav')}}">
                        @if(Auth::check() && \App\Models\Favourite::where('user_id',Auth::User()->id)->where('product_id',$product['product_id'])->count() > 0)
                        <i class="icon icon-sheart"></i>
                        @else
                        <i class="icon icon-heart"></i>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
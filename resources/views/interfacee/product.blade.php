<?php
$lang = App::getLocale();
if ($lang == 'en') {
    $m = 'ml-4';
} else {
    $m = 'mr-4';
}
$user_id = 0;
if (Auth::Check()) {
    $user_id = Auth::User()->id;
}
$price = \App\Models\ProductPrice::where('currency_id', Session::get('currency'))->where('product_id', $product['id'])->first();
?>
@extends('interface.layout')

@section('title')
{{$product[$lang.'_name']}}
@endsection

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-product-gallery">
                    <div class="master-slider ms-skin-black-2" id="gallery">
                        <div class="ms-slide">
                            <img src="{{url('upload/products/'.$product['image'])}}" data-src="{{url('upload/products/'.$product['image'])}}" alt="{{$product[$lang.'_name']}}"/>  
                            <img class="ms-thumb" src="{{url('upload/products/'.$product['image'])}}" alt="{{$product[$lang.'_name']}}">
                        </div>
                        @foreach($product['Images'] as $image) 
                        <div class="ms-slide">
                            <img src="{{url('upload/products/'.$image['image'])}}" data-src="{{url('upload/products/'.$image['image'])}}" alt="{{$product[$lang.'_name']}}"/>  
                            <img class="ms-thumb" src="{{url('upload/products/'.$image['image'])}}" alt="{{$product[$lang.'_name']}}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="single-product-details mt-md-0 mt-4">
                    <header>
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="single-product-title">{{$product[$lang.'_name']}}</h1>
                                <p>{{$product[$lang.'_ingredients']}}</p>
                            </div>
                            <div class="col-sm-4 mt-sm-0 mt-3">
                                <span class="single-product-price">
                                    @if ($product['Category']['offer'] > 0)
                                    {{number_format($price['price'] - ($price['price'] * $product['Category']['offer'] / 100), $price['Currency']['currency_format'], '.', '') . ' ' . $price['Currency'][$lang . '_currency']}}
                                    <p><strike>{{number_format($price['price'], $price['Currency']['currency_format'], '.', '') . ' ' . $price['Currency'][$lang . '_currency']}}</strike></p>
                                    @elseif ($price['offer'] > 0) 
                                    {{number_format($price['offer'], $price['Currency']['currency_format'], '.', '') . ' ' . $price['Currency'][$lang . '_currency']}}
                                    <p><strike>{{number_format($price['price'], $price['Currency']['currency_format'], '.', '') . ' ' . $price['Currency'][$lang . '_currency']}}</strike></p>
                                    @else
                                    {{number_format($price['price'], $price['Currency']['currency_format'], '.', '') . ' ' . $price['Currency'][$lang . '_currency']}}
                                    @endif
                                </span>
                                <button class="btn share-button share-button-web d-md-none" type="button" title="Share"> <img src="{{url('interface/assets/images/upload.svg')}}"> {{trans('admin.share')}}</button>
                            </div>

                        </div>
                    </header>
                    <div class="d-flex align-items-end product-action">
                        @if($product['quantity'] > 0)
                        <div class="quantity">
                            <small>{{trans('admin.quantity')}}</small>
                            <div>
                                <div class="value-button decrease">-</div>
                                <input type="number" class="number" value="1" id="quantity" max="{{$product['quantity']}}">
                                <div class="value-button increase">+</div>
                            </div>
                        </div>
                        @endif
                        <div class="{{$m}}">
                            @if($product['quantity'] > 0)
                            <a style="color: white;" class="btn add-cart" id="add_cartt" product='{{$product['id']}}' user='{{$user_id}}' title="{{trans('admin.add_cart')}}">
                                <i class="icon icon-bag-white"></i>{{trans('admin.add_cart')}}
                            </a>
                            @else
                            <a style="color: white;" class="btn add-cart" disabled="" title="{{trans('admin.sold_out')}}">
                                <i class="icon icon-bag-white"></i>{{trans('admin.sold_out')}}
                            </a>
                            @endif
                            <a style="cursor: pointer;" class="btn add-wishlist favorite" product_id="{{$product['id']}}" title="{{trans('admin.add_fav')}}">
                                @if(Auth::check() && \App\Models\Favourite::where('user_id',Auth::User()->id)->where('product_id',$product['id'])->count() > 0)
                                <i class="icon icon-sheart"></i>
                                @else
                                <i class="icon icon-heart"></i>
                                @endif
                            </a>
                            <button class="btn share-button share-button-mob" type="button" title="Share"> <img src="{{url('interface/assets/images/upload.svg')}}"> {{trans('admin.share')}}</button>
                        </div>
                    </div>
                    <div class="product-desc">
                        <h4>{{trans('admin.product_desc')}}</h4>
                        <p class="text-justify">{!! $product[$lang.'_desc'] !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('scripts')
<script type="text/javascript">
    if (!navigator.share) {
        $('.share-button').hide();
    }
    const shareButtonMobile = document.querySelector('.share-button-mob');
    shareButtonMobile.addEventListener('click', event => {
        if (navigator.share) {
            navigator.share({
                title: "<?php echo $product[$lang . '_name'] ?>",
                url: "<?php echo url('product/' . $product['id']) ?>"
            }).then(() => {
                console.log('Thank you for sharing our products with the world!');
            }).catch(console.error);
        } else {
            console.log('Device Not Supported...');
        }
    });
    
    
    const shareButtonWeb = document.querySelector('.share-button-web');
    shareButtonWeb.addEventListener('click', event => {
        if (navigator.share) {
            navigator.share({
                title: "<?php echo $product[$lang . '_name'] ?>",
                url: "<?php echo url('product/' . $product['id']) ?>"
            }).then(() => {
                console.log('Thank you for sharing our products with the world!');
            }).catch(console.error);
        } else {
            console.log('Device Not Supported...');
        }
    });
</script>
<script>
    var slider = new MasterSlider();
    slider.control('arrows');
    slider.control('thumblist', {autohide: false, dir: 'h', arrows: false, align: 'bottom', width: 104, height: 104, margin: 5, space: 5});
    slider.setup('gallery', {
        width: 380,
        height: 500,
        space: 5,
        view: 'scale'
    });
    $('.increase').click(function () {
        var value = $(this).prev('.number').val();
        var max = $(this).prev('.number').attr('max');
        value = parseFloat(value) + 1;
        if (value <= parseFloat(max)) {
            $(this).prev('.number').val(value);
        }
    });
    $('.decrease').click(function () {
        var value = $(this).next('.number').val();
        if (value > 1) {
            value = parseFloat(value) - 1;
        } else {
            value = 1;
        }
        $(this).next('.number').val(value);
    });
    
    $("body").on("click", "#add_cartt", function (e) {
        var product = $(this).attr('product');
        var quantity = $('.number').val();

        var link = "<?php echo url('/') ?>";
    
        if (quantity == 0 || quantity == "") {
            $('.result_div').html('<i class="fas fa-exclamation-circle"></i><h4><?php echo trans('admin.error'); ?>!</h4><p><?php echo trans('admin.err_quantity'); ?></p>');
            $('#result_message').modal('show');
            return false;
        }
    
        $('.close_model').hide();
        $('.result_div').html('<div class="col-md-12 col-xl-12 text-center loading"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');
        $('#result_message').modal('show');
        $.ajax({
            type: "GET",
            url: link + "/add_cart/" + product + '?quantity=' + quantity,
            success: function (datas) {
                $('#cart_count').html(datas.cart_count);
                $('#cart_total').html(datas.cart_total);
                if (datas.status == 1) {
                    $('.result_div').html('<i class="fas fa-check-circle"></i><h4><?php echo trans('admin.success'); ?>!</h4><p>' + datas.message + '</p>');
                    $('.close_model').show();
                    $('#result_message').modal('show');
                } else {
                    $('.result_div').html('<i class="fas fa-exclamation-circle"></i><h4><?php echo trans('admin.error'); ?>!</h4><p>' + datas.message + '</p>');
                    $('.close_model').show();
                    $('#result_message').modal('show');
                }
                return false;
            }
        });
    });
</script>
@endsection
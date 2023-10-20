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
{{trans('admin.search_results')}} "{{request()->get("word")}}"
@endsection

@section('content')
<section class="section" style="min-height: 600px;">
    <div class="container">
        @if(count($products) == 0)
        <h2 class="page-title mb-5 text-uppercase">{{trans('admin.no_search_results')}} <strong>"{{request()->get("word")}}"</strong></h2>
        <p><img src="{{url('interface')}}/assets/images/icons/search-x.svg" class="mr-3" alt="{{trans('admin.research_again')}}">{{trans('admin.research_again')}}</p>
        @else
        <h2 class="page-title mb-5 text-uppercase">{{trans('admin.search_results')}} <strong>"{{request()->get("word")}}"</strong></h2>
        <div class="row" id="products" page='1' last_page='{{$products->lastPage()}}'>            
            @foreach($products as $product)
            <div class="col-md-3 col-6">
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
        </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>
    $(window).on('scroll', function () {
        if ($(window).scrollTop() >= $('#products').offset().top + $('#products').outerHeight() - window.innerHeight - 100) {
            var page = parseInt($('#products').attr('page')) + 1;
            var last_page = parseInt($('#products').attr('last_page'));
            var link = "<?php echo url('/'); ?>";
            var word = "<?php echo request()->get("word"); ?>";
            if (page <= last_page) {
                $('#products').attr('page', page);
                $('#products').append('<div class="col-md-12 col-xl-12 text-center loading"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');
                $.ajax({
                    type: "GET",
                    url: link + "/search?page=" + page + "&word=" + word + "&json=yes",
                    success: function (data) {
                        $('.loading').remove();
                        $('#products').append(data);
                    }
                });
            }
        }
    });
</script>
@endsection

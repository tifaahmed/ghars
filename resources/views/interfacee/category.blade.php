<?php
$lang = App::getLocale();
if($lang == 'ar'){
    $arrow = 'left';
}else{
    $arrow = 'right';
}
$currency_info = App\Models\Currency::find(Session::get('currency'));
$user_id = 0;
if (Auth::Check()) {
    $user_id = Auth::User()->id;
}
?>
@extends('interface.layout')

@section('title')
{{$category[$lang.'_name']}}
@endsection

@section('content')
<section class="page-header">
    <div class="container">
        <h2 class="mb-0">{{$category[$lang.'_name']}}</h2>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="sorting">
                    <h4 id="sorting_title_web">{{trans('admin.sort_by')}}</h4>
                    <h4 id="sorting_title_mobile">{{trans('admin.sort_by')}} <i class='fa fa-chevron-{{$arrow}}'></i></h4>
                    <div id="sorting_options">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="a_z" name="sort" class="custom-control-input" value="a_z">
                            <label class="custom-control-label" for="a_z">{{trans('admin.a_z')}}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="z_a" name="sort" class="custom-control-input" value="z_a">
                            <label class="custom-control-label" for="z_a">{{trans('admin.z_a')}}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="low_high" name="sort" class="custom-control-input" value="low_high">
                            <label class="custom-control-label" for="low_high">{{trans('admin.low_high')}}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="high_low" name="sort" class="custom-control-input" value="high_low">
                            <label class="custom-control-label" for="high_low">{{trans('admin.high_low')}}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="newest" name="sort" class="custom-control-input" value="newest" checked="">
                            <label class="custom-control-label" for="newest">{{trans('admin.newest')}}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="best_seller" name="sort" class="custom-control-input" value="best_seller">
                            <label class="custom-control-label" for="best_seller">{{trans('admin.best_seller')}}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-12">
                @if(count($products) == 0)
                <div class="category-empty">
                    <p>{{trans('admin.no_products')}}<span>{{trans('admin.check_later')}}</span></p>
                </div>
                @endif
                <div class="row" id="products" page='1' last_page='{{$products->lastPage()}}'>
                    @foreach($products as $product)
                    <div class="col-md-6 col-xl-4 col-6">
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
            </div>
        </div>
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
            var sort = $('input[name="sort"]:checked').val();
            var category = "<?php echo $category['id']; ?>";
            if (page <= last_page) {
                $('#products').attr('page', page);
                $('#products').append('<div class="col-md-12 col-xl-12 text-center loading"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');
                $.ajax({
                    type: "GET",
                    url: link + "/category/" + category + "?page=" + page + "&sort=" + sort + "&json=yes",
                    success: function (data) {
                        $('.loading').remove();
                        $('#products').append(data);
                    }
                });
            }
        }
    });

    $('input[name=sort]').change(function () {
        var sort = $('input[name="sort"]:checked').val();
        var link = "<?php echo url('/'); ?>";
        var category = "<?php echo $category['id']; ?>";
        $('#products').attr('page', 1);
        $('#products').html('<div class="col-md-12 col-xl-12 text-center loading" style="padding-top:50px;"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');
        $.ajax({
            type: "GET",
            url: link + "/category/" + category + "?page=1&sort=" + sort + "&json=yes",
            success: function (data) {
                $('#products').html(data);
            }
        });
    });
    
    $('#sorting_title_mobile').click(function(){
       $('#sorting_options').toggle();
    });
</script>
@endsection

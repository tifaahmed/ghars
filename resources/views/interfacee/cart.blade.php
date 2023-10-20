<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
$total = 0;
if ($lang == 'en') {
    $p = 'pl-3';
    $m = 'ml-3';
} else {
    $p = 'pr-3';
    $m = 'mr-3';
}
?>
@extends('interface.layout')

@section('title')
{{trans('admin.cart')}}
@endsection

@section('content')
<section class="section">
    <div class="container">
        <h2 class="page-title">{{trans('admin.cart')}}<a href="{{url('categories')}}" class="btn btn-lg btn-default float-right">{{trans('admin.continue_shopping')}}</a></h2>
        @if(count($products) == 0)
        <div class="cart-empty">
            <img src="{{url('interface')}}/assets/images/icons/cart-empty.svg" alt="{{trans('admin.empty_cart')}}">
            <p class="mt-3">{{trans('admin.empty_cart')}}</p>
        </div>
        @else
        <form action="{{URL::to('checkout')}}" method="post" id="checkout_form">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive"> 
                        <table class="table cart-table mb-5">
                            <thead>
                                <tr>
                                    <th>{{trans('admin.product_name')}}</th>
                                    <th class="text-center">{{trans('admin.quantity')}}</th>
                                    <th>{{trans('admin.price')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                @if ($product['Product']['active'] == 'yes')
                                <?php
                                $price = \App\Models\ProductPrice::where('currency_id', $currency_info['id'])->where('product_id', $product['product_id'])->first();

                                if ($product['Product']['Category']['offer'] > 0) {
                                    $product_price = $price['price'] - ($price['price'] * $product['Product']['Category']['offer'] / 100);
                                } elseif ($price['offer'] > 0) {
                                    $product_price = $price['offer'];
                                } else {
                                    $product_price = $price['price'];
                                }

                                if ($product['Product']['purchasable_type'] == 'limited' && $product['quantity'] > $product['Product']['purchasable']) {
                                    $quantity = $product['Product']['purchasable'];
                                } elseif ($product['quantity'] > $product['Product']['quantity']) {
                                    $quantity = $product['Product']['quantity'];
                                } else {
                                    $quantity = $product['quantity'];
                                }
                                $total = $total + ($product_price * $quantity);
                                ?>
                                <tr>
                                    <td>
                                        <a href="{{url('product/'.$product['product_id'])}}" title="{{$product['Product'][$lang.'_name']}}">
                                            <img src="{{url('upload/products/'.$product['Product']['image'])}}" style="width:80px"> {{$product['Product'][$lang.'_name']}}
                                        </a>
                                    </td>
                                    <td class="text-center">{{$quantity}}</td>
                                    <td>{{number_format($product_price*$quantity, $currency_info['currency_format'], '.', '') . ' ' . $currency_info[$lang . '_currency']}}</td>
                                    <td><a href="{{url('remove_cart/'.$product['id'])}}" class="cart-remove">x</a></td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if(Auth::Check())
                    <div class="shipping-address">
                        <h4>{{trans('admin.shipping_address')}}</h4>
                        <p>{{trans('admin.you_have').' '.count($addresses).' '.trans('admin.saved_addresses')}}</p>
                        <div class="adresses row">
                            @foreach($addresses as $address)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="custom-control custom-radio mb-0">
                                        <?php
                                        $checked = '';
                                        if (Session::has('address_id') && Session::get('address_id') == $address['id']) {
                                            $checked = 'checked="checked"';
                                        }
                                        ?>
                                        <input type="radio" id="address_{{$address['id']}}" name="address_id" class="custom-control-input" value="{{$address['id']}}" currency='{{$address['Country']['currency_id']}}' current_currency='{{$currency_info['id']}}' {{$checked}}>
                                        <label class="custom-control-label" for="address_{{$address['id']}}">
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
                            @endforeach
                        </div>
                        <a href="#" class="btn btn-default text-uppercase" data-toggle="modal" data-target="#addAddressModal">{{trans('admin.address_add')}}</a>
                    </div>
                    @else
                    <div class="shipping-address">
                        <h4>{{trans('admin.welcome_guest')}}</h4>
                        <p>{{trans('admin.need_register')}}</p>
                        <p>{{trans('admin.need_register_2')}}</p>
                        <a href="#" class="btn btn-default text-uppercase" data-toggle="modal" data-target="#loginModal">{{trans('admin.login')}} / {{trans('admin.register')}}</a>
                    </div>
                    @endif
                </div>
                <div class="col-md-4 mt-md-0 mt-5">
                    <div class="promo-code">
                        <h6>{{trans('admin.promo_codee')}} <span class="valid">{{trans('api.valid_copoun')}}</span><span class="invalid">{{trans('api.invalid_copoun')}}</span></h6>
                        <div class="form-wrapper">
                            <div>
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control pl-3" name="coupon" id="coupon" placeholder="{{trans('admin.enter_here')}}">
                                    <button type="button" class="btn btn-sm btn-default" id="applyCode">{{trans('admin.apply')}}</button>
                                    <button type="button" class="btn btn-sm btn-default" id="removeCode">{{trans('admin.remove')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="items-count">
                            <span>{{trans('admin.items')}}<strong class="float-right">{{count($products)}}</strong></span>
                        </div>
                        <div class="cart-gift">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_gift" id="showGift">
                                <label class="custom-control-label" for="showGift">{{trans('admin.the_gift')}}</label>
                            </div>
                            <div class="form-wrapper gift-msg">
                                <div class="form-group">
                                    <label>{{trans('admin.gift_message')}}</label>
                                    <textarea class="form-control {{$p}}" placeholder="{{trans('admin.type_here')}}" name="gift_message" id="giftMsg"></textarea>
                                </div>
                            </div>
                        </div>
                        <table class="table table-totals">
                            <tbody>
                                <tr>
                                    <td>{{trans('admin.products_total')}}</td>
                                    <td id="products_total">{{number_format($total, $currency_info['currency_format'], '.', '').' '.$currency_info[$lang.'_currency']}}</td>
                                </tr>

                                <tr>
                                    <td>{{trans('admin.discount')}}</td>
                                    <td id="discount">{{number_format(0, $currency_info['currency_format'], '.', '').' '.$currency_info[$lang.'_currency']}}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>{{trans('admin.total')}}</td>
                                    <td id="total">{{number_format($total, $currency_info['currency_format'], '.', '').' '.$currency_info[$lang.'_currency']}}</td>
                                </tr>
                            </tfoot>
                        </table>
                        @if(Auth::Check())
                        <button type="submit" class="btn btn-default">{{trans('admin.checkout')}}</button>
                        @else
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#loginModal">{{trans('admin.checkout')}}</button>
                        @endif
                    </div>
                    <p class="text-center">{{trans('admin.fees_text')}}</p>
                </div>
            </div>
        </form>

        @if(Auth::check())
        <div class="modal fade" id="addAddressModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">{{trans('admin.address_add')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-wrapper">
                            <form>
                                <div class="form-group">
                                    {{ Form::select('country_id',$countries,null,['class'=>'form-control '.$p,'id'=>'country_id']) }}
                                </div>
                                <div class="form-group">
                                    <div id='cities'>
                                        {{ Form::select('city_id',[''=>trans('admin.city').'*'],null,['class'=>'form-control '.$p,'id'=>'city_id']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::text('address_name',null,['class'=>'form-control '.$p,'id'=>'address_name','placeholder'=>trans('admin.address_name').'*']) }}
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{ Form::text('code',null,['class'=>'custom-select '.$m,'id'=>'code','readonly','placeholder'=>trans('admin.code').'*','style'=>'background:none;']) }}
                                        </div>
                                        {{ Form::text('phone',null,['class'=>'form-control '.$p,'id'=>'phone','placeholder'=>trans('admin.phonee').'*']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::text('address_line_1',null,['class'=>'form-control '.$p,'id'=>'address_line_1','placeholder'=>trans('admin.address_line_1').'*']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::text('address_line_2',null,['class'=>'form-control '.$p,'id'=>'address_line_2','placeholder'=>trans('admin.address_line_2').'('.trans('admin.optional').')']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::text('postal_code',null,['class'=>'form-control '.$p,'id'=>'postal_code','placeholder'=>trans('admin.postal_code').'('.trans('admin.optional').')']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::textarea('notes',null,['class'=>'form-control '.$p,'id'=>'notes','placeholder'=>trans('admin.address_notes').'('.trans('admin.optional').')']) }}
                                </div>
                                <div id='address_result'></div>
                                <div class="text-center" id="address_button">
                                    <button type="button" id="address_btn" class="btn btn-lg btn-default mt-0">{{trans('admin.addd_address')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.invalid').hide();
        $('.valid').hide();
        $('#removeCode').hide();
        $("#showGift").change(function () {
            if (this.checked) {
                $('.gift-msg').show();
            } else {
                $('.gift-msg').hide();
            }
        });
    });

    $("body").on("change", "#country_id", function (e) {
        var country_id = $(this).val();
        var link = '<?php echo url('/'); ?>';
        if (country_id == "") {
            country_id = 0;
        }
        $.ajax({
            type: "GET",
            url: link + "/ajax_cities/" + country_id,
            success: function (data) {
                $('#cities').html(data);
            }
        });
        $.ajax({
            type: "GET",
            url: link + "/ajax_code/" + country_id,
            success: function (data) {
                $('#code').val(data);
            }
        });
    });

    $("body").on("click", "#address_btn", function (e) {
        $('#address_result').html('');
        $('#address_button').html('<div class="col-md-12 col-xl-12 text-center loading"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');
        var country_id = $('#country_id').val();
        var city_id = $('#city_id').val();
        var address_name = $('#address_name').val();
        var phone = $('#phone').val();
        var address_line_1 = $('#address_line_1').val();
        var address_line_2 = $('#address_line_2').val();
        var postal_code = $('#postal_code').val();
        var notes = $('#notes').val();
        var link = "<?php echo url('/') ?>";
        $.ajax({
            type: "GET",
            url: link + '/ajax_address_add/?country_id=' + country_id + '&city_id=' + city_id + '&address_name=' + address_name + '&phone=' + phone + '&address_line_1=' + address_line_1 + '&address_line_2=' + address_line_2 + '&postal_code=' + postal_code + '&notes=' + notes,
            success: function (datas) {
                if (datas.status == 1) {
                    $('#country_id').val('');
                    $('#city_id').val('');
                    $('#address_name').val('');
                    $('#code').val('');
                    $('#phone').val('');
                    $('#address_line_1').val('');
                    $('#address_line_2').val('');
                    $('#postal_code').val('');
                    $('#notes').val('');
                    $('.adresses').append('<div class="col-md-6"><div class="card"><div class="custom-control custom-radio mb-0"><input type="radio" id="address_' + datas.address.id + '" name="address_id" class="custom-control-input" value="' + datas.address.id + '" currency="' + datas.address.currency + '" current_currency="<?php echo $currency_info['id']; ?>"><label class="custom-control-label" for="address_' + datas.address.id + '">' + datas.address.content + '</label></div></div></div>')
                    $('.result_div').html('<i class="fas fa-check-circle"></i><h4><?php echo trans('admin.success'); ?>!</h4><p>' + datas.message + '</p>');
                    $('#addAddressModal').modal('hide');
                    $('#result_message').modal('show');
                    $('#address_button').html('<button type="button" class="btn btn-lg btn-default mt-0" id="address_btn"><?php echo trans('admin.addd_address'); ?></button>');
                } else {
                    $('#address_result').html('<div class="alert alert-danger">' + datas.message + '</div>');
                    $('#address_button').html('<button type="button" class="btn btn-lg btn-default mt-0" id="address_btn"><?php echo trans('admin.addd_address'); ?></button>');
                }
            }
        });
    });

    $("body").on('change', '.custom-control-input', function () {
        var address_id = $('input[name="address_id"]:checked').val();
        var link = "<?php echo url('/') ?>";
        $.ajax({
            type: "GET",
            url: link + '/ajax_address/' + address_id,
            success: function (datas) {
                if (datas.status == 0) {
                    $('.result_div').html('<i class="fas fa-exclamation-circle"></i><h4><?php echo trans('admin.error_region'); ?>!</h4><p>' + datas.message + '</p>');
                    $('#result_message').modal('show');
                    window.setTimeout(function () {
                        window.location.href = link + '/currency/' + datas.currency + "?address_id=" + address_id;
                    }, 2000);
                }
            }
        });
    });

    $('#applyCode').on('click', function () {
        var coupon = $('#coupon').val();
        var link = "<?php echo url('/') ?>";

        $.ajax({
            type: "GET",
            url: link + "/check_coupon?coupon=" + coupon,
            success: function (response) {
                if (response.status == 1) {
                    $('.invalid').hide();
                    $('.valid').show();
                    $('#applyCode').hide();
                    $('#removeCode').show();
                } else {
                    $('.valid').hide();
                    $('.invalid').show();
                    $('#removeCode').hide();
                    $('#applyCode').show();
                }

                $('#products_total').html(response.products_total);
                $('#discount').html(response.discount);
                $('#total').html(response.total);
            }
        });
        return false;
    });

    $('#removeCode').on('click', function () {
        $('#coupon').val('');
        var link = "<?php echo url('/') ?>";

        $.ajax({
            type: "GET",
            url: link + "/check_coupon?coupon=",
            success: function (response) {
                $('.valid').hide();
                $('.invalid').hide();
                $('#removeCode').hide();
                $('#applyCode').show();

                $('#products_total').html(response.products_total);
                $('#discount').html(response.discount);
                $('#total').html(response.total);
            }
        });
        return false;
    });
</script>

@if (Session::has('error'))
<script>
    $('.result_div').html('<i class="fas fa-exclamation-circle"></i><h4><?php echo trans('admin.error'); ?>!</h4><p><?php echo Session::get('error'); ?></p>');
    $('#result_message').modal('show');
</script>
@endif
@endsection

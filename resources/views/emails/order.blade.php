<?php
$lang = App::getLocale();
if ($lang == "en") {
    $font = "Arial";
    $dir = "ltr";
    $img_right = "right";
    $img_left = "left";
} else {
    $font = "Arial";
    $dir = "rtl";
    $img_right = "left";
    $img_left = "right";
}

$addons = $discount = $total = 0;
foreach ($order['Products'] as $product) {
    $addons = $addons + ($product['price'] * $product['quantity']);
}
if ($order['promo_code_type'] == 'fixed') {
    $discount = $order['promo_code_amount'];
} elseif ($order['promo_code_type'] == 'percent') {
    $discount = $order['total'] * $order['promo_code_amount'] / 100;
}
$total = $order['total'] - $discount;
?>

@extends('emails.layout')

@section('content')

<p style="text-align: center; line-height: 36px; font-weight: bold; font-size: 24px;">
    <?php echo trans('admin.orders_details_no') . ' : #AM' . $order['id']; ?>

</p>

<p style="text-align: center; line-height: 36px;">
    {{trans('admin.order_status')}} : {{trans('admin.order_'.$order['status'])}}
    <br>
    <?php echo $order['User']['first_name'] . ' ' . $order['User']['last_name']; ?>
    <br>
    <?php echo $order['User']['Country']['code'] . ' ' . $order['User']['phone']; ?>
</p>

<hr>

<p style="text-align: center; line-height: 36px; width: 100%; min-height: 20px;">
    <span style="width: 50%; float:<?php echo $img_left; ?>; text-align: <?php echo $img_left; ?>; ">
        <?php echo trans('admin.shipping_address'); ?>
    </span>
    <span style="width: 50%; float:<?php echo $img_right; ?>; text-align: <?php echo $img_right; ?>;">
        <?php echo trans('admin.payment_summary'); ?>        
    </span>
</p>

<p style="text-align: center; line-height: 28px; color: #000; border-radius: 5px;">
    <span style="width: 48%; float:<?php echo $img_left; ?>; text-align: <?php echo $img_left; ?>; padding: 5px;">
        {{$order['country_'.$lang]}}, {{$order['city_'.$lang]}} , <span dir='ltr'>{{$order['phone']}}</span><br>
        {{$order['address_line_1']}}, {{$order['address_line_2']}},  {{$order['postal_code']}}<br>
        {{$order['address_name']}}
    </span>
    <span style="width: 48%; float:<?php echo $img_right; ?>; text-align: <?php echo $img_right; ?>; padding: 5px;">
        <?php echo trans('admin.payment_id'); ?>
        <br>
        <?php echo $order['paymentId']; ?>      
        <br>
        <?php echo trans('admin.transaction_id'); ?>
        <br>
        <?php echo $order['transaction_id']; ?>      
        <br>
    </span>
</p>

<table style="width: 100%; text-align: center; border: 1px solid #000;">
    <tbody>
        @foreach($order['Products'] as $product)
        <tr style="border-bottom: 1px solid #000;">
            <td><img src="{{url('upload/products/'.$product['Product']['image'])}}" style="width:80px"></td> 
            <td>{{$product['Product'][$lang.'_name']}}</td>
            <td>{{$product['count']}}</td>
            <td>{{number_format($product['price']*$product['count'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p style="text-align: center; line-height: 28px; min-height: 35px;">
    <span style="width: 60%; float:<?php echo $img_right; ?>; text-align: <?php echo $img_right; ?>;">
        <span style="width: 45%; float:<?php echo $img_left; ?>; text-align: <?php echo $img_left; ?>; padding: 5px;">
            <?php echo trans('admin.products_total'); ?>        
            <br>
            <?php echo trans('admin.delivery_fee'); ?>
            <br>
            <?php echo trans('admin.fees'); ?>
            <br>
            <?php echo trans('admin.discount'); ?>    
            <br>
            <b><?php echo trans('admin.total'); ?></b> 
        </span>
        <span style="width: 48%; float:<?php echo $img_right; ?>; text-align: <?php echo $img_right; ?>; padding: 5px;">
            <?php echo number_format($order['total'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]; ?>      
            <br>
            <?php echo number_format($order['delivery'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]; ?> 
            <br>
            <?php echo number_format($order['fees'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]; ?> 
            <br>
            <?php echo number_format($order['promo_code_amount'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]; ?> 
            <br>
            <b><?php echo number_format($order['total'] + $order['delivery'] + $order['fees'] - $order['promo_code_amount'], $order['currency_format'], '.', '') . ' ' . $order['currency_' . $lang]; ?></b>
        </span>
    </span>
</p>
@endsection

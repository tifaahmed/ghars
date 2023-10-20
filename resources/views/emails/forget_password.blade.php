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
?>

@extends('emails.layout')

@section('content')

<p style="text-align: center; line-height: 36px; font-weight: bold; font-size: 24px;">
    <?php echo trans('api.reset_password_1'); ?>
</p>

<p style="text-align: center; line-height: 36px;">
    <?php echo trans('api.reset_password_2'); ?>
</p>

<p style="text-align: center; line-height: 36px; width: 100px; margin: 0 auto; color: #000; background: #ffcc50; border-radius: 5px;">
    <?php echo $password ?>
</p>

@endsection

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

<p style="text-align: center; line-height: 36px;">
    <?php echo trans('api.verify_mail_1'); ?>
    <br>
    <?php echo trans('api.verify_mail_2'); ?>
</p>

<p style="text-align: center; line-height: 36px; font-weight: bold; font-size: 26px;">
    <?php echo $user['code']; ?>
</p>

<p style="text-align: center; line-height: 36px;">
    <?php echo trans('api.verify_mail_3'); ?>
</p>

<p style="text-align: center; line-height: 36px;">
    <?php echo trans('api.verify_mail_4'); ?>
</p>

@endsection

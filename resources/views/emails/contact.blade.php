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
    <?php echo trans('admin.contact_message'); ?>
</p>

<p style="text-align: center; line-height: 36px;">
    <strong><?php echo trans('admin.name'); ?> : </strong> <?php echo $name; ?>
</p>

<p style="text-align: center; line-height: 36px;">
    <strong><?php echo trans('admin.email'); ?> : </strong> <?php echo $email; ?>
</p>

<p style="text-align: center; line-height: 36px;">
    <strong><?php echo trans('admin.phone'); ?> : </strong> <?php echo $phone; ?>
</p>

<p style="text-align: center; line-height: 36px;">
    <strong><?php echo trans('admin.message'); ?> : </strong> <?php echo $messagee; ?>
</p>

@endsection

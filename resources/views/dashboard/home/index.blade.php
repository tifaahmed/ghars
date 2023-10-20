@extends('dashboard.layouts.index')

@section('content')
<?php
$lang = App::getLocale();
$text = "text-left";
$pull = "pull-left";
$pulll = "pull-right";
if ($lang == "ar") {
    $text = "text-right";
    $pull = "pull-right";
    $pulll = "pull-left";
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{trans('admin.admin')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{URL::to('dashboard')}}"><i class="fa fa-home"></i> {{trans('admin.home')}}</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        @if (Session::has('message'))
        <div class="col-lg-12 col-xl-12">
            <div class="alert alert-success alert-dismissible">
                {{ Session::get('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            </div>
        </div>
        @endif

        <div class="col-lg-12 col-xl-12">
            
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

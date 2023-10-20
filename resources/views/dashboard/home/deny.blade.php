@extends('dashboard.layouts.index')

@section('content')
<?php
$lang = App::getLocale();
$text = "text-left";
$pull = "pull-left";
if ($lang == "ar") {
    $text = "text-right";
    $pull = "pull-right";
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
        <div class="col-lg-12 col-xl-12">
            <div class="box box-info">
                <div class="box-body">
                    <br>
                    <div class="alert alert-danger">
                        {{trans('admin.not_allow')}}
                    </div>
                </div>
            </div>
        </div>

    </div>


</section>
<!-- /.content -->

@endsection


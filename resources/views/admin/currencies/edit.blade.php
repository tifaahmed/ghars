@extends('admin.layouts.form')

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
        {{trans('admin.currencies')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/currencies')}}"> {{trans('admin.currencies')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.currency_edit')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.currency_edit')}} : {{$currency[$lang.'_currency']}} ({{$currency[$lang.'_name']}})</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/currencies/'.$currency['id'])}}" method="post" enctype="multipart/form-data">
            {{ Form::hidden('_method','PATCH') }}
            {{ csrf_field() }}

            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        @if (Session::has('message'))
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-success alert-dismissible">
                                    {{ Session::get('message')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="equal" class="col-sm-3 col-form-label">{{trans('admin.equal')}}</label>
                            <div class="col-sm-8">
                                {{ Form::text('equal', $currency['equal'], ['class'=>'form-control price','id'=>'equal']) }}
                                @if($errors->has('equal'))
                                <div class="alert alert-danger">{{$errors->first('equal')}}</div>
                                @endif
                            </div>
                            <label class="col-sm-1 col-form-label">{{trans('admin.kwd')}}</label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">{{trans('admin.save')}}</button>
                <a href="{{URL::to('admin/currencies')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>

@endsection

@section('scripts')
<script>
    $('.price').each(function (i, obj) {
        var value = $(this).val();
        if (isNaN(value)) {
            $(this).val('');
        } else if (!value) {
            // no value
            return;
        } else {
            // cast to 3 decimal places (KWD)
            value = parseFloat(value).toFixed(3);
            // update field value
            $(this).val(value);
        }
    });

    $(document).on('blur', '.price', function () {
        // get value - reject if the value is a character
        var value = $(this).val();
        if (isNaN(value)) {
            $(this).val('');
        } else if (!value) {
            // no value
            return;
        } else {
            // cast to 3 decimal places (KWD)
            value = parseFloat(value).toFixed(3);
            // update field value
            $(this).val(value);
        }
    });
</script>
@endsection
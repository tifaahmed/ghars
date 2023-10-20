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
        {{trans('admin.countries')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/countries')}}"> {{trans('admin.countries')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.country_edit')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.country_edit')}} : {{$country[$lang.'_name']}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/countries/'.$country['id'])}}" method="post" enctype="multipart/form-data">
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
                            <label for="iso" class="col-sm-3 col-form-label">ISO</label>
                            <div class="col-sm-9">
                                {{ Form::text('iso', $country['iso'], ['class'=>'form-control','id'=>'iso','readonly']) }}
                                @if($errors->has('iso'))
                                <div class="alert alert-danger">{{$errors->first('iso')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="active" class="col-sm-3 col-form-label">{{trans('admin.country_active')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('active', ['yes'=>trans('admin.yes_active') , 'no'=>trans('admin.no_active')],$country['active'], ['class'=>'form-control select2','id'=>'active']) }}
                                @if($errors->has('active'))
                                <div class="alert alert-danger">{{$errors->first('active')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-3 col-form-label">{{trans('admin.country_name_ar')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('ar_name', $country['ar_name'], ['class'=>'form-control','id'=>'ar_name']) }}
                                @if($errors->has('ar_name'))
                                <div class="alert alert-danger">{{$errors->first('ar_name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-3 col-form-label">{{trans('admin.country_name_en')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('en_name', $country['en_name'], ['class'=>'form-control','id'=>'en_name']) }}
                                @if($errors->has('en_name'))
                                <div class="alert alert-danger">{{$errors->first('en_name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="code" class="col-sm-3 col-form-label">{{trans('admin.country_code')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('code', $country['code'], ['class'=>'form-control '.$text,'id'=>'code','style'=>'direction:ltr;']) }}
                                @if($errors->has('code'))
                                <div class="alert alert-danger">{{$errors->first('code')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_address" class="col-sm-3 col-form-label">{{trans('admin.address_work_ar')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('ar_address', $country['ar_address'], ['class'=>'form-control','id'=>'ar_address']) }}
                                @if($errors->has('ar_address'))
                                <div class="alert alert-danger">{{$errors->first('ar_address')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_address" class="col-sm-3 col-form-label">{{trans('admin.address_work_en')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('en_address', $country['en_address'], ['class'=>'form-control','id'=>'en_address']) }}
                                @if($errors->has('en_address'))
                                <div class="alert alert-danger">{{$errors->first('en_address')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="headquarter_1" class="col-sm-3 col-form-label">{{trans('admin.headquarter_1')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('headquarter_1', $country['headquarter_1'], ['class'=>'form-control','id'=>'headquarter_1']) }}
                                @if($errors->has('headquarter_1'))
                                <div class="alert alert-danger">{{$errors->first('headquarter_1')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="headquarter_2" class="col-sm-3 col-form-label">{{trans('admin.headquarter_2')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('headquarter_2', $country['headquarter_2'], ['class'=>'form-control','id'=>'headquarter_2']) }}
                                @if($errors->has('headquarter_2'))
                                <div class="alert alert-danger">{{$errors->first('headquarter_2')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delegate_1" class="col-sm-3 col-form-label">{{trans('admin.delegate_1')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('delegate_1', $country['delegate_1'], ['class'=>'form-control','id'=>'delegate_1']) }}
                                @if($errors->has('delegate_1'))
                                <div class="alert alert-danger">{{$errors->first('delegate_1')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delegate_2" class="col-sm-3 col-form-label">{{trans('admin.delegate_2')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('delegate_2', $country['delegate_2'], ['class'=>'form-control','id'=>'delegate_2']) }}
                                @if($errors->has('delegate_2'))
                                <div class="alert alert-danger">{{$errors->first('delegate_2')}}</div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">{{trans('admin.save')}}</button>
                <a href="{{URL::to('admin/countries')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>

@endsection
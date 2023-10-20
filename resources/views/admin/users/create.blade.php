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
        {{trans('admin.users')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/users')}}"> {{trans('admin.users')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.user_add')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.user_add')}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/users/')}}" method="post" enctype="multipart/form-data">
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
                            <label for="name" class="col-sm-3 col-form-label">{{trans('admin.name')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('name', null, ['class'=>'form-control','id'=>'name']) }}
                                @if($errors->has('name'))
                                <div class="alert alert-danger">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">{{trans('admin.email')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('email', null, ['class'=>'form-control','id'=>'email']) }}
                                @if($errors->has('email'))
                                <div class="alert alert-danger">{{$errors->first('email')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">{{trans('admin.password')}}</label>
                            <div class="col-sm-9">
                                {{ Form::input('password','password', null, ['class'=>'form-control','id'=>'password']) }}
                                @if($errors->has('password'))
                                <div class="alert alert-danger">{{$errors->first('password')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country_id" class="col-sm-3 col-form-label">{{trans('admin.country')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('country_id',$countries, null, ['class'=>'form-control select2','id'=>'country_id']) }}
                                @if($errors->has('country_id'))
                                <div class="alert alert-danger">{{$errors->first('country_id')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label">{{trans('admin.phone')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('phone', null, ['class'=>'form-control','id'=>'phone']) }}
                                @if($errors->has('phone'))
                                <div class="alert alert-danger">{{$errors->first('phone')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="whatsapp" class="col-sm-3 col-form-label">{{trans('admin.whatsapp')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('whatsapp', null, ['class'=>'form-control','id'=>'whatsapp']) }}
                                @if($errors->has('whatsapp'))
                                <div class="alert alert-danger">{{$errors->first('whatsapp')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="governate" class="col-sm-3 col-form-label">{{trans('admin.governate')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('governate', null, ['class'=>'form-control','id'=>'governate']) }}
                                @if($errors->has('governate'))
                                <div class="alert alert-danger">{{$errors->first('governate')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-sm-3 col-form-label">{{trans('admin.city')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('city', null, ['class'=>'form-control','id'=>'city']) }}
                                @if($errors->has('city'))
                                <div class="alert alert-danger">{{$errors->first('city')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-sm-3 col-form-label">{{trans('admin.street')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('street', null, ['class'=>'form-control','id'=>'street']) }}
                                @if($errors->has('street'))
                                <div class="alert alert-danger">{{$errors->first('street')}}</div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">{{trans('admin.add')}}</button>
                <a href="{{URL::to('admin/users')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>

@endsection
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
        {{trans('admin.gifts')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/gifts')}}"> {{trans('admin.gifts')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.gift_edit')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.gift_edit')}} : {{$gift[$lang.'_name']}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/gifts/'.$gift['id'])}}" method="post" enctype="multipart/form-data">
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
                            <label for="active" class="col-sm-3 col-form-label">{{trans('admin.gift_active')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('active', ['yes'=>trans('admin.yes_active') , 'no'=>trans('admin.no_active')],$gift['active'], ['class'=>'form-control select2','id'=>'active']) }}
                                @if($errors->has('active'))
                                <div class="alert alert-danger">{{$errors->first('active')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-sm-3 col-form-label">{{trans('admin.type')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('type', ['childern'=>trans('admin.childern') , 'families'=>trans('admin.families') , 'teachers'=>trans('admin.teachers')], $gift['type'], ['class'=>'form-control select2','id'=>'type']) }}
                                @if($errors->has('type'))
                                <div class="alert alert-danger">{{$errors->first('type')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sort" class="col-sm-3 col-form-label">{{trans('admin.sort')}}</label>
                            <div class="col-sm-9">
                                {{ Form::number('sort', $gift['sort'], ['class'=>'form-control','id'=>'sort']) }}
                                @if($errors->has('sort'))
                                <div class="alert alert-danger">{{$errors->first('sort')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-3 col-form-label">{{trans('admin.gift_name_ar')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('ar_name', $gift['ar_name'], ['class'=>'form-control','id'=>'ar_name']) }}
                                @if($errors->has('ar_name'))
                                <div class="alert alert-danger">{{$errors->first('ar_name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-3 col-form-label">{{trans('admin.gift_name_en')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('en_name', $gift['en_name'], ['class'=>'form-control','id'=>'en_name']) }}
                                @if($errors->has('en_name'))
                                <div class="alert alert-danger">{{$errors->first('en_name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-sm-3 col-form-label">{{trans('admin.amount')}}</label>
                            <div class="col-sm-8">
                                {{ Form::text('amount', $gift['amount'], ['class'=>'form-control','id'=>'amount']) }}
                                @if($errors->has('amount'))
                                <div class="alert alert-danger">{{$errors->first('amount')}}</div>
                                @endif
                            </div>
                            <label class="col-sm-1 col-form-label">{{trans('admin.kwd')}}</label>
                        </div> 

                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label image">{{trans('admin.image')}} <span dir="ltr">(Width: 500px * Height:500px)</span></label>
                            <div class="col-sm-9">
                                {{ Form::file('image',['class'=>'form-control','id'=>'image']) }}
                                @if($errors->has('image'))
                                <div class="alert alert-danger">{{$errors->first('image')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input_4" class="col-sm-3 col-form-label image_current_ar">{{trans('admin.image_current')}}</label>
                            <div class="col-sm-9">
                                <img src="{{URL::to('upload/gifts/'.$gift['image'])}}" class="img-thumbnail image_current">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">{{trans('admin.save')}}</button>
                <a href="{{URL::to('admin/gifts')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>

@endsection
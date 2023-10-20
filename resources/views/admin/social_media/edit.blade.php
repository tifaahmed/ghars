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
        {{trans('admin.social_media')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/social_media')}}"> {{trans('admin.social_media')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.social_media_edit')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.social_media_edit')}} : {{$social_media['link']}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/social_media/'.$social_media['id'])}}" method="post" enctype="multipart/form-data">
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
                            <label for="type" class="col-sm-2 col-form-label">{{trans('admin.type')}}</label>
                            <div class="col-sm-10">
                                {{ Form::hidden('type',$social_media['type']) }}
                                {{ Form::text('typee',trans('admin.'.$social_media['type']), ['class'=>'form-control','id'=>'type','readonly']) }}
                                @if($errors->has('type'))
                                <div class="alert alert-danger">{{$errors->first('type')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link" class="col-sm-2 col-form-label">{{trans('admin.link')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('link', $social_media['link'], ['class'=>'form-control','id'=>'link']) }}
                                @if($errors->has('link'))
                                <div class="alert alert-danger">{{$errors->first('link')}}</div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">{{trans('admin.save')}}</button>
                <a href="{{URL::to('admin/social_media')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>

@endsection
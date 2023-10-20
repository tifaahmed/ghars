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
        {{trans('admin.site')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.site_edit')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.site_edit')}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/site/1')}}" method="post" enctype="multipart/form-data">
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
                            <label for="ar_title" class="col-sm-2 col-form-label">{{trans('admin.site_title_ar')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('ar_title',  $site['ar_title'], ['class'=>'form-control','id'=>'ar_title']) }}
                                @if($errors->has('ar_title'))
                                <div class="alert alert-danger">{{$errors->first('ar_title')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_title" class="col-sm-2 col-form-label">{{trans('admin.site_title_en')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('en_title',  $site['en_title'], ['class'=>'form-control','id'=>'en_title']) }}
                                @if($errors->has('en_title'))
                                <div class="alert alert-danger">{{$errors->first('en_title')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_desc" class="col-sm-2 col-form-label">{{trans('admin.site_desc_ar')}}</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('ar_desc',  $site['ar_desc'], ['class'=>'form-control','id'=>'ar_desc','rows'=>3]) }}
                                @if($errors->has('ar_desc'))
                                <div class="alert alert-danger">{{$errors->first('ar_desc')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_desc" class="col-sm-2 col-form-label">{{trans('admin.site_desc_en')}}</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('en_desc',  $site['en_desc'], ['class'=>'form-control','id'=>'en_desc','rows'=>3]) }}
                                @if($errors->has('en_desc'))
                                <div class="alert alert-danger">{{$errors->first('en_desc')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tags" class="col-sm-2 col-form-label">{{trans('admin.site_tags')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('tags',  $site['tags'], ['class'=>'form-control','id'=>'tags']) }}
                                @if($errors->has('tags'))
                                <div class="alert alert-danger">{{$errors->first('tags')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="whatsapp" class="col-sm-2 col-form-label">{{trans('admin.whatsapp')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('whatsapp',  $site['whatsapp'], ['class'=>'form-control','id'=>'whatsapp']) }}
                                @if($errors->has('whatsapp'))
                                <div class="alert alert-danger">{{$errors->first('whatsapp')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">{{trans('admin.phone')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('phone',  $site['phone'], ['class'=>'form-control','id'=>'phone']) }}
                                @if($errors->has('phone'))
                                <div class="alert alert-danger">{{$errors->first('phone')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">{{trans('admin.email')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('email',  $site['email'], ['class'=>'form-control','id'=>'email']) }}
                                @if($errors->has('email'))
                                <div class="alert alert-danger">{{$errors->first('email')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="map" class="col-sm-2 col-form-label">{{trans('admin.map')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('map',  $site['map'], ['class'=>'form-control','id'=>'map']) }}
                                @if($errors->has('map'))
                                <div class="alert alert-danger">{{$errors->first('map')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ios" class="col-sm-2 col-form-label">{{trans('admin.ios')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('ios',  $site['ios'], ['class'=>'form-control','id'=>'ios']) }}
                                @if($errors->has('ios'))
                                <div class="alert alert-danger">{{$errors->first('ios')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="android" class="col-sm-2 col-form-label">{{trans('admin.android')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('android',  $site['android'], ['class'=>'form-control','id'=>'android']) }}
                                @if($errors->has('android'))
                                <div class="alert alert-danger">{{$errors->first('android')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="childern" class="col-sm-2 col-form-label image">{{trans('admin.childern')}} <span dir="ltr">(Width: 500px * Height:500px)</span></label>
                            <div class="col-sm-10">
                                {{ Form::file('childern',['class'=>'form-control','id'=>'childern']) }}
                                @if($errors->has('childern'))
                                <div class="alert alert-danger">{{$errors->first('childern')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input_4" class="col-sm-2 col-form-label image_current_ar">{{trans('admin.image_current')}}</label>
                            <div class="col-sm-10">
                                <img src="{{URL::to('upload/site/'.$site['childern'])}}" class="img-thumbnail image_current">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="families" class="col-sm-2 col-form-label image">{{trans('admin.families')}} <span dir="ltr">(Width: 500px * Height:500px)</span></label>
                            <div class="col-sm-10">
                                {{ Form::file('families',['class'=>'form-control','id'=>'families']) }}
                                @if($errors->has('families'))
                                <div class="alert alert-danger">{{$errors->first('families')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input_4" class="col-sm-2 col-form-label image_current_ar">{{trans('admin.image_current')}}</label>
                            <div class="col-sm-10">
                                <img src="{{URL::to('upload/site/'.$site['families'])}}" class="img-thumbnail image_current">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="teachers" class="col-sm-2 col-form-label image">{{trans('admin.teachers')}} <span dir="ltr">(Width: 500px * Height:500px)</span></label>
                            <div class="col-sm-10">
                                {{ Form::file('teachers',['class'=>'form-control','id'=>'teachers']) }}
                                @if($errors->has('teachers'))
                                <div class="alert alert-danger">{{$errors->first('teachers')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input_4" class="col-sm-2 col-form-label image_current_ar">{{trans('admin.image_current')}}</label>
                            <div class="col-sm-10">
                                <img src="{{URL::to('upload/site/'.$site['teachers'])}}" class="img-thumbnail image_current">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">{{trans('admin.save')}}</button>
                <a href="{{URL::to('admin')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>

@endsection
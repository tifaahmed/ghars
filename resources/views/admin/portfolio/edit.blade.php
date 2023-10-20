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
        {{trans('admin.portfolio')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/portfolio')}}"> {{trans('admin.portfolio')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.portfolio_edit')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.portfolio_edit')}} : {{$portfolio[$lang.'_name']}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/portfolio/'.$portfolio->id)}}" method="post" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
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
                            <label for="active" class="col-sm-4 col-form-label">{{trans('admin.active')}}</label>
                            <div class="col-sm-8">
                                {{ Form::select('active',['yet'=>trans('admin.approve_yet'),'yes'=>trans('admin.approve_yes'),'no'=>trans('admin.approve_no')], $portfolio['active'], ['class'=>'form-control select2','id'=>'active']) }}
                                @if($errors->has('active'))
                                <div class="alert alert-danger">{{$errors->first('active')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_id" class="col-sm-4 col-form-label">{{trans('admin.company')}}</label>
                            <div class="col-sm-8">
                                {{ Form::select('user_id',$companies, $portfolio['user_id'], ['class'=>'form-control select2','id'=>'user_id']) }}
                                @if($errors->has('user_id'))
                                <div class="alert alert-danger">{{$errors->first('user_id')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-4 col-form-label">{{trans('admin.portfolio_name_ar')}}</label>
                            <div class="col-sm-8">
                                {{ Form::text('ar_name', $portfolio['ar_name'], ['class'=>'form-control','id'=>'ar_name']) }}
                                @if($errors->has('ar_name'))
                                <div class="alert alert-danger">{{$errors->first('ar_name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-4 col-form-label">{{trans('admin.portfolio_name_en')}}</label>
                            <div class="col-sm-8">
                                {{ Form::text('en_name', $portfolio['en_name'], ['class'=>'form-control','id'=>'en_name']) }}
                                @if($errors->has('en_name'))
                                <div class="alert alert-danger">{{$errors->first('en_name')}}</div>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="editor1" class="col-sm-4 col-form-label">{{trans('admin.portfolio_desc_ar')}}</label>
                            <div class="col-sm-8">
                                {{ Form::textarea('ar_desc', $portfolio['ar_desc'], ['class'=>'form-control','id'=>'editor1','rows'=>10]) }}
                                @if($errors->has('ar_desc'))
                                <div class="alert alert-danger">{{$errors->first('ar_desc')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="editor2" class="col-sm-4 col-form-label">{{trans('admin.portfolio_desc_en')}}</label>
                            <div class="col-sm-8">
                                {{ Form::textarea('en_desc', $portfolio['en_desc'], ['class'=>'form-control','id'=>'editor2','rows'=>10]) }}
                                @if($errors->has('en_desc'))
                                <div class="alert alert-danger">{{$errors->first('en_desc')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-4 col-form-label image">{{trans('admin.image')}}<span dir="ltr">(Width: 500px * Height:500px)</span></label>
                            <div class="col-sm-8">
                                {{ Form::file('image',['class'=>'form-control','id'=>'image']) }}
                                @if($errors->has('image'))
                                <div class="alert alert-danger">{{$errors->first('image')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input_4" class="col-sm-4 col-form-label image_current_ar">{{trans('admin.image_current')}}</label>
                            <div class="col-sm-8">
                                <img src="{{URL::to('upload/portfolio/'.$portfolio['image'])}}" class="img-thumbnail image_current">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="images" class="col-sm-4 col-form-label">{{trans('admin.images')}}<span dir="ltr">(Width: 500px * Height:500px)</span></label>
                            <div class="col-sm-8">
                                {{ Form::file('images[]',['class'=>'form-control','id'=>'images','multiple']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image_current" class="col-sm-4 col-form-label">{{trans('admin.images_current')}}</label>
                            <div class="col-sm-8">
                                @foreach($portfolio['Images'] as $image)
                                <div class='col-md-4 {{$pull}}'>
                                    <img src="{{URL::to('upload/portfolio/'.$image['image'])}}" class="img-thumbnail" style="width:100%; height: 150px;">
                                    <a href="{{URL::to('admin/delete_portfolio_image/'.$image['id'])}}" class="btn btn-block btn-danger"><span class="fa fa-trash-o"></span> {{trans('admin.delete')}}</a>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">{{trans('admin.save')}}</button>
                <a href="{{URL::to('admin/portfolio')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>
@endsection

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
        {{trans('admin.steps').' : '.$category_step[$lang.'_name']}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/categories')}}"> {{trans('admin.categories')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/categories_steps/'.$category_step['category_id'])}}"> {{trans('admin.steps')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.step_edit')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.step_edit')}} : {{$category_step[$lang.'_name']}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/categories_steps/'.$category_step['id'])}}" method="post" enctype="multipart/form-data">
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
                            <label for="active" class="col-sm-2 col-form-label">{{trans('admin.active')}}</label>
                            <div class="col-sm-10">
                                {{ Form::select('active',['yes'=>trans('admin.approve_yes'),'no'=>trans('admin.approve_no')], $category_step['active'], ['class'=>'form-control select2','id'=>'active']) }}
                                @if($errors->has('active'))
                                <div class="alert alert-danger">{{$errors->first('active')}}</div>
                                @endif
                            </div>
                        </div>
                                                

                        <div class="form-group row">
                            <label for="sort" class="col-sm-2 col-form-label">{{trans('admin.sort')}}</label>
                            <div class="col-sm-10">
                                {{ Form::number('sort', $category_step['sort'], ['class'=>'form-control','id'=>'sort']) }}
                                @if($errors->has('sort'))
                                <div class="alert alert-danger">{{$errors->first('sort')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-2 col-form-label">{{trans('admin.step_name_ar')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('ar_name', $category_step['ar_name'], ['class'=>'form-control','id'=>'ar_name']) }}
                                @if($errors->has('ar_name'))
                                <div class="alert alert-danger">{{$errors->first('ar_name')}}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="en_name" class="col-sm-2 col-form-label">{{trans('admin.step_name_en')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('en_name', $category_step['en_name'], ['class'=>'form-control','id'=>'en_name']) }}
                                @if($errors->has('en_name'))
                                <div class="alert alert-danger">{{$errors->first('en_name')}}</div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">{{trans('admin.save')}}</button>
                <a href="{{URL::to('admin/categories_steps/'.$category_step['category_id'])}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>
@endsection
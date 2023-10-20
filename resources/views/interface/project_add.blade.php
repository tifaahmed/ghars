<?php
$lang = App::getLocale();
?>
@extends('interface.layout')

@section('title')
{{trans('admin.project_add')}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{trans('admin.project_add')}}</h3>
    </div>
</section>

<!--start contact section-->
<section class="contact_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row">
            <div class="col-12 col-lg-12">
                <form class="contact__form" action="{{url('project_add')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form__row">
                        <div class="col-12 col-lg-6">
                            <label class="login__label">{{trans('admin.country')}}</label>
                            {{ Form::select('country_id',$countries, null, ['class'=>'loginV__input','id'=>'country_id']) }}
                            @if($errors->has('country_id'))
                            <div class="alert alert-danger">{{$errors->first('country_id')}}</div>
                            @endif
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="login__label">{{trans('admin.category')}}</label>
                            {{ Form::select('category_id',$categories, null, ['class'=>'loginV__input','id'=>'category_id']) }}
                            @if($errors->has('category_id'))
                            <div class="alert alert-danger">{{$errors->first('category_id')}}</div>
                            @endif
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="login__label">{{trans('admin.project_name')}}</label>
                            {{ Form::text('name', null, ['class'=>'loginV__input','id'=>'name']) }}
                            @if($errors->has('name'))
                            <div class="alert alert-danger">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="login__label">{{trans('admin.total')}} ({{$currency_info[$lang.'_currency']}})</label>
                            {{ Form::number('amount', null, ['class'=>'loginV__input','id'=>'amount']) }}
                            @if($errors->has('amount'))
                            <div class="alert alert-danger">{{$errors->first('amount')}}</div>
                            @endif
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="login__label">{{trans('admin.collect')}} ({{$currency_info[$lang.'_currency']}})</label>
                            {{ Form::number('collect', null, ['class'=>'loginV__input','id'=>'collect']) }}
                            @if($errors->has('collect'))
                            <div class="alert alert-danger">{{$errors->first('collect')}}</div>
                            @endif
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="login__label">{{trans('admin.image')}}</label>
                            {{ Form::file('image', ['class'=>'loginV__input','id'=>'image']) }}
                            @if($errors->has('image'))
                            <div class="alert alert-danger">{{$errors->first('image')}}</div>
                            @endif
                        </div>
                        <div class="col-12 col-lg-12">
                            <label class="login__label">{{trans('admin.project_desc')}}</label>
                            {{ Form::textarea('desc', null, ['class'=>'loginV__input','id'=>'desc']) }}
                            @if($errors->has('desc'))
                            <div class="alert alert-danger">{{$errors->first('desc')}}</div>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="contSubmit__btn">{{trans('admin.add')}}</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

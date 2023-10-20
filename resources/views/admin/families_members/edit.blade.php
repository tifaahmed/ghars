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
        {{trans('admin.members').' : '.$family_member[$lang.'_name']}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/families')}}"> {{trans('admin.families')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/families_members/'.$family_member['family_id'])}}"> {{trans('admin.members')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.family_member_edit')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.family_member_edit')}} : {{$family_member[$lang.'_name']}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/families_members/'.$family_member['id'])}}" method="post" enctype="multipart/form-data">
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
                                {{ Form::select('active',['yes'=>trans('admin.approve_yes'),'no'=>trans('admin.approve_no')], $family_member['active'], ['class'=>'form-control select2','id'=>'active']) }}
                                @if($errors->has('active'))
                                <div class="alert alert-danger">{{$errors->first('active')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-sm-2 col-form-label">{{trans('admin.gender')}}</label>
                            <div class="col-sm-10">
                                {{ Form::select('gender',['male'=>trans('admin.male'),'female'=>trans('admin.female')], $family_member['gender'], ['class'=>'form-control select2','id'=>'gender']) }}
                                @if($errors->has('gender'))
                                <div class="alert alert-danger">{{$errors->first('gender')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-sm-2 col-form-label">{{trans('admin.birth_date')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('birth_date', $family_member['birth_date'], ['class'=>'form-control','id'=>'birth_date']) }}
                                @if($errors->has('birth_date'))
                                <div class="alert alert-danger">{{$errors->first('birth_date')}}</div>
                                @endif
                            </div>
                            <label for="civil_id" class="col-sm-2 col-form-label">{{trans('admin.civil_id')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('civil_id', $family_member['civil_id'], ['class'=>'form-control','id'=>'civil_id']) }}
                                @if($errors->has('civil_id'))
                                <div class="alert alert-danger">{{$errors->first('civil_id')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-2 col-form-label">{{trans('admin.family_name_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_name', $family_member['ar_name'], ['class'=>'form-control','id'=>'ar_name']) }}
                                @if($errors->has('ar_name'))
                                <div class="alert alert-danger">{{$errors->first('ar_name')}}</div>
                                @endif
                            </div>
                            <label for="en_name" class="col-sm-2 col-form-label">{{trans('admin.family_name_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_name', $family_member['en_name'], ['class'=>'form-control','id'=>'en_name']) }}
                                @if($errors->has('en_name'))
                                <div class="alert alert-danger">{{$errors->first('en_name')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_civil_type" class="col-sm-2 col-form-label">{{trans('admin.civil_type_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_civil_type', $family_member['ar_civil_type'], ['class'=>'form-control','id'=>'ar_civil_type']) }}
                                @if($errors->has('ar_civil_type'))
                                <div class="alert alert-danger">{{$errors->first('ar_civil_type')}}</div>
                                @endif
                            </div>
                            <label for="en_civil_type" class="col-sm-2 col-form-label">{{trans('admin.civil_type_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_civil_type', $family_member['en_civil_type'], ['class'=>'form-control','id'=>'en_civil_type']) }}
                                @if($errors->has('en_civil_type'))
                                <div class="alert alert-danger">{{$errors->first('en_civil_type')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_career_status" class="col-sm-2 col-form-label">{{trans('admin.career_status_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::textarea('ar_career_status', $family_member['ar_career_status'], ['class'=>'form-control','id'=>'ar_career_status']) }}
                                @if($errors->has('ar_career_status'))
                                <div class="alert alert-danger">{{$errors->first('ar_career_status')}}</div>
                                @endif
                            </div>
                            <label for="en_career_status" class="col-sm-2 col-form-label">{{trans('admin.career_status_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::textarea('en_career_status', $family_member['en_career_status'], ['class'=>'form-control','id'=>'en_career_status']) }}
                                @if($errors->has('en_career_status'))
                                <div class="alert alert-danger">{{$errors->first('en_career_status')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_class" class="col-sm-2 col-form-label">{{trans('admin.class_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_class', $family_member['ar_class'], ['class'=>'form-control','id'=>'ar_class']) }}
                                @if($errors->has('ar_class'))
                                <div class="alert alert-danger">{{$errors->first('ar_class')}}</div>
                                @endif
                            </div>
                            <label for="en_class" class="col-sm-2 col-form-label">{{trans('admin.class_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_class', $family_member['en_class'], ['class'=>'form-control','id'=>'en_class']) }}
                                @if($errors->has('en_class'))
                                <div class="alert alert-danger">{{$errors->first('en_class')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_psychological" class="col-sm-2 col-form-label">{{trans('admin.psychological_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_psychological', $family_member['ar_psychological'], ['class'=>'form-control','id'=>'ar_psychological']) }}
                                @if($errors->has('ar_psychological'))
                                <div class="alert alert-danger">{{$errors->first('ar_psychological')}}</div>
                                @endif
                            </div>
                            <label for="en_psychological" class="col-sm-2 col-form-label">{{trans('admin.psychological_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_psychological', $family_member['en_psychological'], ['class'=>'form-control','id'=>'en_psychological']) }}
                                @if($errors->has('en_psychological'))
                                <div class="alert alert-danger">{{$errors->first('en_psychological')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_healthy" class="col-sm-2 col-form-label">{{trans('admin.healthy_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_healthy', $family_member['ar_healthy'], ['class'=>'form-control','id'=>'ar_healthy']) }}
                                @if($errors->has('ar_healthy'))
                                <div class="alert alert-danger">{{$errors->first('ar_healthy')}}</div>
                                @endif
                            </div>
                            <label for="en_healthy" class="col-sm-2 col-form-label">{{trans('admin.healthy_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_healthy', $family_member['en_healthy'], ['class'=>'form-control','id'=>'en_healthy']) }}
                                @if($errors->has('en_healthy'))
                                <div class="alert alert-danger">{{$errors->first('en_healthy')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label image">{{trans('admin.image')}}<span dir="ltr">(Width: 500px * Height:500px)</span></label>
                            <div class="col-sm-10">
                                {{ Form::file('image',['class'=>'form-control','id'=>'image']) }}
                                @if($errors->has('image'))
                                <div class="alert alert-danger">{{$errors->first('image')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input_4" class="col-sm-2 col-form-label image_current_ar">{{trans('admin.image_current')}}</label>
                            <div class="col-sm-10">
                                <img src="{{URL::to('upload/families_members/'.$family_member['image'])}}" class="img-thumbnail image_current">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">{{trans('admin.save')}}</button>
                <a href="{{URL::to('admin/families_members/'.$family_member['family_id'])}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>

@endsection

@section('scripts')
<script>
    //Date picker
    $('#birth_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
</script>
@endsection

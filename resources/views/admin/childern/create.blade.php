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
        {{trans('admin.childern')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/childern')}}"> {{trans('admin.childern')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.child_add')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.child_add')}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/childern/')}}" method="post" enctype="multipart/form-data">
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
                                {{ Form::select('active',['yes'=>trans('admin.approve_yes'),'no'=>trans('admin.approve_no')], null, ['class'=>'form-control select2','id'=>'active']) }}
                                @if($errors->has('active'))
                                <div class="alert alert-danger">{{$errors->first('active')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country_id" class="col-sm-2 col-form-label">{{trans('admin.country')}}</label>
                            <div class="col-sm-10">
                                {{ Form::select('country_id',$countries, null, ['class'=>'form-control select2','id'=>'country_id']) }}
                                @if($errors->has('country_id'))
                                <div class="alert alert-danger">{{$errors->first('country_id')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-sm-2 col-form-label">{{trans('admin.gender')}}</label>
                            <div class="col-sm-10">
                                {{ Form::select('gender',['male'=>trans('admin.male'),'female'=>trans('admin.female')], null, ['class'=>'form-control select2','id'=>'gender']) }}
                                @if($errors->has('gender'))
                                <div class="alert alert-danger">{{$errors->first('gender')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="required" class="col-sm-2 col-form-label">{{trans('admin.required')}}</label>
                            <div class="col-sm-4">
                                {{ Form::select('required',['no'=>trans('admin.no'),'yes'=>trans('admin.yes')], null, ['class'=>'form-control','id'=>'required']) }}
                                @if($errors->has('required'))
                                <div class="alert alert-danger">{{$errors->first('required')}}</div>
                                @endif
                            </div>
                            <label for="amount" class="col-sm-2 col-form-label">{{trans('admin.amount')}}</label>
                            <div class="col-sm-3">
                                {{ Form::text('amount', null, ['class'=>'form-control','id'=>'amount']) }}
                                @if($errors->has('amount'))
                                <div class="alert alert-danger">{{$errors->first('amount')}}</div>
                                @endif
                            </div>
                            <label class="col-sm-1 col-form-label">{{trans('admin.kwd')}}</label>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-2 col-form-label">{{trans('admin.child_name_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_name', null, ['class'=>'form-control','id'=>'ar_name']) }}
                                @if($errors->has('ar_name'))
                                <div class="alert alert-danger">{{$errors->first('ar_name')}}</div>
                                @endif
                            </div>
                            <label for="en_name" class="col-sm-2 col-form-label">{{trans('admin.child_name_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_name', null, ['class'=>'form-control','id'=>'en_name']) }}
                                @if($errors->has('en_name'))
                                <div class="alert alert-danger">{{$errors->first('en_name')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-sm-2 col-form-label">{{trans('admin.birth_date')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('birth_date', null, ['class'=>'form-control','id'=>'birth_date']) }}
                                @if($errors->has('birth_date'))
                                <div class="alert alert-danger">{{$errors->first('birth_date')}}</div>
                                @endif
                            </div>
                            <label for="birth_no" class="col-sm-2 col-form-label">{{trans('admin.birth_no')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('birth_no', null, ['class'=>'form-control','id'=>'birth_no']) }}
                                @if($errors->has('birth_no'))
                                <div class="alert alert-danger">{{$errors->first('birth_no')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_nationality" class="col-sm-2 col-form-label">{{trans('admin.nationality_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_nationality', null, ['class'=>'form-control','id'=>'ar_nationality']) }}
                                @if($errors->has('ar_nationality'))
                                <div class="alert alert-danger">{{$errors->first('ar_nationality')}}</div>
                                @endif
                            </div>
                            <label for="en_nationality" class="col-sm-2 col-form-label">{{trans('admin.nationality_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_nationality', null, ['class'=>'form-control','id'=>'en_nationality']) }}
                                @if($errors->has('en_nationality'))
                                <div class="alert alert-danger">{{$errors->first('en_nationality')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_governate" class="col-sm-2 col-form-label">{{trans('admin.governate_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_governate', null, ['class'=>'form-control','id'=>'ar_governate']) }}
                                @if($errors->has('ar_governate'))
                                <div class="alert alert-danger">{{$errors->first('ar_governate')}}</div>
                                @endif
                            </div>
                            <label for="en_governate" class="col-sm-2 col-form-label">{{trans('admin.governate_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_governate', null, ['class'=>'form-control','id'=>'en_governate']) }}
                                @if($errors->has('en_governate'))
                                <div class="alert alert-danger">{{$errors->first('en_governate')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_city" class="col-sm-2 col-form-label">{{trans('admin.city_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_city', null, ['class'=>'form-control','id'=>'ar_city']) }}
                                @if($errors->has('ar_city'))
                                <div class="alert alert-danger">{{$errors->first('ar_city')}}</div>
                                @endif
                            </div>
                            <label for="en_city" class="col-sm-2 col-form-label">{{trans('admin.city_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_city', null, ['class'=>'form-control','id'=>'en_city']) }}
                                @if($errors->has('en_city'))
                                <div class="alert alert-danger">{{$errors->first('en_city')}}</div>
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
                            <label for="ar_study_stage" class="col-sm-2 col-form-label">{{trans('admin.study_stage_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_study_stage', null, ['class'=>'form-control','id'=>'ar_study_stage']) }}
                                @if($errors->has('ar_study_stage'))
                                <div class="alert alert-danger">{{$errors->first('ar_study_stage')}}</div>
                                @endif
                            </div>
                            <label for="en_study_stage" class="col-sm-2 col-form-label">{{trans('admin.study_stage_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_study_stage', null, ['class'=>'form-control','id'=>'en_study_stage']) }}
                                @if($errors->has('en_study_stage'))
                                <div class="alert alert-danger">{{$errors->first('en_study_stage')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_class" class="col-sm-2 col-form-label">{{trans('admin.class_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_class', null, ['class'=>'form-control','id'=>'ar_class']) }}
                                @if($errors->has('ar_class'))
                                <div class="alert alert-danger">{{$errors->first('ar_class')}}</div>
                                @endif
                            </div>
                            <label for="en_class" class="col-sm-2 col-form-label">{{trans('admin.class_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_class', null, ['class'=>'form-control','id'=>'en_class']) }}
                                @if($errors->has('en_class'))
                                <div class="alert alert-danger">{{$errors->first('en_class')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="study_report" class="col-sm-2 col-form-label image">{{trans('admin.study_report')}}</label>
                            <div class="col-sm-10">
                                {{ Form::file('study_report',['class'=>'form-control','id'=>'study_report']) }}
                                @if($errors->has('study_report'))
                                <div class="alert alert-danger">{{$errors->first('study_report')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_quran" class="col-sm-2 col-form-label">{{trans('admin.quran_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_quran', null, ['class'=>'form-control','id'=>'ar_quran']) }}
                                @if($errors->has('ar_quran'))
                                <div class="alert alert-danger">{{$errors->first('ar_quran')}}</div>
                                @endif
                            </div>
                            <label for="en_quran" class="col-sm-2 col-form-label">{{trans('admin.quran_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_quran', null, ['class'=>'form-control','id'=>'en_quran']) }}
                                @if($errors->has('en_quran'))
                                <div class="alert alert-danger">{{$errors->first('en_quran')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_skills" class="col-sm-2 col-form-label">{{trans('admin.skills_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::textarea('ar_skills', null, ['class'=>'form-control','id'=>'ar_skills']) }}
                                @if($errors->has('ar_skills'))
                                <div class="alert alert-danger">{{$errors->first('ar_skills')}}</div>
                                @endif
                            </div>
                            <label for="en_skills" class="col-sm-2 col-form-label">{{trans('admin.skills_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::textarea('en_skills', null, ['class'=>'form-control','id'=>'en_skills']) }}
                                @if($errors->has('en_skills'))
                                <div class="alert alert-danger">{{$errors->first('en_skills')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_psychological" class="col-sm-2 col-form-label">{{trans('admin.psychological_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_psychological', null, ['class'=>'form-control','id'=>'ar_psychological']) }}
                                @if($errors->has('ar_psychological'))
                                <div class="alert alert-danger">{{$errors->first('ar_psychological')}}</div>
                                @endif
                            </div>
                            <label for="en_psychological" class="col-sm-2 col-form-label">{{trans('admin.psychological_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_psychological', null, ['class'=>'form-control','id'=>'en_psychological']) }}
                                @if($errors->has('en_psychological'))
                                <div class="alert alert-danger">{{$errors->first('en_psychological')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_healthy" class="col-sm-2 col-form-label">{{trans('admin.healthy_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_healthy', null, ['class'=>'form-control','id'=>'ar_healthy']) }}
                                @if($errors->has('ar_healthy'))
                                <div class="alert alert-danger">{{$errors->first('ar_healthy')}}</div>
                                @endif
                            </div>
                            <label for="en_healthy" class="col-sm-2 col-form-label">{{trans('admin.healthy_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_healthy', null, ['class'=>'form-control','id'=>'en_healthy']) }}
                                @if($errors->has('en_healthy'))
                                <div class="alert alert-danger">{{$errors->first('en_healthy')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_illness" class="col-sm-2 col-form-label">{{trans('admin.illness_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_illness', null, ['class'=>'form-control','id'=>'ar_illness']) }}
                                @if($errors->has('ar_illness'))
                                <div class="alert alert-danger">{{$errors->first('ar_illness')}}</div>
                                @endif
                            </div>
                            <label for="en_illness" class="col-sm-2 col-form-label">{{trans('admin.illness_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_illness', null, ['class'=>'form-control','id'=>'en_illness']) }}
                                @if($errors->has('en_illness'))
                                <div class="alert alert-danger">{{$errors->first('en_illness')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_illness_desc" class="col-sm-2 col-form-label">{{trans('admin.illness_desc_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::textarea('ar_illness_desc', null, ['class'=>'form-control','id'=>'ar_illness_desc']) }}
                                @if($errors->has('ar_illness_desc'))
                                <div class="alert alert-danger">{{$errors->first('ar_illness_desc')}}</div>
                                @endif
                            </div>
                            <label for="en_illness_desc" class="col-sm-2 col-form-label">{{trans('admin.illness_desc_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::textarea('en_illness_desc', null, ['class'=>'form-control','id'=>'en_illness_desc']) }}
                                @if($errors->has('en_illness_desc'))
                                <div class="alert alert-danger">{{$errors->first('en_illness_desc')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="form-group row">
                            <label for="death_date" class="col-sm-2 col-form-label">{{trans('admin.death_date')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('death_date', null, ['class'=>'form-control','id'=>'death_date']) }}
                                @if($errors->has('death_date'))
                                <div class="alert alert-danger">{{$errors->first('death_date')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_death_reason" class="col-sm-2 col-form-label">{{trans('admin.death_reason_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_death_reason', null, ['class'=>'form-control','id'=>'ar_death_reason']) }}
                                @if($errors->has('ar_death_reason'))
                                <div class="alert alert-danger">{{$errors->first('ar_death_reason')}}</div>
                                @endif
                            </div>
                            <label for="en_death_reason" class="col-sm-2 col-form-label">{{trans('admin.death_reason_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_death_reason', null, ['class'=>'form-control','id'=>'en_death_reason']) }}
                                @if($errors->has('en_death_reason'))
                                <div class="alert alert-danger">{{$errors->first('en_death_reason')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_responsible" class="col-sm-2 col-form-label">{{trans('admin.responsible_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_responsible', null, ['class'=>'form-control','id'=>'ar_responsible']) }}
                                @if($errors->has('ar_responsible'))
                                <div class="alert alert-danger">{{$errors->first('ar_responsible')}}</div>
                                @endif
                            </div>
                            <label for="en_responsible" class="col-sm-2 col-form-label">{{trans('admin.responsible_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_responsible', null, ['class'=>'form-control','id'=>'en_responsible']) }}
                                @if($errors->has('en_responsible'))
                                <div class="alert alert-danger">{{$errors->first('en_responsible')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_relative" class="col-sm-2 col-form-label">{{trans('admin.relative_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_relative', null, ['class'=>'form-control','id'=>'ar_relative']) }}
                                @if($errors->has('ar_relative'))
                                <div class="alert alert-danger">{{$errors->first('ar_relative')}}</div>
                                @endif
                            </div>
                            <label for="en_relative" class="col-sm-2 col-form-label">{{trans('admin.relative_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_relative', null, ['class'=>'form-control','id'=>'en_relative']) }}
                                @if($errors->has('en_relative'))
                                <div class="alert alert-danger">{{$errors->first('en_relative')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="brothers" class="col-sm-2 col-form-label">{{trans('admin.brothers')}}</label>
                            <div class="col-sm-4">
                                {{ Form::number('brothers', null, ['class'=>'form-control','id'=>'brothers']) }}
                                @if($errors->has('brothers'))
                                <div class="alert alert-danger">{{$errors->first('brothers')}}</div>
                                @endif
                            </div>
                            <label for="sisters" class="col-sm-2 col-form-label">{{trans('admin.sisters')}}</label>
                            <div class="col-sm-4">
                                {{ Form::number('sisters', null, ['class'=>'form-control','id'=>'sisters']) }}
                                @if($errors->has('sisters'))
                                <div class="alert alert-danger">{{$errors->first('sisters')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row" id="files">
                            <label class="col-sm-2 col-form-label {{$pull}}" id="file_1" style="margin-bottom: 10px;">{{trans('admin.report_name_ar')}}</label>
                            <div class="col-sm-2 {{$pull}}" id="file_2" style="margin-bottom: 10px;">
                                {{ Form::text('ar_names[]',null, ['class'=>'form-control','id'=>'ar_names']) }}
                            </div>
                            <label class="col-sm-2 col-form-label {{$pull}}" id="file_3" style="margin-bottom: 10px;">{{trans('admin.report_name_en')}}</label>
                            <div class="col-sm-2 {{$pull}}" id="file_4" style="margin-bottom: 10px;">
                                {{ Form::text('en_names[]',null, ['class'=>'form-control','id'=>'en_names']) }}
                            </div>
                            <label class="col-sm-1 col-form-label {{$pull}}" id="file_5" style="margin-bottom: 10px;">{{trans('admin.report')}}</label>
                            <div class="col-sm-2 {{$pull}}" id="file_6" style="margin-bottom: 10px;">
                                {{ Form::file('files[]', ['class'=>'form-control','id'=>'files']) }}
                            </div>
                            <div class="col-md-1 {{$pull}}" style="margin-bottom: 10px;">
                                <button type="button" class="btn btn-block btn-success btn-block" style="height: 36px;" id="more_files"> <i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">{{trans('admin.add')}}</button>
                <a href="{{URL::to('admin/childern')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
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
    $('#death_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

    $("body").on("click", "#more_files", function (e) {
        $('#files').append('<br><br>');
        $('#files').append($('#file_1').clone());
        $('#files').append($('#file_2').clone());
        $('#files').append($('#file_3').clone());
        $('#files').append($('#file_4').clone());
        $('#files').append($('#file_5').clone());
        $('#files').append($('#file_6').clone());
        $('#files').append('<div class="col-sm-1 <?php echo $pull; ?>" style="margin-bottom: 10px;"><button class="btn btn-danger btn-lg btn-block delete_files" style="height: 36px;"><i class="fa fa-trash-o"></i></button></div>');
        return false;
    });

    $("body").on("click", ".delete_files", function (e) {
        $(this).parent("div").prev("div").prev("label").prev("div").prev("label").prev("div").prev("label").prev("br").prev("br").remove();
        $(this).parent("div").prev("div").prev("label").prev("div").prev("label").prev("div").prev("label").prev("br").remove();
        $(this).parent("div").prev("div").prev("label").prev("div").prev("label").prev("div").prev("label").remove();
        $(this).parent("div").prev("div").prev("label").prev("div").prev("label").prev("div").remove();
        $(this).parent("div").prev("div").prev("label").prev("div").prev("label").remove();
        $(this).parent("div").prev("div").prev("label").prev("div").remove();
        $(this).parent("div").prev("div").prev("label").remove();
        $(this).parent("div").prev("div").remove();
        $(this).parent("div").remove();
        return false;
    });
</script>
@endsection

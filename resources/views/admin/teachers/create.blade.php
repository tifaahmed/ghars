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
        {{trans('admin.teachers')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/teachers')}}"> {{trans('admin.teachers')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.teacher_add')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.teacher_add')}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/teachers/')}}" method="post" enctype="multipart/form-data">
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
                            <label for="ar_name" class="col-sm-2 col-form-label">{{trans('admin.teacher_name_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_name', null, ['class'=>'form-control','id'=>'ar_name']) }}
                                @if($errors->has('ar_name'))
                                <div class="alert alert-danger">{{$errors->first('ar_name')}}</div>
                                @endif
                            </div>
                            <label for="en_name" class="col-sm-2 col-form-label">{{trans('admin.teacher_name_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_name', null, ['class'=>'form-control','id'=>'en_name']) }}
                                @if($errors->has('en_name'))
                                <div class="alert alert-danger">{{$errors->first('en_name')}}</div>
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
                            <label for="ar_address" class="col-sm-2 col-form-label">{{trans('admin.address_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_address', null, ['class'=>'form-control','id'=>'ar_address']) }}
                                @if($errors->has('ar_address'))
                                <div class="alert alert-danger">{{$errors->first('ar_address')}}</div>
                                @endif
                            </div>
                            <label for="en_address" class="col-sm-2 col-form-label">{{trans('admin.address_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_address', null, ['class'=>'form-control','id'=>'en_address']) }}
                                @if($errors->has('en_address'))
                                <div class="alert alert-danger">{{$errors->first('en_address')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_status" class="col-sm-2 col-form-label">{{trans('admin.status_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_status', null, ['class'=>'form-control','id'=>'ar_status']) }}
                                @if($errors->has('ar_status'))
                                <div class="alert alert-danger">{{$errors->first('ar_status')}}</div>
                                @endif
                            </div>
                            <label for="en_status" class="col-sm-2 col-form-label">{{trans('admin.status_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_status', null, ['class'=>'form-control','id'=>'en_status']) }}
                                @if($errors->has('en_status'))
                                <div class="alert alert-danger">{{$errors->first('en_status')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">{{trans('admin.phone')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('phone', null, ['class'=>'form-control','id'=>'phone']) }}
                                @if($errors->has('phone'))
                                <div class="alert alert-danger">{{$errors->first('phone')}}</div>
                                @endif
                            </div>
                            <label for="email" class="col-sm-2 col-form-label">{{trans('admin.email')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('email', null, ['class'=>'form-control','id'=>'email']) }}
                                @if($errors->has('email'))
                                <div class="alert alert-danger">{{$errors->first('email')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_qualification" class="col-sm-2 col-form-label">{{trans('admin.qualification_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_qualification', null, ['class'=>'form-control','id'=>'ar_qualification']) }}
                                @if($errors->has('ar_qualification'))
                                <div class="alert alert-danger">{{$errors->first('ar_qualification')}}</div>
                                @endif
                            </div>
                            <label for="en_qualification" class="col-sm-2 col-form-label">{{trans('admin.qualification_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_qualification', null, ['class'=>'form-control','id'=>'en_qualification']) }}
                                @if($errors->has('en_qualification'))
                                <div class="alert alert-danger">{{$errors->first('en_qualification')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_qualification_source" class="col-sm-2 col-form-label">{{trans('admin.qualification_source_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_qualification_source', null, ['class'=>'form-control','id'=>'ar_qualification_source']) }}
                                @if($errors->has('ar_qualification_source'))
                                <div class="alert alert-danger">{{$errors->first('ar_qualification_source')}}</div>
                                @endif
                            </div>
                            <label for="en_qualification_source" class="col-sm-2 col-form-label">{{trans('admin.qualification_source_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_qualification_source', null, ['class'=>'form-control','id'=>'en_qualification_source']) }}
                                @if($errors->has('en_qualification_source'))
                                <div class="alert alert-danger">{{$errors->first('en_qualification_source')}}</div>
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
                            <label for="qualification_date" class="col-sm-2 col-form-label">{{trans('admin.qualification_date')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('qualification_date', null, ['class'=>'form-control','id'=>'qualification_date']) }}
                                @if($errors->has('qualification_date'))
                                <div class="alert alert-danger">{{$errors->first('qualification_date')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_specialization" class="col-sm-2 col-form-label">{{trans('admin.specialization_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_specialization', null, ['class'=>'form-control','id'=>'ar_specialization']) }}
                                @if($errors->has('ar_specialization'))
                                <div class="alert alert-danger">{{$errors->first('ar_specialization')}}</div>
                                @endif
                            </div>
                            <label for="en_specialization" class="col-sm-2 col-form-label">{{trans('admin.specialization_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_specialization', null, ['class'=>'form-control','id'=>'en_specialization']) }}
                                @if($errors->has('en_specialization'))
                                <div class="alert alert-danger">{{$errors->first('en_specialization')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_career" class="col-sm-2 col-form-label">{{trans('admin.careerr_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_career', null, ['class'=>'form-control','id'=>'ar_career']) }}
                                @if($errors->has('ar_career'))
                                <div class="alert alert-danger">{{$errors->first('ar_career')}}</div>
                                @endif
                            </div>
                            <label for="en_career" class="col-sm-2 col-form-label">{{trans('admin.careerr_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_career', null, ['class'=>'form-control','id'=>'en_career']) }}
                                @if($errors->has('en_career'))
                                <div class="alert alert-danger">{{$errors->first('en_career')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_invitation" class="col-sm-2 col-form-label">{{trans('admin.invitation_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::textarea('ar_invitation', null, ['class'=>'form-control','id'=>'ar_invitation']) }}
                                @if($errors->has('ar_invitation'))
                                <div class="alert alert-danger">{{$errors->first('ar_invitation')}}</div>
                                @endif
                            </div>
                            <label for="en_invitation" class="col-sm-2 col-form-label">{{trans('admin.invitation_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::textarea('en_invitation', null, ['class'=>'form-control','id'=>'en_invitation']) }}
                                @if($errors->has('en_invitation'))
                                <div class="alert alert-danger">{{$errors->first('en_invitation')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_social" class="col-sm-2 col-form-label">{{trans('admin.social_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::textarea('ar_social', null, ['class'=>'form-control','id'=>'ar_social']) }}
                                @if($errors->has('ar_social'))
                                <div class="alert alert-danger">{{$errors->first('ar_social')}}</div>
                                @endif
                            </div>
                            <label for="en_social" class="col-sm-2 col-form-label">{{trans('admin.social_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::textarea('en_social', null, ['class'=>'form-control','id'=>'en_social']) }}
                                @if($errors->has('en_social'))
                                <div class="alert alert-danger">{{$errors->first('en_social')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

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
                            <label for="responsible_country_id" class="col-sm-2 col-form-label">{{trans('admin.responsible_country')}}</label>
                            <div class="col-sm-10">
                                {{ Form::select('responsible_country_id',$countries, null, ['class'=>'form-control select2','id'=>'responsible_country_id']) }}
                                @if($errors->has('responsible_country_id'))
                                <div class="alert alert-danger">{{$errors->first('responsible_country_id')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_responsible_address" class="col-sm-2 col-form-label">{{trans('admin.responsible_address_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_responsible_address', null, ['class'=>'form-control','id'=>'ar_responsible_address']) }}
                                @if($errors->has('ar_responsible_address'))
                                <div class="alert alert-danger">{{$errors->first('ar_responsible_address')}}</div>
                                @endif
                            </div>
                            <label for="en_responsible_address" class="col-sm-2 col-form-label">{{trans('admin.responsible_address_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_responsible_address', null, ['class'=>'form-control','id'=>'en_responsible_address']) }}
                                @if($errors->has('en_responsible_address'))
                                <div class="alert alert-danger">{{$errors->first('en_responsible_address')}}</div>
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
                            <label for="responsible_email" class="col-sm-2 col-form-label">{{trans('admin.responsible_email')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('responsible_email', null, ['class'=>'form-control','id'=>'responsible_email']) }}
                                @if($errors->has('responsible_email'))
                                <div class="alert alert-danger">{{$errors->first('responsible_email')}}</div>
                                @endif
                            </div>
                            <label for="responsible_phone" class="col-sm-2 col-form-label">{{trans('admin.responsible_phone')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('responsible_phone', null, ['class'=>'form-control','id'=>'responsible_phone']) }}
                                @if($errors->has('responsible_phone'))
                                <div class="alert alert-danger">{{$errors->first('responsible_phone')}}</div>
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
                <a href="{{URL::to('admin/teachers')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
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
    $('#qualification_date').datepicker({
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

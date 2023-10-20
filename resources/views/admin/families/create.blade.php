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
        {{trans('admin.families')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/families')}}"> {{trans('admin.families')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.family_add')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.family_add')}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/families/')}}" method="post" enctype="multipart/form-data">
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
                            <label for="ar_name" class="col-sm-2 col-form-label">{{trans('admin.family_name_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_name', null, ['class'=>'form-control','id'=>'ar_name']) }}
                                @if($errors->has('ar_name'))
                                <div class="alert alert-danger">{{$errors->first('ar_name')}}</div>
                                @endif
                            </div>
                            <label for="en_name" class="col-sm-2 col-form-label">{{trans('admin.family_name_en')}}</label>
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
                            <label for="civil_id" class="col-sm-2 col-form-label">{{trans('admin.civil_id')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('civil_id', null, ['class'=>'form-control','id'=>'civil_id']) }}
                                @if($errors->has('civil_id'))
                                <div class="alert alert-danger">{{$errors->first('civil_id')}}</div>
                                @endif
                            </div>
                            <label for="members_count" class="col-sm-2 col-form-label">{{trans('admin.members_count')}}</label>
                            <div class="col-sm-4">
                                {{ Form::number('members_count', null, ['class'=>'form-control','id'=>'members_count']) }}
                                @if($errors->has('members_count'))
                                <div class="alert alert-danger">{{$errors->first('members_count')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_parent_status" class="col-sm-2 col-form-label">{{trans('admin.parent_status_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_parent_status', null, ['class'=>'form-control','id'=>'ar_parent_status']) }}
                                @if($errors->has('ar_parent_status'))
                                <div class="alert alert-danger">{{$errors->first('ar_parent_status')}}</div>
                                @endif
                            </div>
                            <label for="en_parent_status" class="col-sm-2 col-form-label">{{trans('admin.parent_status_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_parent_status', null, ['class'=>'form-control','id'=>'en_parent_status']) }}
                                @if($errors->has('en_parent_status'))
                                <div class="alert alert-danger">{{$errors->first('en_parent_status')}}</div>
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
                            <label for="males" class="col-sm-2 col-form-label">{{trans('admin.males')}}</label>
                            <div class="col-sm-4">
                                {{ Form::number('males', null, ['class'=>'form-control','id'=>'males']) }}
                                @if($errors->has('males'))
                                <div class="alert alert-danger">{{$errors->first('males')}}</div>
                                @endif
                            </div>
                            <label for="females" class="col-sm-2 col-form-label">{{trans('admin.females')}}</label>
                            <div class="col-sm-4">
                                {{ Form::number('females', null, ['class'=>'form-control','id'=>'females']) }}
                                @if($errors->has('females'))
                                <div class="alert alert-danger">{{$errors->first('females')}}</div>
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
                            <label for="ar_career" class="col-sm-2 col-form-label">{{trans('admin.career_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('ar_career', null, ['class'=>'form-control','id'=>'ar_career']) }}
                                @if($errors->has('ar_career'))
                                <div class="alert alert-danger">{{$errors->first('ar_career')}}</div>
                                @endif
                            </div>
                            <label for="en_career" class="col-sm-2 col-form-label">{{trans('admin.career_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::text('en_career', null, ['class'=>'form-control','id'=>'en_career']) }}
                                @if($errors->has('en_career'))
                                <div class="alert alert-danger">{{$errors->first('en_career')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="ar_career_status" class="col-sm-2 col-form-label">{{trans('admin.career_status_ar')}}</label>
                            <div class="col-sm-4">
                                {{ Form::textarea('ar_career_status', null, ['class'=>'form-control','id'=>'ar_career_status']) }}
                                @if($errors->has('ar_career_status'))
                                <div class="alert alert-danger">{{$errors->first('ar_career_status')}}</div>
                                @endif
                            </div>
                            <label for="en_career_status" class="col-sm-2 col-form-label">{{trans('admin.career_status_en')}}</label>
                            <div class="col-sm-4">
                                {{ Form::textarea('en_career_status', null, ['class'=>'form-control','id'=>'en_career_status']) }}
                                @if($errors->has('en_career_status'))
                                <div class="alert alert-danger">{{$errors->first('en_career_status')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label for="responsible_civil_id" class="col-sm-2 col-form-label">{{trans('admin.responsible_civil_id')}}</label>
                            <div class="col-sm-10">
                                {{ Form::text('responsible_civil_id', null, ['class'=>'form-control','id'=>'responsible_civil_id']) }}
                                @if($errors->has('responsible_civil_id'))
                                <div class="alert alert-danger">{{$errors->first('responsible_civil_id')}}</div>
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
                <a href="{{URL::to('admin/families')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>

@endsection

@section('scripts')
<script>
    //Date picker
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

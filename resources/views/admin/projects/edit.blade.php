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
        {{trans('admin.projects')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/projects')}}"> {{trans('admin.projects')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.project_edit')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.project_edit')}} : {{$project[$lang.'_name']}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/projects/'.$project['id'])}}" method="post" enctype="multipart/form-data">
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
                            <label for="active" class="col-sm-3 col-form-label">{{trans('admin.active')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('active',['yet'=>trans('admin.approve_yet'),'yes'=>trans('admin.approve_yes'),'no'=>trans('admin.approve_no')], $project['active'], ['class'=>'form-control select2','id'=>'active']) }}
                                @if($errors->has('active'))
                                <div class="alert alert-danger">{{$errors->first('active')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country_id" class="col-sm-3 col-form-label">{{trans('admin.country')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('country_id',$countries, $project['country_id'], ['class'=>'form-control select2','id'=>'country_id']) }}
                                @if($errors->has('country_id'))
                                <div class="alert alert-danger">{{$errors->first('country_id')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_id" class="col-sm-3 col-form-label">{{trans('admin.category')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('category_id',$categories, $project['category_id'], ['class'=>'form-control select2','id'=>'category_id','step_id'=>$project['step_id']]) }}
                                @if($errors->has('category_id'))
                                <div class="alert alert-danger">{{$errors->first('category_id')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company_id" class="col-sm-3 col-form-label">{{trans('admin.company')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('company_id',$companies, $project['company_id'], ['class'=>'form-control select2','id'=>'company_id']) }}
                                @if($errors->has('company_id'))
                                <div class="alert alert-danger">{{$errors->first('company_id')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="step_id" class="col-sm-3 col-form-label">{{trans('admin.step')}}</label>
                            <div class="col-sm-9">
                                <div id="categories_steps">
                                    {{ Form::select('step_id',[''=>trans('admin.choose')], null, ['class'=>'form-control select2','id'=>'step_id']) }}
                                </div>
                                @if($errors->has('step_id'))
                                <div class="alert alert-danger">{{$errors->first('step_id')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="required" class="col-sm-3 col-form-label">{{trans('admin.required')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('required',['no'=>trans('admin.no'),'yes'=>trans('admin.yes')], $project['required'], ['class'=>'form-control select2','id'=>'required']) }}
                                @if($errors->has('required'))
                                <div class="alert alert-danger">{{$errors->first('required')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-sm-3 col-form-label">{{trans('admin.type')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('type',['private'=>trans('admin.private') , 'public'=>trans('admin.public')], $project['type'], ['class'=>'form-control select2','id'=>'type']) }}
                                @if($errors->has('type'))
                                <div class="alert alert-danger">{{$errors->first('type')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row users">
                            <label for="user_id" class="col-sm-3 col-form-label">{{trans('admin.customer')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('user_id',$users, $project['user_id'], ['class'=>'form-control select2','id'=>'user_id']) }}
                                @if($errors->has('user_id'))
                                <div class="alert alert-danger">{{$errors->first('user_id')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-3 col-form-label">{{trans('admin.project_name_ar')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('ar_name', $project['ar_name'], ['class'=>'form-control','id'=>'ar_name']) }}
                                @if($errors->has('ar_name'))
                                <div class="alert alert-danger">{{$errors->first('ar_name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-3 col-form-label">{{trans('admin.project_name_en')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('en_name', $project['en_name'], ['class'=>'form-control','id'=>'en_name']) }}
                                @if($errors->has('en_name'))
                                <div class="alert alert-danger">{{$errors->first('en_name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-sm-3 col-form-label">{{trans('admin.amount')}}</label>
                            <div class="col-sm-8">
                                {{ Form::text('amount', $project['amount'], ['class'=>'form-control','id'=>'amount']) }}
                                @if($errors->has('amount'))
                                <div class="alert alert-danger">{{$errors->first('amount')}}</div>
                                @endif
                            </div>
                            <label class="col-sm-1 col-form-label">{{trans('admin.kwd')}}</label>
                        </div>

                        <div class="form-group row">
                            <label for="collect" class="col-sm-3 col-form-label">{{trans('admin.collect')}}</label>
                            <div class="col-sm-8">
                                {{ Form::text('collect', $project['collect'], ['class'=>'form-control','id'=>'collect']) }}
                                @if($errors->has('collect'))
                                <div class="alert alert-danger">{{$errors->first('collect')}}</div>
                                @endif
                            </div>
                            <label class="col-sm-1 col-form-label">{{trans('admin.kwd')}}</label>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-sm-3 col-form-label">{{trans('admin.start_date')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('start_date', $project['start_date'], ['class'=>'form-control','id'=>'start_date']) }}
                                @if($errors->has('start_date'))
                                <div class="alert alert-danger">{{$errors->first('start_date')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_date" class="col-sm-3 col-form-label">{{trans('admin.end_date')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('end_date', $project['end_date'], ['class'=>'form-control','id'=>'end_date']) }}
                                @if($errors->has('end_date'))
                                <div class="alert alert-danger">{{$errors->first('end_date')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="editor1" class="col-sm-3 col-form-label">{{trans('admin.project_desc_ar')}}</label>
                            <div class="col-sm-9">
                                {{ Form::textarea('ar_desc', $project['ar_desc'], ['class'=>'form-control','id'=>'editor1','rows'=>10]) }}
                                @if($errors->has('ar_desc'))
                                <div class="alert alert-danger">{{$errors->first('ar_desc')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="editor2" class="col-sm-3 col-form-label">{{trans('admin.project_desc_en')}}</label>
                            <div class="col-sm-9">
                                {{ Form::textarea('en_desc', $project['en_desc'], ['class'=>'form-control','id'=>'editor2','rows'=>10]) }}
                                @if($errors->has('en_desc'))
                                <div class="alert alert-danger">{{$errors->first('en_desc')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label image">{{trans('admin.image')}}<span dir="ltr">(Width: 500px * Height:500px)</span></label>
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
                                <img src="{{URL::to('upload/projects/'.$project['image'])}}" class="img-thumbnail image_current">
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

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="{{$text}}">{{trans('admin.report_name_ar')}}</th>
                                            <th class="{{$text}}">{{trans('admin.report_name_en')}}</th>
                                            <th class="{{$text}}">{{trans('admin.status')}}</th>
                                            <th class="{{$text}}">{{trans('admin.report')}}</th>
                                            <th class="{{$text}}">{{trans('admin.edit')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($project['Reports'] as $report)
                                        <tr>
                                            <td style="vertical-align: middle;">{{$report['ar_name']}}</td>
                                            <td style="vertical-align: middle;">{{$report['en_name']}}</td>
                                            <td style="vertical-align: middle;">{{trans('admin.approve_'.$report['active'])}}</td>
                                            <td style="vertical-align: middle;"><a target="_blank" href="{{url('upload/projects/'.$report['file'])}}" class="btn btn-sm btn-info">{{trans('admin.show')}}</a></td>
                                            <td style="vertical-align: middle;">
                                                @if($report['active'] == 'yet' || $report['active'] == 'no')
                                                <a href="{{url('admin/projects_reports/'.$report['id'].'?active=yes')}}" class="btn btn-sm btn-success">{{trans('admin.approve_yes')}}</a>
                                                @endif
                                                @if($report['active'] == 'yet' || $report['active'] == 'yes')
                                                <a href="{{url('admin/projects_reports/'.$report['id'].'?active=no')}}" class="btn btn-sm btn-danger">{{trans('admin.approve_no')}}</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">{{trans('admin.save')}}</button>
                <a href="{{URL::to('admin/projects')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>

@endsection

@section('scripts')
<script>
    //Date picker
    $('#start_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    $('#end_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    
    $(document).ready(function () {
        var type = $('#type').val();
        if (type == 'private') {
            $(".users").show();
        } else {
            $(".users").hide();
        }

        $('#type').change(function () {
            var type = $('#type').val();
            if (type == 'private') {
                $(".users").show();
            } else {
                $(".users").hide();
            }
        });

        $("body").on("change", "#category_id", function (e) {
            var val = $(this).val();
            var step_id = $('#category_id').attr('step_id');
            var base_url = $('#base-url').val();
            if (val == "") {
                val = 0;
            }
            alert(base_url + "/admin/ajax_categories_steps/" + val + "?value=" + step_id);
            $.ajax({
                type: "GET",
                url: base_url + "/admin/ajax_categories_steps/" + val + "?value=" + step_id,
                success: function (data) {
                    $('#categories_steps').html(data);
                }
            });
        });

        var category_id = $('#category_id').val();
        var step_id = $('#category_id').attr('step_id');
        var base_url = $('#base-url').val();
        if (category_id == "") {
            category_id = 0;
        }
        $.ajax({
            type: "GET",
            url: base_url + "/admin/ajax_categories_steps/" + category_id + "?value=" + step_id,
            success: function (data) {
                $('#categories_steps').html(data);
            }
        });
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

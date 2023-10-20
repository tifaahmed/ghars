@extends('dashboard.layouts.form')

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
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('dashboard')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('dashboard/projects')}}"> {{trans('admin.projects')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.project_edit')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.project_edit')}} : {{$project['name']}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('dashboard/projects/'.$project['id'])}}" method="post" enctype="multipart/form-data">
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
                                {{ Form::text('active',trans('admin.approve_'.$project['active']), ['class'=>'form-control','id'=>'active','readonly']) }}
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
                            <label for="country_id" class="col-sm-3 col-form-label">{{trans('admin.country')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('country_id',$project['Country'][$lang.'_name'], ['class'=>'form-control','id'=>'country_id','readonly']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_id" class="col-sm-3 col-form-label">{{trans('admin.category')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('category_id',$project['Category'][$lang.'_name'], ['class'=>'form-control','id'=>'category_id','step_id'=>$project['step_id'],'readonly']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-sm-3 col-form-label">{{trans('admin.type')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('type',trans('admin.'.$project['type']), ['class'=>'form-control','id'=>'type','readonly']) }}
                            </div>
                        </div>

                        @if($project['type'] == 'private')
                        <div class="form-group row users">
                            <label for="user_id" class="col-sm-3 col-form-label">{{trans('admin.customer')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('user_id',$project['User']['name'], ['class'=>'form-control','id'=>'user_id','readonly']) }}
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-3 col-form-label">{{trans('admin.project_name_ar')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('ar_name',$project['ar_name'], ['class'=>'form-control','id'=>'ar_name','readonly']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-3 col-form-label">{{trans('admin.project_name_en')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('en_name',$project['en_name'], ['class'=>'form-control','id'=>'en_name','readonly']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-sm-3 col-form-label">{{trans('admin.amount')}}</label>
                            <div class="col-sm-8">
                                @if($project['active'] == 'yet')
                                {{ Form::text('amount', $project['amount'], ['class'=>'form-control','id'=>'amount']) }}
                                @else
                                {{ Form::text('amountt', $project['amount'], ['class'=>'form-control','id'=>'amountt','readonly']) }}
                                {{ Form::hidden('amount', $project['amount']) }}
                                @endif

                                @if($errors->has('amount'))
                                <div class="alert alert-danger">{{$errors->first('amount')}}</div>
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
                                <div class="col-12" style="border: 1px solid #000; line-height: 26px; padding: 10px;">
                                    {!! $project['ar_desc'] !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="editor2" class="col-sm-3 col-form-label">{{trans('admin.project_desc_en')}}</label>
                            <div class="col-sm-9">
                                <div class="col-12" style="border: 1px solid #000; line-height: 26px; padding: 10px;">
                                    {!! $project['en_desc'] !!}
                                </div>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($project['Reports'] as $report)
                                        <tr>
                                            <td style="vertical-align: middle;">{{$report['ar_name']}}</td>
                                            <td style="vertical-align: middle;">{{$report['en_name']}}</td>
                                            <td style="vertical-align: middle;">{{trans('admin.approve_'.$report['active'])}}</td>
                                            <td style="vertical-align: middle;"><a target="_blank" href="{{url('upload/projects/'.$report['file'])}}" class="btn btn-sm btn-info">{{trans('admin.show')}}</a></td>                                            
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
                <a href="{{URL::to('dashboard/projects')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
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

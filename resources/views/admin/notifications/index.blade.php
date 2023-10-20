@extends('admin.layouts.table')

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
        {{trans('admin.notifications')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.notifications')}}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
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

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('admin.notification_add')}}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>

                <form action="{{URL::to('admin/notifications')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group row">
                                    <label for="platform" class="col-sm-3 col-form-label">{{trans('admin.platform')}}</label>
                                    <div class="col-sm-9">
                                        {{ Form::select('platform',['all'=>trans('admin.all_platform'),'android'=>trans('admin.android_platform'),'ios'=>trans('admin.ios_platform')], null, ['class'=>'form-control','id'=>'platform']) }}
                                        @if($errors->has('platform'))
                                        <div class="alert alert-danger">{{$errors->first('platform')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ar_title" class="col-sm-3 col-form-label">{{trans('admin.notification_title_ar')}}</label>
                                    <div class="col-sm-9">
                                        {{ Form::text('ar_title', null, ['class'=>'form-control','id'=>'ar_title']) }}
                                        @if($errors->has('ar_title'))
                                        <div class="alert alert-danger">{{$errors->first('ar_title')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="en_title" class="col-sm-3 col-form-label">{{trans('admin.notification_title_en')}}</label>
                                    <div class="col-sm-9">
                                        {{ Form::text('en_title', null, ['class'=>'form-control','id'=>'en_title']) }}
                                        @if($errors->has('en_title'))
                                        <div class="alert alert-danger">{{$errors->first('en_title')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ar_message" class="col-sm-3 col-form-label">{{trans('admin.notification_message_ar')}}</label>
                                    <div class="col-sm-9">
                                        {{ Form::textarea('ar_message', null, ['class'=>'form-control','id'=>'ar_message','rows'=>4]) }}
                                        @if($errors->has('ar_message'))
                                        <div class="alert alert-danger">{{$errors->first('ar_message')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="en_message" class="col-sm-3 col-form-label">{{trans('admin.notification_message_en')}}</label>
                                    <div class="col-sm-9">
                                        {{ Form::textarea('en_message', null, ['class'=>'form-control','id'=>'en_message','rows'=>4]) }}
                                        @if($errors->has('en_message'))
                                        <div class="alert alert-danger">{{$errors->first('en_message')}}</div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success btn-lg" style="font-size: 16px;">{{trans('admin.send')}}</button>
                        <a href="https://getemoji.com/" target="_blank" class="btn btn-default btn-lg" style="font-size: 16px;"><i class="fa fa-smile-o"></i></a>
                    </div>

                </form>

            </div>

            <div class="box">
                <div class="box-body">
                    <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
                        <thead>
                            <tr>
                                <th class="{{$text}}">{{trans('admin.date')}}</th>
                                <th class="{{$text}}">{{trans('admin.notification')}}</th>
                                <th class="{{$text}}">{{trans('admin.platform')}}</th>
                                <th class="{{$text}}">{{trans('admin.sender')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notifications as $notification)
                            <tr>
                                <td style="vertical-align: middle;">{{$notification['created_at']}}</td>
                                <td style="vertical-align: middle;">
                                    {{$notification[$lang.'_title']}}
                                    <br>
                                    {{$notification[$lang.'_message']}}
                                </td>
                                <td style="vertical-align: middle;">{{trans('admin.'.$notification['platform'].'_platform')}}</td>
                                <td style="vertical-align: middle;">{{$notification['User']['first_name'].' '.$notification['User']['last_name']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->          
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

@endsection
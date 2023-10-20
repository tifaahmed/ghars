@extends('admin.layouts.table')

@section('content')
<?php
$lang = App::getLocale();
$text = "text-left";
$pull = "float-left";
$pulll = "float-right";
if ($lang == "ar") {
    $text = "text-right";
    $pull = "float-right";
    $pulll = "float-left";
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{trans('admin.donations')}} : {{$project[$lang.'_name']}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/projects')}}"> {{trans('admin.projects')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.donations')}}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-12" id="active_response">

                </div>
            </div>

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

            @if (Session::has('error'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible">
                        {{ Session::get('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            @endif

            <div class="box">
                <div class="box-body">
                    <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
                        <thead>
                            <tr>
                                <th class="{{$text}}">{{trans('admin.customer')}}</th>
                                <th class="{{$text}}">{{trans('admin.amount')}}</th>
                                <th class="{{$text}}">{{trans('admin.as_gift')}}</th>
                                <th class="{{$text}}">{{trans('admin.date')}}</th>
                                <th class="{{$text}}">{{trans('admin.pay_type')}}</th>
                                <th class="{{$text}}">{{trans('admin.status')}}</th>
                                <th class="{{$text}}">{{trans('admin.edit')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($project['Donations'] as $donation)
                            <tr>
                                <td style="vertical-align: middle;">
                                    @if($donation['user_type'] == 'user')
                                    {{$donation['User']['name']}}
                                    @else
                                    {{$donation['Visitor']['name']}}
                                    @endif
                                </td>
                                <td style="vertical-align: middle;">{{$donation['amount'].' '.$donation[$lang.'_currency']}}</td>
                                <td style="vertical-align: middle;">{{$donation['name']}}</td>
                                <td style="vertical-align: middle;">{{$donation['created_at']->format('Y-m-d')}}</td>
                                <td style="vertical-align: middle;">{{trans('admin.'.$donation['pay_type'])}}</td>
                                <td style="vertical-align: middle;">{{trans('admin.paid_'.$donation['active'])}}</td>
                                <td style="vertical-align: middle;">
                                    @if($donation['active'] == 'yet')
                                    {{ Form::open(array('url' =>'admin/donations/'.$donation->id, 'method' => 'POST')) }}
                                    {{ Form::hidden('_method','PATCH') }}
                                    {{ Form::hidden('active','yes') }}
                                    {{ csrf_field() }}
                                    <button style="margin-bottom:5px;" type="submit" class="btn default btn-md btn-success btn-block"><i class="fa fa-thumbs-up"></i> {{trans('admin.approve')}} </button>
                                    {{ Form::close() }}

                                    {{ Form::open(array('url' =>'admin/donations/'.$donation->id, 'method' => 'POST')) }}
                                    {{ Form::hidden('_method','PATCH') }}
                                    {{ Form::hidden('active','no') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn default btn-md btn-danger btn-block"><i class="fa fa-thumbs-down"></i> {{trans('admin.deny')}} </button>
                                    {{ Form::close() }}
                                    @endif
                                </td>
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
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
        {{trans('admin.families')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.families')}}</li>
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
                <div class="box-header">
                    <a href="{{URL::to('admin/families/create')}}" class="btn btn-lg bg-black">{{trans('admin.family_add')}}</a>
                </div>
                <div class="box-body">
                    <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
                        <thead>
                            <tr>
                                <th class="{{$text}}">{{trans('admin.country')}}</th>
                                <th class="{{$text}}">{{trans('admin.gender')}}</th>
                                <th class="{{$text}}">{{trans('admin.family_name')}}</th>
                                <th class="{{$text}}">{{trans('admin.members_count')}}</th>
                                <th class="{{$text}}">{{trans('admin.amount')}}</th>
                                <th class="{{$text}}">{{trans('admin.active')}}</th>
                                <th class="{{$text}}">{{trans('admin.members')}}</th>
                                <th class="{{$text}}">{{trans('admin.donations')}}</th>
                                <th class="{{$text}}">{{trans('admin.edit')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($families as $family)
                            <tr>
                                <td style="vertical-align: middle;">{{$family['Country'][$lang.'_name']}}</td>
                                <td style="vertical-align: middle;">{{trans('admin.'.$family['gender'])}}</td>
                                <td style="vertical-align: middle;">{{$family[$lang.'_name']}}</td>
                                <td style="vertical-align: middle;">{{$family['members_count']}}</td>
                                <td style="vertical-align: middle;">{{$family['amount'].' '.trans('admin.kwd')}}</td>
                                <td style="vertical-align: middle;">
                                    <label class="switch" style="margin-bottom: 0;">
                                        @if($family['active'] == 'yes')
                                        <input class="switch_active" page='families' id="{{$family['id']}}" type="checkbox" checked="">
                                        @else
                                        <input class="switch_active" page='families' id="{{$family['id']}}" type="checkbox">
                                        @endif
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ Form::open(array('url' =>'admin/families_members/'.$family->id, 'method' => 'GET')) }}
                                    <button  type="submit" class="btn default btn-sm bg-maroon"><i class="fa fa-users"></i> {{trans('admin.show')}} </button>
                                    {{ Form::close() }}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ Form::open(array('url' =>'admin/families/'.$family->id, 'method' => 'GET')) }}
                                    <button  type="submit" class="btn default btn-sm bg-purple"><i class="fa fa-usd"></i> {{trans('admin.show')}} </button>
                                    {{ Form::close() }}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ Form::open(array('url' =>'admin/families/'.$family->id.'/edit', 'method' => 'GET')) }}
                                    <button  type="submit" class="btn default btn-sm btn-success"><i class="fa fa-edit"></i> {{trans('admin.edit')}} </button>
                                    {{ Form::close() }}
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
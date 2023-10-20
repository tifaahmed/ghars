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
        {{trans('admin.members')}} : {{$family[$lang.'_name']}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/families')}}"> {{trans('admin.families')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.members')}}</li>
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
                    <a href="{{URL::to('admin/families_members/create?family_id='.$family['id'])}}" class="btn btn-lg bg-black">{{trans('admin.family_member_add')}}</a>
                </div>
                <div class="box-body">
                    <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
                        <thead>
                            <tr>
                                <th class="{{$text}}">{{trans('admin.name')}}</th>
                                <th class="{{$text}}">{{trans('admin.gender')}}</th>
                                <th class="{{$text}}">{{trans('admin.birth_date')}}</th>
                                <th class="{{$text}}">{{trans('admin.civil_id')}}</th>
                                <th class="{{$text}}">{{trans('admin.active')}}</th>
                                <th class="{{$text}}">{{trans('admin.edit')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($family['Members'] as $member)
                            <tr>
                                <td style="vertical-align: middle;">{{$member[$lang.'_name']}}</td>
                                <td style="vertical-align: middle;">{{trans('admin.'.$member['gender'])}}</td>
                                <td style="vertical-align: middle;">{{$member['birth_date']}}</td>
                                <td style="vertical-align: middle;">{{$member['civil_id']}}</td>
                                <td style="vertical-align: middle;">
                                    <label class="switch" style="margin-bottom: 0;">
                                        @if($member['active'] == 'yes')
                                        <input class="switch_active" page='families_members' id="{{$member['id']}}" type="checkbox" checked="">
                                        @else
                                        <input class="switch_active" page='families_members' id="{{$member['id']}}" type="checkbox">
                                        @endif
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ Form::open(array('url' =>'admin/families_members/'.$member->id.'/edit', 'method' => 'GET')) }}
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
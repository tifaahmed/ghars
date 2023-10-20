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
        {{trans('admin.ideas')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.ideas')}}</li>
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
                                <th class="{{$text}}">#</th>
                                <th class="{{$text}}">{{trans('admin.name')}}</th>
                                <th class="{{$text}}">{{trans('admin.phone')}}</th>
                                <th class="{{$text}}">{{trans('admin.type')}}</th>
                                <th class="{{$text}}">{{trans('admin.status')}}</th>
                                <th class="{{$text}}">{{trans('admin.reply')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($ideas as $idea)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$idea['name']}}</td>
                                <td>{{$idea['phone']}}</td>
                                <td>{{trans('admin.'.$idea['type'])}}</td>
                                <td>
                                    @if($idea['seen'] == "yes" && $idea['reply'] != "")
                                    {{trans('admin.seen_reply')}}
                                    @elseif($idea['seen'] == "yes" && $idea['reply'] == "")
                                    {{trans('admin.seen_reply_not')}}
                                    @elseif($idea['seen'] == "no" )
                                    {{trans('admin.seen_not')}}
                                    @endif
                                </td>
                                <td>
                                    {{ Form::open(array('url' =>'admin/ideas/'.$idea->id.'/edit', 'method' => 'GET')) }}
                                    <button  type="submit" class="btn default btn-sm btn-success"><i class="fa fa-edit"></i> {{trans('admin.reply')}} </button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            <?php $i++; ?>
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
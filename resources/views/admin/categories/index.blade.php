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
        {{trans('admin.categories')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.categories')}}</li>
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

            <div class="box">
                <div class="box-header">
                    <a href="{{URL::to('admin/categories/create')}}" class="btn btn-lg bg-black">{{trans('admin.category_add')}}</a>
                    <button type="button" data-toggle="modal" data-target="#Modal" class="btn btn-lg bg-black">{{trans('admin.delete_all')}}</button>
                </div>
                <div class="box-body">
                    <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
                        <thead>
                            <tr> 
                                <th class="{{$text}}">{{trans('admin.category')}}</th>
                                <th class="{{$text}}">{{trans('admin.active')}}</th>
                                <th class="{{$text}}">{{trans('admin.steps')}}</th>
                                <th class="{{$text}}">{{trans('admin.edit')}}</th>
                                <th class="{{$text}}">{{trans('admin.delete')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td style="vertical-align: middle;">{{$category[$lang.'_name']}}</td>
                                <td style="vertical-align: middle;">
                                    <label class="switch" style="margin-bottom: 0;">
                                        @if($category['active'] == 'yes')
                                        <input class="switch_active" page='categories' id="{{$category['id']}}" type="checkbox" checked="">
                                        @else
                                        <input class="switch_active" page='categories' id="{{$category['id']}}" type="checkbox">
                                        @endif
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ Form::open(array('url' =>'admin/categories_steps/'.$category->id, 'method' => 'GET')) }}
                                    <button  type="submit" class="btn default btn-sm bg-maroon"><i class="fa fa-sitemap"></i> {{trans('admin.show')}} </button>
                                    {{ Form::close() }}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ Form::open(array('url' =>'admin/categories/'.$category->id.'/edit', 'method' => 'GET')) }}
                                    <button  type="submit" class="btn default btn-sm btn-success"><i class="fa fa-edit"></i> {{trans('admin.edit')}} </button>
                                    {{ Form::close() }}
                                </td>
                                <td style="vertical-align: middle;">
                                    <button type="button" class="btn default btn-sm bg-red" data-toggle="modal" data-target="#exampleModal{{$category['id']}}"><i class="fa fa-trash-o"></i> {{trans('admin.delete')}} </button>

                                    <div class="modal modal-danger fade" id="exampleModal{{$category['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{trans('admin.delete')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{trans('admin.delete_confirm')}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    {{ Form::open(array('url' =>'admin/categories/'.$category->id, 'method' => 'DELETE')) }}
                                                    <button  type="submit" class="btn bg-outline {{$pull}}" style="background: none; border: 1px solid #fff;">{{trans('admin.delete')}} </button>
                                                    {{ Form::close() }}
                                                    <button type="button" class="btn btn-outline {{$pulll}}" data-dismiss="modal">{{trans('admin.cancel')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {{ Form::open(array('url' =>'admin/delete_all/categories', 'method' => 'POST')) }}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{trans('admin.delete_all')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select id="ids" name="ids[]" class="form-control select2" multiple="multiple" data-placeholder="{{trans('admin.delete_all')}}" style="width: 100%;" required="">
                    @foreach($categories as $one)
                    <option value="{{$one['id']}}">{{$one[$lang.'_name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button  type="submit" class="btn btn-primary {{$pull}}">{{trans('admin.confrim')}} </button>
                <button type="button" class="btn btn-danger {{$pulll}}" data-dismiss="modal">{{trans('admin.cancel')}}</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
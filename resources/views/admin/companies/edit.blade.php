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
        {{trans('admin.companies')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/companies')}}"> {{trans('admin.companies')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.company_edit')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.company_edit')}} : {{$company['name']}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/companies/'.$company['id'])}}" method="post" enctype="multipart/form-data">
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
                                {{ Form::select('active', ['yes'=>trans('admin.yes_active') , 'yet'=>trans('admin.yet_active') , 'no'=>trans('admin.no_active')],$company['active'], ['class'=>'form-control select2','id'=>'active']) }}
                                @if($errors->has('active'))
                                <div class="alert alert-danger">{{$errors->first('active')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country_id" class="col-sm-3 col-form-label">{{trans('admin.country')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('country_id',$countries, $company['country_id'], ['class'=>'form-control select2','id'=>'country_id']) }}
                                @if($errors->has('country_id'))
                                <div class="alert alert-danger">{{$errors->first('country_id')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-3 col-form-label">{{trans('admin.company_name_ar')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('ar_name', $company['ar_name'], ['class'=>'form-control','id'=>'ar_name']) }}
                                @if($errors->has('ar_name'))
                                <div class="alert alert-danger">{{$errors->first('ar_name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-3 col-form-label">{{trans('admin.company_name_en')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('en_name', $company['en_name'], ['class'=>'form-control','id'=>'en_name']) }}
                                @if($errors->has('en_name'))
                                <div class="alert alert-danger">{{$errors->first('en_name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">{{trans('admin.owner_name')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('name', $company['name'], ['class'=>'form-control','id'=>'name']) }}
                                @if($errors->has('name'))
                                <div class="alert alert-danger">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">{{trans('admin.email')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('email', $company['email'], ['class'=>'form-control','id'=>'email']) }}
                                @if($errors->has('email'))
                                <div class="alert alert-danger">{{$errors->first('email')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">{{trans('admin.password')}}</label>
                            <div class="col-sm-9">
                                {{ Form::input('password','password', null, ['class'=>'form-control','id'=>'password']) }}
                                @if($errors->has('password'))
                                <div class="alert alert-danger">{{$errors->first('password')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label">{{trans('admin.phone')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('phone', $company['phone'], ['class'=>'form-control','id'=>'phone']) }}
                                @if($errors->has('phone'))
                                <div class="alert alert-danger">{{$errors->first('phone')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="whatsapp" class="col-sm-3 col-form-label">{{trans('admin.whatsapp')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('whatsapp', $company['whatsapp'], ['class'=>'form-control','id'=>'whatsapp']) }}
                                @if($errors->has('whatsapp'))
                                <div class="alert alert-danger">{{$errors->first('whatsapp')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="governate" class="col-sm-3 col-form-label">{{trans('admin.governate')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('governate', $company['governate'], ['class'=>'form-control','id'=>'governate']) }}
                                @if($errors->has('governate'))
                                <div class="alert alert-danger">{{$errors->first('governate')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-sm-3 col-form-label">{{trans('admin.city')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('city', $company['city'], ['class'=>'form-control','id'=>'city']) }}
                                @if($errors->has('city'))
                                <div class="alert alert-danger">{{$errors->first('city')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-sm-3 col-form-label">{{trans('admin.street')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('street', $company['street'], ['class'=>'form-control','id'=>'street']) }}
                                @if($errors->has('street'))
                                <div class="alert alert-danger">{{$errors->first('street')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categories" class="col-sm-3 col-form-label">{{trans('admin.categories')}}</label>
                            <div class="col-sm-9">
                                {{ Form::select('categories[]',$categories ,$company['Categories']->pluck('category_id'), ['class'=>'form-control select2','id'=>'category_id','data-placeholder'=>trans('admin.choose_category'),'style'=>'width: 100%;','multiple'=>'multiple']) }}
                                @if($errors->has('categories'))
                                <div class="alert alert-danger">{{$errors->first('categories')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" id="files">
                            <label class="col-sm-2 col-form-label {{$pull}}" id="file_1" style="margin-bottom: 10px;">{{trans('admin.file_name_ar')}}</label>
                            <div class="col-sm-2 {{$pull}}" id="file_2" style="margin-bottom: 10px;">
                                {{ Form::text('ar_names[]',null, ['class'=>'form-control','id'=>'ar_names']) }}
                            </div>
                            <label class="col-sm-2 col-form-label {{$pull}}" id="file_3" style="margin-bottom: 10px;">{{trans('admin.file_name_en')}}</label>
                            <div class="col-sm-2 {{$pull}}" id="file_4" style="margin-bottom: 10px;">
                                {{ Form::text('en_names[]',null, ['class'=>'form-control','id'=>'en_names']) }}
                            </div>
                            <label class="col-sm-1 col-form-label {{$pull}}" id="file_5" style="margin-bottom: 10px;">{{trans('admin.file')}}</label>
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
                                            <th class="{{$text}}">{{trans('admin.file_name_ar')}}</th>
                                            <th class="{{$text}}">{{trans('admin.file_name_en')}}</th>
                                            <th class="{{$text}}">{{trans('admin.status')}}</th>
                                            <th class="{{$text}}">{{trans('admin.file')}}</th>
                                            <th class="{{$text}}">{{trans('admin.edit')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($company['Files'] as $file)
                                        <tr>
                                            <td style="vertical-align: middle;">{{$file['ar_name']}}</td>
                                            <td style="vertical-align: middle;">{{$file['en_name']}}</td>
                                            <td style="vertical-align: middle;">{{trans('admin.approve_'.$file['active'])}}</td>
                                            <td style="vertical-align: middle;"><a target="_blank" href="{{url('upload/companies/'.$file['file'])}}" class="btn btn-sm btn-info">{{trans('admin.show')}}</a></td>
                                            <td style="vertical-align: middle;">
                                                @if($file['active'] == 'yet' || $file['active'] == 'no')
                                                <a href="{{url('admin/companies/'.$file['id'].'?active=yes')}}" class="btn btn-sm btn-success">{{trans('admin.approve_yes')}}</a>
                                                @endif
                                                @if($file['active'] == 'yet' || $file['active'] == 'yes')
                                                <a href="{{url('admin/companies/'.$file['id'].'?active=no')}}" class="btn btn-sm btn-danger">{{trans('admin.approve_no')}}</a>
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
                <a href="{{URL::to('admin/companies')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>

@endsection

@section('scripts')
<script>
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

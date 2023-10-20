@extends('admin.layouts.login')

@section('content')

<!-- /.login-logo -->
<div class="login-box-body">
    <p class="login-box-msg">{{trans('admin.sign_in')}}</p>

    <form action="{{URL::to('admin/login')}}" method="post" >
        {{ csrf_field() }}


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

        <div class="form-group has-feedback">
            <label>{{trans('admin.email')}}</label>
            {{ Form::text('email',null,['class'=>'form-control','required']) }}
        </div>
        <div class="form-group has-feedback">
            {{trans('admin.password')}}
            {{ Form::input('password','password',null,['class'=>'form-control','required']) }}
        </div>
        <div class="row">
            <div class="col-6">
                <div class="checkbox">
                    <input type="checkbox" name="remember" id="basic_checkbox_1" >
                    <label for="basic_checkbox_1">{{trans('admin.remember')}}</label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-6">
                <div class="fog-pwd">
                    <a href="{{URL::to('password/reset?from=web')}}"><i class="ion ion-locked"></i> {{trans('admin.forget_password')}}</a><br>
                </div>
            </div>
            <!--        /.col -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-info btn-block btn-flat margin-top-10">{{trans('admin.login')}}</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
</div>

<!-- /.login-box-body -->

@endsection
<?php
$lang = App::getLocale();
$code = '';
if ($country_info = \App\Http\Library\Location::get()) {
    $country = \App\Models\Country::where('iso', $country_info)->first();
    if ($country) {
        $code = $country['id'];
    }
}
if ($lang == 'en') {
    $p = 'pl-3';
} else {
    $p = 'pr-3';
}
?>
@extends('interface.layout')

@section('title')
{{trans('admin.login')}}/{{trans('admin.register')}}
@endsection

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="form-wrapper">
                    <h2>{{trans('admin.login')}}</h2>
                    <form action="{{url('login')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <i class="icon icon-email"></i>
                            {{ Form::text('email', null, ['class'=>'form-control','id'=>'email', 'placeholder'=>trans('admin.email').'*']) }}
                        </div>
                        <div class="form-group mb-3">
                            <i class="icon icon-password"></i>
                            {{ Form::input('password','password', null, ['class'=>'form-control','id'=>'password', 'placeholder'=>trans('admin.password').'*']) }}
                        </div>
                        <p class="text-right"><a href="#" data-toggle="modal" data-target="#forgotPass">{{trans('admin.forget_password')}}</a></p>
                        <div class="text-center">
                            <button type='submit' class="btn btn-lg btn-default">{{trans('admin.login')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-wrapper">
                    <h2>{{trans('admin.create_account')}}</h2>
                    <form action="{{url('register')}}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <i class="icon icon-user-2"></i>
                                    {{ Form::text('first_name', null, ['class'=>'form-control','id'=>'first_name', 'placeholder'=>trans('admin.first_name').'*']) }}
                                    @if($errors->has('first_name'))
                                    <div class="alert alert-danger">{{$errors->first('first_name')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <i class="icon icon-user-2"></i>
                                    {{ Form::text('last_name', null, ['class'=>'form-control','id'=>'last_name', 'placeholder'=>trans('admin.last_name').'*']) }}
                                    @if($errors->has('last_name'))
                                    <div class="alert alert-danger">{{$errors->first('last_name')}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <i class="icon icon-email"></i>
                            {{ Form::text('email', null, ['class'=>'form-control','id'=>'email', 'placeholder'=>trans('admin.email').'*']) }}
                            @if($errors->has('email'))
                            <div class="alert alert-danger">{{$errors->first('email')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <i class="icon icon-phone-2"></i>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {{ Form::select('code',$countries, $code, ['class'=>'custom-select','id'=>'code']) }}
                                </div>
                                {{ Form::text('phone', null, ['class'=>'form-control','id'=>'phone', 'placeholder'=>trans('admin.phone').'*']) }}
                            </div>
                            @if($errors->has('code'))
                            <div class="alert alert-danger">{{$errors->first('code')}}</div>
                            @endif
                            @if($errors->has('phone'))
                            <div class="alert alert-danger">{{$errors->first('phone')}}</div>
                            @endif                        
                        </div>
                        <div class="form-group">
                            <i class="icon icon-password"></i>
                            {{ Form::input('password','password', null, ['class'=>'form-control','id'=>'password', 'placeholder'=>trans('admin.password').'*']) }}
                            @if($errors->has('password'))
                            <div class="alert alert-danger">{{$errors->first('password')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <i class="icon icon-password"></i>
                            {{ Form::input('password','password_confirmation', null, ['class'=>'form-control','id'=>'password_confirmation', 'placeholder'=>trans('admin.password_confirmation').'*']) }}
                            @if($errors->has('password_confirmation'))
                            <div class="alert alert-danger">{{$errors->first('password_confirmation')}}</div>
                            @endif
                        </div>

                        <div class="custom-control custom-checkbox">
                            {{ Form::checkbox('agree','yes', false, ['class'=>'custom-control-input','id'=>'acceptTerms']) }}
                            <label class="custom-control-label" for="acceptTerms">{{trans('admin.agree')}} <a href="{{url('page/2')}}" target="_blank">{{$pages[1][$lang.'_title']}}</a>, <a href="{{url('page/3')}}" target="_blank">{{$pages[2][$lang.'_title']}}</a> {{trans('admin.and')}} <a href="{{url('page/4')}}" target="_blank">{{$pages[3][$lang.'_title']}}</a> {{trans('admin.of')}}</label>
                            @if($errors->has('agree'))
                            <div class="alert alert-danger">{{$errors->first('agree')}}</div>
                            @endif
                        </div>
                        <div class="text-center">
                            <button type='submit' class="btn btn-lg btn-default">{{trans('admin.register')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="forgotPass" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">{{trans('admin.forget_password')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('forget_password')}}" method="post">
                    {{ csrf_field() }}
                    <p>{{trans('admin.forget_password_1')}}</p>
                    <div class="form-wrapper">
                        <div class="form-group mb-0">
                            <i class="icon icon-email"></i>
                            {{ Form::text('email', null, ['class'=>'form-control','id'=>'email', 'placeholder'=>trans('admin.email').'*','required']) }}
                        </div>
                        <div class="text-center">
                            <button type='submit' class="btn btn-lg btn-default">{{trans('admin.send')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if (Session::has('error'))
<script>
    $('.result_div').html('<i class="fas fa-exclamation-circle"></i><h4><?php echo trans('admin.error'); ?>!</h4><p><?php echo Session::get('error'); ?></p>');
    $('#result_message').modal('show');
</script>
@endif
@endsection

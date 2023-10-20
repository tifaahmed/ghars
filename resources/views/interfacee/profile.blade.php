<?php $lang = App::getLocale(); ?>
@extends('interface.layout')

@section('title')
{{trans('admin.profile')}}
@endsection

@section('content')
<section class="section">
    <div class="container">
        @include('interface.account')

        <div class="">
            <ul class="nav nav-pills justify-content-center" id="accountTabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('orders')}}">{{trans('admin.my_orders')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('addresses')}}">{{trans('admin.my_addresses')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('favorites')}}">{{trans('admin.wishlist')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{url('profile')}}">{{trans('admin.edit_profile')}}</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="form-wrapper">
                                <form action="{{url('profile')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <i class="icon icon-user-2"></i>
                                                {{ Form::text('first_name', Auth::User()->first_name, ['class'=>'form-control','id'=>'first_name', 'placeholder'=>trans('admin.first_name').'*']) }}
                                                @if($errors->has('first_name'))
                                                <div class="alert alert-danger">{{$errors->first('first_name')}}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <i class="icon icon-user-2"></i>
                                                {{ Form::text('last_name', Auth::User()->last_name, ['class'=>'form-control','id'=>'last_name', 'placeholder'=>trans('admin.last_name').'*']) }}
                                                @if($errors->has('last_name'))
                                                <div class="alert alert-danger">{{$errors->first('last_name')}}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>                                                        
                                    <div class="form-group mb-3">
                                        <i class="icon icon-phone-2"></i>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                {{ Form::select('code',$countries, Auth::User()->country_id, ['class'=>'custom-select','id'=>'code']) }}
                                            </div>
                                            {{ Form::text('phone', Auth::User()->phone, ['class'=>'form-control','id'=>'phone', 'placeholder'=>trans('admin.phone').'*']) }}
                                        </div>
                                        @if($errors->has('code'))
                                        <div class="alert alert-danger">{{$errors->first('code')}}</div>
                                        @endif
                                        @if($errors->has('phone'))
                                        <div class="alert alert-danger">{{$errors->first('phone')}}</div>
                                        @endif     
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-default">{{trans('admin.update_profile')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@if (Session::has('error'))
<script>
    $('.result_div').html('<i class="fas fa-exclamation-circle"></i><h4><?php echo trans('admin.error'); ?>!</h4><p><?php echo Session::get('error'); ?></p>');
    $('#result_message').modal('show');
</script>
@endif
@endsection

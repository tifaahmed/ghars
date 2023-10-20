<?php
$lang = App::getLocale();
if ($lang == 'en') {
    $p = 'pl-3';
    $dir = 'right';
} else {
    $p = 'pr-3';
    $dir = 'left';
}
?>
<div class="card account-header">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="media align-items-center">
                <img src="{{url('interface')}}/assets/images/avatar.png" alt="">
                <div class="media-body">
                    <h5 class="mt-0">{{Auth::User()->first_name.' '.Auth::User()->last_name}}</h5>
                    <p class="mb-0">{{Auth::User()->email}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-lg-{{$dir}} text-center mt-md-0 mt-5">
            <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#changePass">{{trans('admin.change_password')}}</a>
            <a href="{{url('logout')}}" class="btn btn-sm btn-default">{{trans('admin.logout')}}</a>
        </div>
    </div>
</div>



<div class="modal fade" id="changePass" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">{{trans('admin.change_password')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-wrapper">
                    <form action="{{url('change_password')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{ Form::input('password','old_password',null,['class'=>'form-control '.$p,'placeholder'=>trans('admin.old_password'),'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::input('password','new_password',null,['class'=>'form-control '.$p,'placeholder'=>trans('admin.new_password'),'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::input('password','new_password_confirmation',null,['class'=>'form-control '.$p,'placeholder'=>trans('admin.new_password_confirmation'),'required']) }}
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-default mt-0">{{trans('admin.change_password')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
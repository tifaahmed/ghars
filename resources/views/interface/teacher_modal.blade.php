<div class="modal loginModal fade" id="guarantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <img src="{{url('interface')}}/img/si.png" alt="" class="check__thumb">
            <div class="modal-body">         
                <form action="{{url('donation/teachers/'.$teacher['id'])}}" method="post" class="loginV__form">
                    {{ csrf_field() }}
                    {{ Form::hidden('pay_type','knet',['id'=>'pay_type']) }}

                    <h3 class="loginModal_title">{{trans('admin.donate')}} : {{$teacher[$lang.'_name']}}</h3>
                    <p class="logintModal_des">{{number_format($teacher['amount'] / $currency_info['equal'], $currency_info['currency_format'], '.', '') . ' ' . $currency_info[$lang . '_currency']}}</p>
                    <div class="form__row">
                        @if(!Auth::Check())
                        <div class="col-12 col-lg-6">
                            <label for="name" class="login__label">{{trans('admin.name')}}</label>
                            {{Form::text('name',null,['class'=>'loginV__input','required'])}}
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="email" class="login__label">{{trans('admin.email')}}</label>
                            {{Form::text('email',null,['class'=>'loginV__input'])}}
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="country_id" class="login__label">{{trans('admin.country')}}</label>
                            {{ Form::select('country_id',$countries, null, ['class'=>'loginV__input','id'=>'country_id','required']) }}
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="phone" class="login__label">{{trans('admin.phone')}}</label>
                            {{Form::text('phone',null,['class'=>'loginV__input','required'])}}
                        </div>
                        @else
                        {{ Form::hidden('country_id',Auth::User()->country_id, ['id'=>'country_id']) }}
                        @endif

                        <div class="col-12 col-lg-6">
                            <label for="time" class="login__label">{{trans('admin.donate_type')}}</label>
                            {{ Form::select('time',['always'=>trans('admin.always_time'),'one'=>trans('admin.one_time')], null, ['class'=>'loginV__input nice-select','id'=>'time','required']) }}
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="gift" class="login__label">{{trans('admin.as_gift')}}</label>
                            {{ Form::select('gift',['no'=>trans('admin.no'),'yes'=>trans('admin.yes')], null, ['class'=>'loginV__input nice-select','id'=>'gift','required']) }}
                        </div>
                        <div class="col-12 col-lg-12 gift_name">
                            <label for="gift_name" class="login__label">{{trans('admin.name')}}</label>
                            {{Form::text('gift_name',null,['class'=>'loginV__input'])}}
                        </div>

                        <ul class="nav nav-pills Gurpayment__pills">
                            <li class="nav-item">
                                <a class="nav-link pay_type active" value="knet" href="#payOne__wrapper" data-toggle="tab"> 
                                    <span class="showG__radio"></span>
                                    <span>{{trans('admin.knet')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pay_type" value="visit" href="#visitM__wrapper" data-toggle="tab"> 
                                    <span class="showG__radio"></span>
                                    <span>{{trans('admin.visit')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pay_type" value="headquarter" href="#branch__wrapper" data-toggle="tab"> 
                                    <span class="showG__radio"></span>
                                    <span>{{trans('admin.headquarter')}}</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content"  id="allGurntPay__tabs">
                            <div class="curr__wrapper tab-pane fade in active show" role="tabpanel" id="payOne__wrapper">

                            </div>
                            <div class="curr__wrapper tab-pane fade" role="tabpanel" id="visitM__wrapper">

                            </div>
                            <div class="curr__wrapper tab-pane fade" role="tabpanel" id="branch__wrapper">

                            </div>
                        </div> 

                    </div>
                    <button class="login__btn" type='submiut'>{{trans('admin.donate')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal loginModal fade" id="giftModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <img src="{{url('interface')}}/img/si.png" alt="" class="check__thumb">
            <div class="modal-body">         
                <form action="{{url('gift/teachers/'.$teacher['id'])}}" method="post" class="loginV__form">
                    {{ csrf_field() }}
                    {{ Form::hidden('gift_id',null,['id'=>'gift_id']) }}

                    <h3 class="loginModal_title">{{trans('admin.teacher_gift')}}</h3>
                    <p class="logintModal_des">{{$teacher[$lang.'_name']}}</p>
                    <div class="form__row">
                        <div class="col-12 col-lg-6">
                            <label for="gift_name" class="login__label">{{trans('admin.gift_name')}}</label>
                            {{Form::text('gift_name',null,['class'=>'loginV__input','id'=>'gift_name','readonly'])}}
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="gift_amount" class="login__label">{{trans('admin.amount')}}</label>
                            {{Form::text('gift_amount',null,['class'=>'loginV__input','id'=>'gift_amount','readonly'])}}
                        </div>

                        @if(!Auth::Check())
                        <div class="col-12 col-lg-6">
                            <label for="name" class="login__label">{{trans('admin.name')}}</label>
                            {{Form::text('name',null,['class'=>'loginV__input','required'])}}
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="email" class="login__label">{{trans('admin.email')}}</label>
                            {{Form::text('email',null,['class'=>'loginV__input'])}}
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="gift_country_id" class="login__label">{{trans('admin.country')}}</label>
                            {{ Form::select('country_id',$countries, null, ['class'=>'loginV__input','id'=>'gift_country_id','required']) }}
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="phone" class="login__label">{{trans('admin.phone')}}</label>
                            {{Form::text('phone',null,['class'=>'loginV__input','required'])}}
                        </div>
                        @endif

                    </div>
                    <button class="login__btn" type='submiut'>{{trans('admin.teacher_gift')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
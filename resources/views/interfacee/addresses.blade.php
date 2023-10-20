<?php
$lang = App::getLocale();
if ($lang == 'en') {
    $p = 'pl-3';
    $m = 'ml-3';
} else {
    $p = 'pr-3';
    $m = 'mr-3';
}
?>
@extends('interface.layout')

@section('title')
{{trans('admin.my_addresses')}}
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
                    <a class="nav-link active" href="{{url('addresses')}}">{{trans('admin.my_addresses')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('favorites')}}">{{trans('admin.wishlist')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('profile')}}">{{trans('admin.edit_profile')}}</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="shipping-address">
                                <h4 class="mb-3">{{trans('admin.shipping_address')}}</h4>
                                <p class="mb-5">{{trans('admin.you_have').' '.count($addresses).' '.trans('admin.saved_addresses')}}</p>
                                <div class="adresses row">
                                    @foreach($addresses as $address)
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="address-action">
                                                <a href="{{url('remove_address/'.$address['id'])}}" title="{{trans('admin.del_address')}}"><i class="far fa-trash-alt"></i></a>
                                                <a href="#" title="{{trans('admin.editt_address')}}" class='edit_address' address='{{$address['id']}}'><i class="fas fa-pencil-alt"></i></a>
                                            </div>
                                            <label class="mb-0">
                                                <strong>{{$address['address_name']}}</strong><br>
                                                {{$address['Country'][$lang.'_name']}}, {{$address['City'][$lang.'_name']}}<br>
                                                <span dir="ltr">{{$address['Country']['code'].$address['phone']}}</span><br>
                                                {{$address['address_line_1']}}<br>
                                                {{$address['address_line_2']}}<br>
                                                {{$address['postal_code']}}<br>
                                                {{$address['notes']}}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 offset-sm-1">
                            <div class="form-wrapper" style="margin-top: 110px;">
                                <form action="{{url('address_add')}}" method="post">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        {{ Form::select('country_id',$countries,null,['class'=>'form-control '.$p,'id'=>'country_id']) }}
                                        @if($errors->has('country_id'))
                                        <div class="alert alert-danger">{{$errors->first('country_id')}}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div id='cities'>
                                            {{ Form::select('city_id',[''=>trans('admin.city').'*'],null,['class'=>'form-control '.$p,'id'=>'city_id']) }}
                                        </div>
                                        @if($errors->has('city_id'))
                                        <div class="alert alert-danger">{{$errors->first('city_id')}}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        {{ Form::text('address_name',null,['class'=>'form-control '.$p,'id'=>'address_name','placeholder'=>trans('admin.address_name').'*']) }}
                                        @if($errors->has('address_name'))
                                        <div class="alert alert-danger">{{$errors->first('address_name')}}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                {{ Form::text('code',null,['class'=>'custom-select '.$m,'id'=>'code','readonly','placeholder'=>trans('admin.code').'*','style'=>'background:none;']) }}
                                            </div>
                                            {{ Form::text('phone',null,['class'=>'form-control '.$p,'id'=>'phone','placeholder'=>trans('admin.phonee').'*']) }}
                                        </div>
                                        @if($errors->has('phone'))
                                        <div class="alert alert-danger">{{$errors->first('phone')}}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {{ Form::text('address_line_1',null,['class'=>'form-control '.$p,'id'=>'address_line_1','placeholder'=>trans('admin.address_line_1').'*']) }}
                                        @if($errors->has('address_line_1'))
                                        <div class="alert alert-danger">{{$errors->first('address_line_1')}}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {{ Form::text('address_line_2',null,['class'=>'form-control '.$p,'id'=>'address_line_2','placeholder'=>trans('admin.address_line_2').'('.trans('admin.optional').')']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::text('postal_code',null,['class'=>'form-control '.$p,'id'=>'postal_code','placeholder'=>trans('admin.postal_code').'('.trans('admin.optional').')']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::textarea('notes',null,['class'=>'form-control '.$p,'id'=>'notes','placeholder'=>trans('admin.address_notes').'('.trans('admin.optional').')']) }}
                                    </div>
                                    <div class="text-center">
                                        {{Form::hidden('user_id',Auth::User()->id)}}
                                        <button type="submit" class="btn btn-lg btn-default mt-0">{{trans('admin.addd_address')}}</button>
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

<div class="modal fade" id="editAddressModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">{{trans('admin.editt_address')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-wrapper" id="edit_address_form">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $("body").on("click", ".edit_address", function (e) {
        var address = $(this).attr('address');
        $('#edit_address_form').html('<div class="col-md-12 col-xl-12 text-center loading"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');
        var link = '<?php echo url('/'); ?>';
        $('#editAddressModal').modal('show');
        $.ajax({
            type: "GET",
            url: link + "/address/" + address,
            success: function (data) {
                $('#edit_address_form').html(data);
            }
        });

    });

    $("body").on("change", "#country_id", function (e) {
        var country_id = $(this).val();
        var link = '<?php echo url('/'); ?>';
        if (country_id == "") {
            country_id = 0;
        }
        $.ajax({
            type: "GET",
            url: link + "/ajax_cities/" + country_id,
            success: function (data) {
                $('#cities').html(data);
            }
        });
        $.ajax({
            type: "GET",
            url: link + "/ajax_code/" + country_id,
            success: function (data) {
                $('#code').val(data);
            }
        });
    });

    $("body").on("change", "#country_id_edit", function (e) {
        var country_id = $(this).val();
        var city_id = $(this).attr('city');
        var link = '<?php echo url('/'); ?>';
        if (country_id == "") {
            country_id = 0;
        }
        $.ajax({
            type: "GET",
            url: link + "/ajax_cities/" + country_id + '?value=' + city_id,
            success: function (data) {
                $('#cities_edit').html(data);
            }
        });
        $.ajax({
            type: "GET",
            url: link + "/ajax_code/" + country_id,
            success: function (data) {
                $('#code_edit').val(data);
            }
        });
    });

    $("body").on("submit", "#submit_address_form", function (e) {
        var country_id = $('#country_id_edit').val();
        var city_id = $('#city_id_edit').val();
        var address_name = $('#address_name_edit').val();
        var phone = $('#phone_edit').val();
        var address_line_1 = $('#address_line_1_edit').val();
        if (country_id == '') {
            $('#address_edit_result').html('<div class="alert alert-danger"><?php echo trans('admin.enter_country'); ?></div>');
            e.preventDefault();
        }
        if (city_id == '') {
            $('#address_edit_result').html('<div class="alert alert-danger"><?php echo trans('admin.enter_city'); ?></div>');
            e.preventDefault();
        }
        if (address_name == '') {
            $('#address_edit_result').html('<div class="alert alert-danger"><?php echo trans('admin.enter_address_name'); ?></div>');
            e.preventDefault();
        }
        if (phone == '') {
            $('#address_edit_result').html('<div class="alert alert-danger"><?php echo trans('admin.enter_phone'); ?></div>');
            e.preventDefault();
        }
        if (address_line_1 == '') {
            $('#address_edit_result').html('<div class="alert alert-danger"><?php echo trans('admin.enter_address_line_1'); ?></div>');
            e.preventDefault();
        }
    });

    var country_id = $('#country_id').val();
    var link = '<?php echo url('/'); ?>';
    if (country_id == "") {
        country_id = 0;
    }
    $.ajax({
        type: "GET",
        url: link + "/ajax_cities/" + country_id,
        success: function (data) {
            $('#cities').html(data);
        }
    });
    $.ajax({
        type: "GET",
        url: link + "/ajax_code/" + country_id,
        success: function (data) {
            $('#code').val(data);
        }
    });
</script>

@if (Session::has('error'))
<script>
    $('.result_div').html('<i class="fas fa-exclamation-circle"></i><h4><?php echo trans('admin.error'); ?>!</h4><p><?php echo Session::get('error'); ?></p>');
    $('#result_message').modal('show');
</script>
@endif
@endsection

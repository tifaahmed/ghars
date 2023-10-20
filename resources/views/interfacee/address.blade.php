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
<form action="{{url('address/'.$address['id'])}}" method="post" id="submit_address_form">
    {{ csrf_field() }}

    <div class="form-group">
        {{ Form::select('country_id',$countries,$address['country_id'],['class'=>'form-control '.$p,'id'=>'country_id_edit','city'=>$address['city_id'],'required']) }}
    </div>

    <div class="form-group">
        <div id='cities_edit'>
            {{ Form::select('city_id',$cities,$address['city_id'],['class'=>'form-control '.$p,'id'=>'city_id_edit','required']) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::text('address_name',$address['address_name'],['class'=>'form-control '.$p,'id'=>'address_name_edit','placeholder'=>trans('admin.address_name').'*','required']) }}
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                {{ Form::text('code',$address['Country']['code'],['class'=>'custom-select '.$m,'id'=>'code_edit','readonly','placeholder'=>trans('admin.code').'*','style'=>'background:none;','required']) }}
            </div>
            {{ Form::text('phone',$address['phone'],['class'=>'form-control '.$p,'id'=>'phone_edit','placeholder'=>trans('admin.phonee').'*','required']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::text('address_line_1',$address['address_line_1'],['class'=>'form-control '.$p,'id'=>'address_line_1_edit','placeholder'=>trans('admin.address_line_1').'*','required']) }}
    </div>
    <div class="form-group">
        {{ Form::text('address_line_2',$address['address_line_2'],['class'=>'form-control '.$p,'id'=>'address_line_2','placeholder'=>trans('admin.address_line_2').'('.trans('admin.optional').')']) }}
    </div>
    <div class="form-group">
        {{ Form::text('postal_code',$address['postal_code'],['class'=>'form-control '.$p,'id'=>'postal_code','placeholder'=>trans('admin.postal_code').'('.trans('admin.optional').')']) }}
    </div>
    <div class="form-group">
        {{ Form::textarea('notes',$address['notes'],['class'=>'form-control '.$p,'id'=>'notes','placeholder'=>trans('admin.address_notes').'('.trans('admin.optional').')']) }}
    </div>
    
    <div class="form-group" id="address_edit_result">
    </div>
    
    <div class="text-center">
        {{Form::hidden('user_id',Auth::User()->id)}}
        <button type="submit" class="btn btn-lg btn-default mt-0">{{trans('admin.editt_address')}}</button>
    </div>
</form>
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
@if($value != '')
{{ Form::select('city_id',$cities,$value,['class'=>'form-control '.$p,'id'=>'city_id_edit']) }}
@else
{{ Form::select('city_id',$cities,$value,['class'=>'form-control '.$p,'id'=>'city_id']) }}
@endif

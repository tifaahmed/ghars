<?php
$lang = App::getLocale();
?>
@extends('interface.layout')

@section('title')
{{trans('admin.teachers')}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{trans('admin.teachers')}}</h3>
    </div>
</section>

<section class="orphans_section mainRelative_section">
    <div class="container pxLG-0">
        <div class="searchResults__wrap">
            <div class="row guarantee__inRow">
                @foreach($teachers as $teacher)
                <?php $donation = \App\Models\Donation::where('user_id', Auth::User()->id)->where('user_type', 'user')->where('rel_id', $teacher['id'])->where('category', 'teachers')->where('gift_id', 0)->orderBy('id', 'desc')->first(); ?>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="OGurant__card">
                        <a href="{{url('teacher/'.$teacher['id'])}}">
                            <div class="OGurant__CTop">
                                <span class="active__status" style="width: 110px;">
                                    {{trans('admin.pay_'.$donation['active'])}}
                                </span>
                                <img src="{{url('upload/teachers/'.$teacher['image'])}}" alt="{{$teacher[$lang.'_name']}}" class="OGurant__Chimg">
                                <div class="adABs__overlay">
                                    <h5 class="aDchild_name">{{$teacher[$lang.'_name']}}</h5>
                                    <span class="adChild_age">
                                        <?php
                                        $date1 = $teacher['birth_date'];
                                        $date2 = date('Y-m-d');
                                        $diff = abs(strtotime($date2) - strtotime($date1));
                                        ?>
                                        {{floor($diff / (365 * 60 * 60 * 24)) . ' ' . trans('admin.years')}}
                                    </span>
                                    <div class="aDtails_wrapper">
                                        <span>{{trans('admin.'.$teacher['gender'])}}</span>
                                        <span> 
                                            <img src="{{url('interface')}}/img/site.svg" alt="" class="siteTH_icon">
                                            <span>{{$teacher['Country'][$lang.'_name']}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="OGurant__Cbody">
                        <div class="aDInput__group">
                            <input type="text" class="profileV__input" value="{{$donation['amount']}}" readonly="">
                            <label for="" class="absAD__label">{{$donation[$lang . '_currency']}}</label>
                        </div>
                        <div class="aDbuttons_wrapper">                            
                            @if($donation['active'] == 'no')                       
                            <a href="{{url('donation_edit/yes/'.$donation['id'])}}"  class="contSubmit__btn subMidBtn_width my-0 w-100">{{trans('admin.donation_yes')}}</a>

                            @else
                            @if($donation['active'] == 'yet')
                            <a href="{{url('pay/'.$donation['id'])}}"  class="contSubmit__btn subMidBtn_width my-0 w-50">{{trans('admin.pay')}}</a>
                            @endif

                            <a href="{{url('donation_edit/no/'.$donation['id'])}}" class="stop__guarntee">{{trans("admin.donation_no")}}</a>                            
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

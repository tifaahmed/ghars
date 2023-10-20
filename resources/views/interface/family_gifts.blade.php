<?php
$lang = App::getLocale();
$dir = 'right';
if ($lang == 'ar') {
    $dir = 'left';
}
?>
@extends('interface.layout')

@section('title')
{{$family[$lang.'_name']}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{$family[$lang.'_name']}}</h3>
    </div>
</section>

<section class="profile_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row profileinV__row">
            <div class="col-12 col-md-5 col-lg-3">
                <div class="sideBar__menu">
                    <ul class="sideBar__list">
                        <li class="sideBar__item"> 
                            <a href="{{url('family/'.$family['id'].'?type=info')}}" class="sideBar__link">
                                <img src="{{url('interface')}}/img/profile-circle.png" alt="" class="profileTH_icon">
                                <span>{{trans('admin.sponsorship_info')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('family/'.$family['id'].'?type=social')}}" class="sideBar__link">
                                <img src="{{url('interface')}}/img/archive-book.png" alt="" class="profileTH_icon">
                                <span>{{trans('admin.sponsorship_social')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('family/'.$family['id'].'?type=member')}}" class="sideBar__link">
                                <img src="{{url('interface')}}/img/archive-book.png" alt="" class="profileTH_icon">
                                <span>{{trans('admin.members')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('family/'.$family['id'].'?type=reports')}}" class="sideBar__link">
                                <img src="{{url('interface')}}/img/task-square.png" alt="" class="profileTH_icon">
                                <span>{{trans('admin.reports')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('family/'.$family['id'].'?type=gift')}}" class="sideBar__link active_link">
                                <img src="{{url('interface')}}/img/wallet.png" alt="" class="profileTH_icon">
                                <span>{{trans('admin.family_gift')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-9">
                <div class="profInner_WrapDes">
                    <div class="myInfo__taBorder">
                        <h3 class="myInfo_title row">
                            <div class="col-12 col-lg-6">
                                {{trans('admin.family_gift')}}
                            </div>
                            <div class="col-12 col-lg-6">
                                <a class="contSubmit__btn subMidBtn_width" style="cursor: pointer; margin: 0; float: {{$dir}};" data-toggle="modal" data-target="#guarantModal">{{trans('admin.donate').' : '.$family['amount'] / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']}}</a>
                            </div>
                        </h3>
                        <div class="myINForm__Wrapz">
                            <div class="row guarantee__inRow">
                                @foreach($gifts as $gift)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <a href="#" class="orphanHappy__card" gift_id='{{$gift['id']}}' gift_name='{{$gift[$lang.'_name']}}' gift_amount='{{number_format($gift['amount'] / $currency_info['equal'], $currency_info['currency_format'], '.', '') . ' ' . $currency_info[$lang . '_currency']}}' data-toggle="modal" data-target="#giftModal">
                                        <div class="orphGift_thumb">
                                            <img src="{{url('upload/gifts/'.$gift['image'])}}" alt="{{$gift[$lang.'_name']}}" class="orphGift_img">
                                        </div>
                                        <h5 class="orphGift__name">{{$gift[$lang.'_name'].' '.$gift['amount'] / $currency_info['equal']. ' ' . $currency_info[$lang . '_currency'] }}</h5>
                                    </a>
                                </div>
                                @endforeach
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
@include('interface.family_modal')
<script>
    $(document).ready(function () {
        var gift = $('#gift').val();
        if (gift == 'yes') {
            $('.gift_name').show();
        } else {
            $('.gift_name').hide();
        }

        $("body").on("change", "#gift", function (e) {
            var gift = $('#gift').val();
            if (gift == 'yes') {
                $('.gift_name').show();
            } else {
                $('.gift_name').hide();
            }
        });

        var country_id = $('#country_id').val();
        var link = '<?php echo url('/'); ?>';
        if (country_id != "") {
            $.ajax({
                type: "GET",
                url: link + "/ajax_country/" + country_id,
                success: function (data) {
                    $('#allGurntPay__tabs').html(data);
                }
            });
        }

        $("body").on("change", "#country_id", function (e) {
            var country_id = $(this).val();
            var link = '<?php echo url('/'); ?>';
            if (country_id != "") {
                $.ajax({
                    type: "GET",
                    url: link + "/ajax_country/" + country_id,
                    success: function (data) {
                        $('#allGurntPay__tabs').html(data);
                    }
                });
            }
        });

        $("body").on("click", ".pay_type", function (e) {
            var pay_type = $(this).attr('value');
            $('#pay_type').val(pay_type);
        });

        $("body").on("click", ".orphanHappy__card", function (e) {
            var gift_id = $(this).attr('gift_id');
            var gift_name = $(this).attr('gift_name');
            var gift_amount = $(this).attr('gift_amount');
            $('#gift_id').val(gift_id);
            $('#gift_name').val(gift_name);
            $('#gift_amount').val(gift_amount);
        });
    });
</script>
@endsection


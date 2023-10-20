<?php
$lang = App::getLocale();
$dir = 'right';
if ($lang == 'ar') {
    $dir = 'left';
}
?>
@extends('interface.layout')

@section('title')
{{$teacher[$lang.'_name']}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{$teacher[$lang.'_name']}}</h3>
    </div>
</section>

<section class="profile_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row profileinV__row">
            <div class="col-12 col-md-5 col-lg-3">
                <div class="sideBar__menu">
                    <ul class="sideBar__list">
                        <li class="sideBar__item"> 
                            <a href="{{url('teacher/'.$teacher['id'].'?type=info')}}" class="sideBar__link">
                                <img src="{{url('interface')}}/img/profile-circle.png" alt="" class="profileTH_icon">
                                <span>{{trans('admin.sponsorship_info')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('teacher/'.$teacher['id'].'?type=qualification')}}" class="sideBar__link active_link">
                                <img src="{{url('interface')}}/img/archive-book.png" alt="" class="profileTH_icon">
                                <span>{{trans('admin.sponsorship_qualifications')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('teacher/'.$teacher['id'].'?type=oranization')}}" class="sideBar__link">
                                <img src="{{url('interface')}}/img/archive-book.png" alt="" class="profileTH_icon">
                                <span>{{trans('admin.sponsorship_oranization')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('teacher/'.$teacher['id'].'?type=video')}}" class="sideBar__link">
                                <img src="{{url('interface')}}/img/archive-book.png" alt="" class="profileTH_icon">
                                <span>{{trans('admin.videos')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('teacher/'.$teacher['id'].'?type=reports')}}" class="sideBar__link">
                                <img src="{{url('interface')}}/img/task-square.png" alt="" class="profileTH_icon">
                                <span>{{trans('admin.reports')}}</span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="{{url('teacher/'.$teacher['id'].'?type=gift')}}" class="sideBar__link">
                                <img src="{{url('interface')}}/img/wallet.png" alt="" class="profileTH_icon">
                                <span>{{trans('admin.teacher_gift')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-9">
                <div class="profInner_WrapDes">
                    <div class="myInfo__taBorder">
                        <h3 class="myInfo_title row">
                            <div class="col-12 col-lg-8">
                                {{trans('admin.sponsorship_qualifications')}}
                            </div>
                            <div class="col-12 col-lg-4">
                                <a class="contSubmit__btn subMidBtn_width" style="cursor: pointer; margin: 0; float: {{$dir}};"data-toggle="modal" data-target="#guarantModal">{{trans('admin.donate').' : '.$teacher['amount'] / $currency_info['equal'] . ' ' . $currency_info[$lang . '_currency']}}</a>
                            </div>
                        </h3>
                        <div class="myINForm__Wrapz">
                            <form action="" class="myProInfo__form">
                                <div class="form__row">
                                    <div class="col-12 col-lg-6">
                                        <label for="qualification" class="profileV__label">{{trans('admin.qualification')}}</label>
                                        <input type="text" class="profileV__input" value="{{$teacher[$lang.'_qualification']}}" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="qualification_source" class="profileV__label">{{trans('admin.qualification_source')}}</label>
                                        <input type="text" class="profileV__input" value="{{$teacher[$lang.'_qualification_source']}}" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="qualification_date" class="profileV__label">{{trans('admin.qualification_date')}}</label>
                                        <input type="text" class="profileV__input" value="{{$teacher['qualification_date']}}" disabled="">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="specialization" class="profileV__label">{{trans('admin.specialization')}}</label>
                                        <input type="text" class="profileV__input" value="{{$teacher[$lang.'_specialization']}}" disabled="">
                                    </div>  
                                    <div class="col-12 col-lg-6">
                                        <label for="career" class="profileV__label">{{trans('admin.career')}}</label>
                                        <input type="text" class="profileV__input" value="{{$teacher[$lang.'_career']}}" disabled="">
                                    </div>  
                                    <div class="col-12 col-lg-6">
                                        <label for="quran" class="profileV__label">{{trans('admin.quran')}}</label>
                                        <input type="text" class="profileV__input" value="{{$teacher[$lang.'_quran']}}" disabled="">
                                    </div>  
                                    <div class="col-12 col-lg-6">
                                        <label for="invitation" class="profileV__label">{{trans('admin.invitation')}}</label>
                                        <textarea class="profileV__input" disabled="">{{$teacher[$lang.'_invitation']}}</textarea>
                                    </div>  
                                    <div class="col-12 col-lg-6">
                                        <label for="social_activity" class="profileV__label">{{trans('admin.social_activity')}}</label>
                                        <textarea class="profileV__input" disabled="">{{$teacher[$lang.'_social']}}</textarea>
                                    </div>  
                                    <div class="col-12 col-lg-6">
                                        <label for="skills" class="profileV__label">{{trans('admin.skills')}}</label>
                                        <textarea class="profileV__input" disabled="">{{$teacher[$lang.'_skills']}}</textarea>
                                    </div>                                
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@include('interface.teacher_modal')
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
    });
</script>
@endsection


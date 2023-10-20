<?php
$lang = App::getLocale();
$active = 'active';
?>
@extends('interface.layout')

@section('title')
{{trans('admin.our_branches')}}
@endsection

@section('content')
<section class="section" style="min-height: 600px;">
    <div class="container">
        <h2 class="page-title mb-5 text-uppercase">{{trans('admin.our_branches')}}</h2>
        <ul class="nav nav-pills" id="branchesTabs">
            @foreach($countries as $country)
            <li class="nav-item" style="margin-bottom:10px;">
                <a class="nav-link btn-sm {{$active}} country_click" country='{{$country['id']}}' data-toggle="tab" href="#country_{{$country['id']}}">{{$country[$lang.'_name']}}</a>
            </li>
            <?php $active = ''; ?>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            <?php $active = 'active'; ?>
            @foreach($countries as $country)
            <div class="tab-pane fade show {{$active}}" id="country_{{$country['id']}}">
                <div class="row">
                    @foreach($country['BranchesActive'] as $branch)
                    <div class="col-md-4 col-sm-6">
                        <div class="card branch-box">
                            <img src="{{url('interface')}}/assets/images/icons/placeholder.svg" alt="{{$branch[$lang . '_name']}}">
                            <h3>{{$branch[$lang . '_name']}}</h3>
                            <p>{{$branch[$lang . '_desc']}}</p>
                            <ul class="branch-contacts list-unstyled">
                                <li><i class="fas fa-phone-alt"></i>{{$branch['phone']}}</li>
                                <li><i class="far fa-clock"></i>{{$branch[$lang . '_work_days']}}<br>{{$branch[$lang . '_work_time']}}</li>
                            </ul>
                            <a href="{{$branch['map']}}" target="_blank" class="btn btn-default">{{trans('admin.view_map')}}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <?php $active = ''; ?>
            @endforeach
        </div>
    </div>
</section>

<section class="branches">
    <?php $class = ''; ?>
    @foreach($countries as $country)
    <img src="{{url('upload/branches_countries/'.$country['map'])}}" class="mw-100 countries_images country_image_{{$country['id']}} {{$class}}" alt="{{$country[$lang.'_name']}}">
    <?php $class = 'd-none'; ?>
    @endforeach
</section>
@endsection

@section('scripts')
<script>
    $('.country_click').click(function () {
        var country = $(this).attr('country');
        $('.countries_images').each(function (i, obj) {
            $(this).addClass('d-none');
        });
        $('.country_image_' + country).removeClass('d-none');
    });
</script>
@endsection

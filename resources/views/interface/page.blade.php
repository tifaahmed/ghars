<?php $lang = App::getLocale(); ?>
@extends('interface.layout')

@section('title')
{{$page[$lang.'_title']}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{$page[$lang.'_title']}}</h3>
    </div>
</section>

<!--start about section-->
<section class="about_section mainRelative_section"  id="about_section">
    <div class="container pxLG-0">
        <div class="centerTile_wrap mbttom__lG">
            <div class="text-block text-justify" style="line-height: 32px;">
                {!! $page[$lang.'_desc'] !!}
            </div>
        </div>
    </div>
</section>

<section class="aboutBlue_section"  id="aboutBlue_section">
    <img src="{{url('upload/pages/'.$pages[2]['image'])}}" alt="{{$pages[2][$lang.'_title']}}" class="blueThumb__child">
    <div class="container pxLG-0">
        <div class="aboutBlue_row">
            <div class="col-12 col-lg-6 pxLG-0">
                <div class="blueInfo_wrap wow zoomIn" data-wow-offset="100" data-wow-duration="1s">
                    <h5>{{trans('admin.about')}}</h5>
                    <h3>{{$pages[2][$lang.'_title']}}</h3>
                    <p>{{Str::limit(strip_tags($pages[2][$lang.'_desc']),300)}}</p>
                    <a href="{{url('page/'.$pages[2]['id'])}}" class="main__btn wide__btn hvr-bounce-to-left">{{trans('admin.more')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="projects_section"  id="projects_section">
    <div class="container pxLG-0">
        <div class="centerTile_wrap">
            <h5>{{$site[$lang.'_title']}}</h5>
            <h3>{{trans('admin.discover')}}</h3>
        </div>
        <div class="row projects__row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="project__Card wow zoomIn" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="proThumb_cont prODone__bk">
                        <img src="{{url('interface')}}/img/p1.png" alt="" class="prodIconS">
                    </div>
                    <div class="proCard__CBody">
                        <a href="{{url('projects')}}" class="morePdk__link prODone__color">{{trans('admin.projects')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="project__Card wow zoomIn" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0.4s">
                    <div class="proThumb_cont prODtwo__bk">
                        <img src="{{url('interface')}}/img/p2.png" alt="" class="prodIconS">
                    </div>
                    <div class="proCard__CBody">
                        <a href="{{url('project_add')}}" class="morePdk__link prODtwo__color">{{trans('admin.project_private_add')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="project__Card wow zoomIn" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0.6s">
                    <div class="proThumb_cont prODthree__bk">
                        <img src="{{url('interface')}}/img/p3.png" alt="" class="prodIconS">
                    </div>
                    <div class="proCard__CBody">
                        <a href="{{url('sponsorships')}}" class="morePdk__link prODthree__color">{{trans('admin.sponsorships')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="project__Card wow zoomIn" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0.8s">
                    <div class="proThumb_cont prODfour__bk">
                        <img src="{{url('interface')}}/img/p4.png" alt="" class="prodIconS">
                    </div>
                    <div class="proCard__CBody">
                        <a href="{{url('calculator')}}" class="morePdk__link prODfour__color">{{trans('admin.calculator')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

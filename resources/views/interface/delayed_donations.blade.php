<?php $lang = App::getLocale(); ?>
@extends('interface.layout')

@section('title')
{{trans('admin.delayed_donations')}}
@endsection

@section('content')
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title">{{trans('admin.delayed_donations')}}</h3>
    </div>
</section>

<!--start profile section-->
<section class="profile_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row profileinV__row">
            <div class="col-12 col-md-12">
                <div class="profInner_WrapDes">
                    <div class="myInfo__taBorder">
                        <h3 class="myInfo_title">{{trans('admin.delayed_donations')}}</h3>
                        <div class="rTableOver_wrapper">
                            <table class="table reports__table">
                                <thead>
                                    <tr>
                                        <th scope="col">{{trans('admin.department')}}</th>
                                        <th scope="col">{{trans('admin.donate_for')}}</th>
                                        <th scope="col">{{trans('admin.amount')}}</th>
                                        <th scope="col">{{trans('admin.type')}}</th>
                                        <th scope="col">{{trans('admin.pay_type')}}</th>
                                        <th scope="col">{{trans('admin.as_gift')}}</th>
                                        <th scope="col">{{trans('admin.date')}}</th>
                                        <th scope="col">{{trans('admin.pay')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donations as $donation)
                                    <tr>
                                        <td>{{trans('admin.'.$donation['category'])}}</td>
                                        <td>
                                            @if($donation['category'] == 'childern' && $donation['rel_id'] > 0)
                                            {{$donation['Child'][$lang.'_name']}}
                                            @elseif($donation['category'] == 'families' && $donation['rel_id'] > 0)
                                            {{$donation['Family'][$lang.'_name']}}
                                            @elseif($donation['category'] == 'teachers' && $donation['rel_id'] > 0)
                                            {{$donation['Teacher'][$lang.'_name']}}
                                            @elseif($donation['category'] == 'projects' && $donation['rel_id'] > 0)
                                            {{$donation['Project'][$lang.'_name']}}
                                            @endif
                                        </td>
                                        <td>{{$donation['amount'].' '.$donation[$lang.'_currency']}}</td>
                                        <td>{{trans('admin.'.$donation['type'].'_time')}}</td>
                                        <td>{{trans('admin.'.$donation['pay_type'])}}</td>
                                        <td>
                                            @if($donation['gift_id'] != 0)
                                            {{$donation['Gift'][$lang.'_name']}}
                                            @endif
                                        </td>
                                        <td>{{$donation['created_at']->format('Y-m-d')}}</td>
                                        <td> <a style="color: #000;" href="{{url('pay/'.$donation['id'])}}" class="printRepo_link">{{trans('admin.pay')}}</a> </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
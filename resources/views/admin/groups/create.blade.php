@extends('admin.layouts.form')

@section('content')
<?php
$lang = App::getLocale();
$text = "text-left";
$pull = "pull-left";
if ($lang == "ar") {
    $text = "text-right";
    $pull = "pull-right";
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{trans('admin.groups')}}
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin')}}"> {{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item {{$pull}}"><a href="{{URL::to('admin/groups')}}"> {{trans('admin.groups')}}</a></li>
        <li class="breadcrumb-item active {{$pull}}">{{trans('admin.group_add')}}</li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.group_add')}}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="{{URL::to('admin/groups')}}" method="post" >
            {{ csrf_field() }}

            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        @if (Session::has('message'))
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-success alert-dismissible">
                                    {{ Session::get('message')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-3 col-form-label">{{trans('admin.group_name_ar')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('ar_name', null, ['class'=>'form-control','id'=>'ar_name']) }}
                                @if($errors->has('ar_name'))
                                <div class="alert alert-danger">{{$errors->first('ar_name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-3 col-form-label">{{trans('admin.group_name_en')}}</label>
                            <div class="col-sm-9">
                                {{ Form::text('en_name', null, ['class'=>'form-control','id'=>'en_name']) }}
                                @if($errors->has('en_name'))
                                <div class="alert alert-danger">{{$errors->first('en_name')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr class="gray_check">
                                        <th class="text-center">{{trans('admin.permissions')}} </th>
                                        <th class="text-center">{{trans('admin.show_all')}}</th>
                                        <th class="text-center">{{trans('admin.add')}} </th>
                                        <th class="text-center">{{trans('admin.edit')}} </th>
                                        <th class="text-center">{{trans('admin.show')}} </th>
                                        <th class="text-center">{{trans('admin.delete')}} </th>
                                    </tr>
                                </thead>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_site" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_site_value">
                                        {{trans('admin.site')}}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'site_edit',false,['id'=>'site_edit','class'=>'check_site']) }}
                                            <label for="site_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_social_media" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_social_media_value">
                                        {{trans('admin.social_media')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'social_media_all',false,['id'=>'social_media_all','class'=>'check_social_media']) }}
                                            <label for="social_media_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'social_media_edit',false,['id'=>'social_media_edit','class'=>'check_social_media']) }}
                                            <label for="social_media_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_currencies" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_currencies_value">
                                        {{trans('admin.currencies')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'currencies_all',false,['id'=>'currencies_all','class'=>'check_currencies']) }}
                                            <label for="currencies_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'currencies_edit',false,['id'=>'currencies_edit','class'=>'check_currencies']) }}
                                            <label for="currencies_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_countries" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_countries_value">
                                        {{trans('admin.countries')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'countries_all',false,['id'=>'countries_all','class'=>'check_countries']) }}
                                            <label for="countries_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'countries_edit',false,['id'=>'countries_edit','class'=>'check_countries']) }}
                                            <label for="countries_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_log" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_log_value">
                                        {{trans('admin.log')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'log_all',false,['id'=>'log_all','class'=>'check_log']) }}
                                            <label for="log_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_notifications" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_notifications_value">
                                        {{trans('admin.notifications')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'notifications_all',false,['id'=>'notifications_all','class'=>'check_notifications']) }}
                                            <label for="notifications_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'notifications_add',false,['id'=>'notifications_add','class'=>'check_notifications']) }}
                                            <label for="notifications_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_groups" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_groups_value">
                                        {{trans('admin.groups')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'groups_all',false,['id'=>'groups_all','class'=>'check_groups']) }}
                                            <label for="groups_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'groups_add',false,['id'=>'groups_add','class'=>'check_groups']) }}
                                            <label for="groups_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'groups_edit',false,['id'=>'groups_edit','class'=>'check_groups']) }}
                                            <label for="groups_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'groups_delete',false,['id'=>'groups_delete','class'=>'check_groups']) }}
                                            <label for="groups_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_admins" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_admins_value">
                                        {{trans('admin.admins')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'admins_all',false,['id'=>'admins_all','class'=>'check_admins']) }}
                                            <label for="admins_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'admins_add',false,['id'=>'admins_add','class'=>'check_admins']) }}
                                            <label for="admins_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'admins_edit',false,['id'=>'admins_edit','class'=>'check_admins']) }}
                                            <label for="admins_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'admins_delete',false,['id'=>'admins_delete','class'=>'check_admins']) }}
                                            <label for="admins_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_users" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_users_value">
                                        {{trans('admin.users')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'users_all',false,['id'=>'users_all','class'=>'check_users']) }}
                                            <label for="users_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'users_add',false,['id'=>'users_add','class'=>'check_users']) }}
                                            <label for="users_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'users_edit',false,['id'=>'users_edit','class'=>'check_users']) }}
                                            <label for="users_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'users_delete',false,['id'=>'users_delete','class'=>'check_users']) }}
                                            <label for="users_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_visitors" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_visitors_value">
                                        {{trans('admin.visitors')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'visitors_all',false,['id'=>'visitors_all','class'=>'check_visitors']) }}
                                            <label for="visitors_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_companies" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_companies_value">
                                        {{trans('admin.companies')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'companies_all',false,['id'=>'companies_all','class'=>'check_companies']) }}
                                            <label for="companies_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'companies_add',false,['id'=>'companies_add','class'=>'check_companies']) }}
                                            <label for="companies_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'companies_edit',false,['id'=>'companies_edit','class'=>'check_companies']) }}
                                            <label for="companies_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_portfolio" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_portfolio_value">
                                        {{trans('admin.portfolio')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'portfolio_all',false,['id'=>'portfolio_all','class'=>'check_portfolio']) }}
                                            <label for="portfolio_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'portfolio_add',false,['id'=>'portfolio_add','class'=>'check_portfolio']) }}
                                            <label for="portfolio_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'portfolio_edit',false,['id'=>'portfolio_edit','class'=>'check_portfolio']) }}
                                            <label for="portfolio_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'portfolio_show',false,['id'=>'portfolio_show','class'=>'check_portfolio']) }}
                                            <label for="portfolio_show" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'portfolio_delete',false,['id'=>'portfolio_delete','class'=>'check_portfolio']) }}
                                            <label for="portfolio_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_ideas" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_ideas_value">
                                        {{trans('admin.ideas')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'ideas_all',false,['id'=>'ideas_all','class'=>'check_ideas']) }}
                                            <label for="ideas_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'ideas_edit',false,['id'=>'ideas_edit','class'=>'check_ideas']) }}
                                            <label for="ideas_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_categories" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_categories_value">
                                        {{trans('admin.categories')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'categories_all',false,['id'=>'categories_all','class'=>'check_categories']) }}
                                            <label for="categories_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'categories_add',false,['id'=>'categories_add','class'=>'check_categories']) }}
                                            <label for="categories_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'categories_edit',false,['id'=>'categories_edit','class'=>'check_categories']) }}
                                            <label for="categories_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'categories_delete',false,['id'=>'categories_delete','class'=>'check_categories']) }}
                                            <label for="categories_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_projects" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_projects_value">
                                        {{trans('admin.projects')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'projects_all',false,['id'=>'projects_all','class'=>'check_projects']) }}
                                            <label for="projects_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'projects_add',false,['id'=>'projects_add','class'=>'check_projects']) }}
                                            <label for="projects_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'projects_edit',false,['id'=>'projects_edit','class'=>'check_projects']) }}
                                            <label for="projects_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'projects_show',false,['id'=>'projects_show','class'=>'check_projects']) }}
                                            <label for="projects_show" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_gifts" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_gifts_value">
                                        {{trans('admin.gifts')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'gifts_all',false,['id'=>'gifts_all','class'=>'check_gifts']) }}
                                            <label for="gifts_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'gifts_add',false,['id'=>'gifts_add','class'=>'check_gifts']) }}
                                            <label for="gifts_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'gifts_edit',false,['id'=>'gifts_edit','class'=>'check_gifts']) }}
                                            <label for="gifts_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'gifts_delete',false,['id'=>'gifts_delete','class'=>'gifts_delete']) }}
                                            <label for="gifts_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_childern" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_childern_value">
                                        {{trans('admin.childern')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'childern_all',false,['id'=>'childern_all','class'=>'check_childern']) }}
                                            <label for="childern_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'childern_add',false,['id'=>'childern_add','class'=>'check_childern']) }}
                                            <label for="childern_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'childern_edit',false,['id'=>'childern_edit','class'=>'check_childern']) }}
                                            <label for="childern_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'childern_show',false,['id'=>'childern_show','class'=>'check_childern']) }}
                                            <label for="childern_show" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_families" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_families_value">
                                        {{trans('admin.families')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'families_all',false,['id'=>'families_all','class'=>'check_families']) }}
                                            <label for="families_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'families_add',false,['id'=>'families_add','class'=>'check_families']) }}
                                            <label for="families_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'families_edit',false,['id'=>'families_edit','class'=>'check_families']) }}
                                            <label for="families_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'families_show',false,['id'=>'families_show','class'=>'check_families']) }}
                                            <label for="families_show" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_teachers" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_teachers_value">
                                        {{trans('admin.teachers')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'teachers_all',false,['id'=>'teachers_all','class'=>'check_teachers']) }}
                                            <label for="teachers_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'teachers_add',false,['id'=>'teachers_add','class'=>'check_teachers']) }}
                                            <label for="teachers_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'teachers_edit',false,['id'=>'teachers_edit','class'=>'check_teachers']) }}
                                            <label for="teachers_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'teachers_show',false,['id'=>'teachers_show','class'=>'check_teachers']) }}
                                            <label for="teachers_show" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_donations" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_donations_value">
                                        {{trans('admin.donations')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'donations_all',false,['id'=>'donations_all','class'=>'check_donations']) }}
                                            <label for="donations_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'donations_edit',false,['id'=>'donations_edit','class'=>'check_donations']) }}
                                            <label for="donations_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_tutorials" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_tutorials_value">
                                        {{trans('admin.tutorials')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'tutorials_all',false,['id'=>'tutorials_all','class'=>'check_tutorials']) }}
                                            <label for="tutorials_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'tutorials_add',false,['id'=>'tutorials_add','class'=>'check_tutorials']) }}
                                            <label for="tutorials_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'tutorials_edit',false,['id'=>'tutorials_edit','class'=>'check_tutorials']) }}
                                            <label for="tutorials_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'tutorials_delete',false,['id'=>'tutorials_delete','class'=>'check_tutorials']) }}
                                            <label for="tutorials_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_ads" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_ads_value">
                                        {{trans('admin.ads')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'ads_all',false,['id'=>'ads_all','class'=>'check_ads']) }}
                                            <label for="ads_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'ads_add',false,['id'=>'ads_add','class'=>'check_ads']) }}
                                            <label for="ads_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'ads_edit',false,['id'=>'ads_edit','class'=>'check_ads']) }}
                                            <label for="ads_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'ads_delete',false,['id'=>'ads_delete','class'=>'check_ads']) }}
                                            <label for="ads_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_slider" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_slider_value">
                                        {{trans('admin.slider')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'slider_all',false,['id'=>'slider_all','class'=>'check_slider']) }}
                                            <label for="slider_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'slider_add',false,['id'=>'slider_add','class'=>'check_slider']) }}
                                            <label for="slider_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'slider_edit',false,['id'=>'slider_edit','class'=>'check_slider']) }}
                                            <label for="slider_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'slider_delete',false,['id'=>'slider_delete','class'=>'check_slider']) }}
                                            <label for="slider_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_pages" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_pages_value">
                                        {{trans('admin.pages')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'pages_all',false,['id'=>'pages_all','class'=>'check_pages']) }}
                                            <label for="pages_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'pages_add',false,['id'=>'pages_add','class'=>'check_pages']) }}
                                            <label for="pages_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'pages_edit',false,['id'=>'pages_edit','class'=>'check_pages']) }}
                                            <label for="pages_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'pages_delete',false,['id'=>'pages_delete','class'=>'check_pages']) }}
                                            <label for="pages_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_contact" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_contact_value">
                                        {{trans('admin.contact')}}
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'contact_all',false,['id'=>'contact_all','class'=>'check_contact']) }}
                                            <label for="contact_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'contact_edit',false,['id'=>'contact_edit','class'=>'check_contact']) }}
                                            <label for="contact_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            {{ Form::checkbox('permissions[]', 'contact_delete',false,['id'=>'contact_delete','class'=>'check_contact']) }}
                                            <label for="contact_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">{{trans('admin.add')}}</button>
                <a href="{{URL::to('admin/groups')}}" class="btn btn-default btn-lg" style="font-size: 16px;">{{trans('admin.back')}}</a>
            </div>

        </form>

    </div>

</section>

@endsection

@section('scripts')
<script>
    $('.gray_check').click(function () {
        var rel = $(this).attr('rel');
        if ($('#' + rel + "_value").is(':checked')) {
            $('#' + rel + "_value").prop("checked", false);
            $('.' + rel).prop("checked", false);
        } else {
            $('#' + rel + "_value").prop("checked", true);
            $('.' + rel).prop("checked", true);
        }
    });
</script>
@stop
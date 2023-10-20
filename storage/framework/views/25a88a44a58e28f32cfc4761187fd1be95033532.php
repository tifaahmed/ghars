<?php $__env->startSection('content'); ?>
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
        <?php echo e(trans('admin.groups')); ?>

    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin')); ?>"> <?php echo e(trans('admin.home')); ?></a></li>
        <li class="breadcrumb-item <?php echo e($pull); ?>"><a href="<?php echo e(URL::to('admin/groups')); ?>"> <?php echo e(trans('admin.groups')); ?></a></li>
        <li class="breadcrumb-item active <?php echo e($pull); ?>"><?php echo e(trans('admin.group_edit')); ?></li>
    </ol>
</section>

<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('admin.group_edit')); ?> : <?php echo e($group[$lang.'_name']); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <form action="<?php echo e(URL::to('admin/groups/'.$group['id'])); ?>" method="post">
            <?php echo e(Form::hidden('_method','PATCH')); ?>

            <?php echo e(csrf_field()); ?>


            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        <?php if(Session::has('message')): ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-success alert-dismissible">
                                    <?php echo e(Session::get('message')); ?>

                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="form-group row">
                            <label for="ar_name" class="col-sm-3 col-form-label"><?php echo e(trans('admin.group_name_ar')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('ar_name', $group['ar_name'], ['class'=>'form-control','id'=>'ar_name'])); ?>

                                <?php if($errors->has('ar_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('ar_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en_name" class="col-sm-3 col-form-label"><?php echo e(trans('admin.group_name_en')); ?></label>
                            <div class="col-sm-9">
                                <?php echo e(Form::text('en_name', $group['en_name'], ['class'=>'form-control','id'=>'en_name'])); ?>

                                <?php if($errors->has('en_name')): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first('en_name')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                        $site_edit = $social_media_all = $social_media_edit = $currencies_all = $currencies_edit = $countries_all = $countries_edit = $log_all = $notifications_all = $notifications_add = $groups_all = $groups_add = $groups_edit = $groups_delete = $admins_all = $admins_add = $admins_edit = $admins_delete = $users_all = $users_add = $users_edit = $users_delete = $visitors_all = $companies_all = $companies_add = $companies_edit = $portfolio_all = $portfolio_add = $portfolio_edit =$portfolio_show =  $portfolio_delete = $ideas_all = $ideas_edit = $categories_all = $categories_add = $categories_edit = $categories_delete = $projects_all = $projects_add = $projects_edit = $projects_show = $gifts_all = $gifts_add = $gifts_edit = $gifts_delete = $childern_all = $childern_add = $childern_edit = $childern_show = $families_all = $families_add = $families_edit = $families_show = $teachers_all = $teachers_add = $teachers_edit = $teachers_show = $donations_all = $donations_edit = $tutorials_all = $tutorials_add = $tutorials_edit = $tutorials_delete = $ads_all = $ads_add = $ads_edit = $ads_delete = $slider_all = $slider_add = $slider_edit = $slider_delete = $pages_all = $pages_add = $pages_edit = $pages_delete = $contact_all = $contact_edit = $contact_delete = false;
                        foreach ($group['Permissions'] as $pre) {
                            if ($pre['permission'] == "site_edit") {
                                $site_edit = TRUE;
                            } elseif ($pre['permission'] == "social_media_all") {
                                $social_media_all = TRUE;
                            } elseif ($pre['permission'] == "social_media_edit") {
                                $social_media_edit = TRUE;
                            } elseif ($pre['permission'] == "currencies_all") {
                                $currencies_all = TRUE;
                            } elseif ($pre['permission'] == "currencies_edit") {
                                $currencies_edit = TRUE;
                            } elseif ($pre['permission'] == "countries_all") {
                                $countries_all = TRUE;
                            } elseif ($pre['permission'] == "countries_edit") {
                                $countries_edit = TRUE;
                            } elseif ($pre['permission'] == "log_all") {
                                $log_all = TRUE;
                            } elseif ($pre['permission'] == "notifications_all") {
                                $notifications_all = TRUE;
                            } elseif ($pre['permission'] == "notifications_add") {
                                $notifications_add = TRUE;
                            } elseif ($pre['permission'] == "groups_all") {
                                $groups_all = TRUE;
                            } elseif ($pre['permission'] == "groups_add") {
                                $groups_add = TRUE;
                            } elseif ($pre['permission'] == "groups_edit") {
                                $groups_edit = TRUE;
                            } elseif ($pre['permission'] == "groups_delete") {
                                $groups_delete = TRUE;
                            } elseif ($pre['permission'] == "admins_all") {
                                $admins_all = TRUE;
                            } elseif ($pre['permission'] == "admins_add") {
                                $admins_add = TRUE;
                            } elseif ($pre['permission'] == "admins_edit") {
                                $admins_edit = TRUE;
                            } elseif ($pre['permission'] == "admins_delete") {
                                $admins_delete = TRUE;
                            } elseif ($pre['permission'] == "users_all") {
                                $users_all = TRUE;
                            } elseif ($pre['permission'] == "users_add") {
                                $users_add = TRUE;
                            } elseif ($pre['permission'] == "users_edit") {
                                $users_edit = TRUE;
                            } elseif ($pre['permission'] == "users_delete") {
                                $users_delete = TRUE;
                            } elseif ($pre['permission'] == "visitors_all") {
                                $visitors_all = TRUE;
                            } elseif ($pre['permission'] == "companies_all") {
                                $companies_all = TRUE;
                            } elseif ($pre['permission'] == "companies_add") {
                                $companies_add = TRUE;
                            } elseif ($pre['permission'] == "companies_edit") {
                                $companies_edit = TRUE;
                            } elseif ($pre['permission'] == "portfolio_all") {
                                $portfolio_all = TRUE;
                            } elseif ($pre['permission'] == "portfolio_add") {
                                $portfolio_add = TRUE;
                            } elseif ($pre['permission'] == "portfolio_edit") {
                                $portfolio_edit = TRUE;
                            } elseif ($pre['permission'] == "portfolio_show") {
                                $portfolio_show = TRUE;
                            } elseif ($pre['permission'] == "portfolio_delete"){
                                $portfolio_delete = TRUE;
                            } elseif ($pre['permission'] == "ideas_all") {
                                $ideas_all = TRUE;
                            } elseif ($pre['permission'] == "ideas_edit") {
                                $ideas_edit = TRUE;
                            } elseif ($pre['permission'] == "categories_all") {
                                $categories_all = TRUE;
                            } elseif ($pre['permission'] == "categories_add") {
                                $categories_add = TRUE;
                            } elseif ($pre['permission'] == "categories_edit") {
                                $categories_edit = TRUE;
                            } elseif ($pre['permission'] == "categories_delete") {
                                $categories_delete = TRUE;
                            } elseif ($pre['permission'] == "projects_all") {
                                $projects_all = TRUE;
                            } elseif ($pre['permission'] == "projects_add") {
                                $projects_add = TRUE;
                            } elseif ($pre['permission'] == "projects_edit") {
                                $projects_edit = TRUE;
                            } elseif ($pre['permission'] == "projects_show") {
                                $projects_show = TRUE;
                            } elseif ($pre['permission'] == "gifts_all") {
                                $gifts_all = TRUE;
                            } elseif ($pre['permission'] == "gifts_add") {
                                $gifts_add = TRUE;
                            } elseif ($pre['permission'] == "gifts_edit") {
                                $gifts_edit = TRUE;
                            } elseif ($pre['permission'] == "gifts_delete") {
                                $gifts_delete = TRUE;
                            } elseif ($pre['permission'] == "childern_all") {
                                $childern_all = TRUE;
                            } elseif ($pre['permission'] == "childern_add") {
                                $childern_add = TRUE;
                            } elseif ($pre['permission'] == "childern_edit") {
                                $childern_edit = TRUE;
                            } elseif ($pre['permission'] == "childern_show") {
                                $childern_show = TRUE;
                            } elseif ($pre['permission'] == "families_all") {
                                $families_all = TRUE;
                            } elseif ($pre['permission'] == "families_add") {
                                $families_add = TRUE;
                            } elseif ($pre['permission'] == "families_edit") {
                                $families_edit = TRUE;
                            } elseif ($pre['permission'] == "families_show") {
                                $families_show = TRUE;
                            } elseif ($pre['permission'] == "teachers_all") {
                                $teachers_all = TRUE;
                            } elseif ($pre['permission'] == "teachers_add") {
                                $teachers_add = TRUE;
                            } elseif ($pre['permission'] == "teachers_edit") {
                                $teachers_edit = TRUE;
                            } elseif ($pre['permission'] == "teachers_show") {
                                $teachers_show = TRUE;
                            } elseif ($pre['permission'] == "donations_all") {
                                $donations_all = TRUE;
                            } elseif ($pre['permission'] == "donations_edit") {
                                $donations_edit = TRUE;
                            } elseif ($pre['permission'] == "tutorials_all") {
                                $tutorials_all = TRUE;
                            } elseif ($pre['permission'] == "tutorials_add") {
                                $tutorials_add = TRUE;
                            } elseif ($pre['permission'] == "tutorials_edit") {
                                $tutorials_edit = TRUE;
                            } elseif ($pre['permission'] == "tutorials_delete") {
                                $tutorials_delete = TRUE;
                            } elseif ($pre['permission'] == "ads_all") {
                                $ads_all = TRUE;
                            } elseif ($pre['permission'] == "ads_add") {
                                $ads_add = TRUE;
                            } elseif ($pre['permission'] == "ads_edit") {
                                $ads_edit = TRUE;
                            } elseif ($pre['permission'] == "ads_delete") {
                                $ads_delete = TRUE;
                            } elseif ($pre['permission'] == "slider_all") {
                                $slider_all = TRUE;
                            } elseif ($pre['permission'] == "slider_add") {
                                $slider_add = TRUE;
                            } elseif ($pre['permission'] == "slider_edit") {
                                $slider_edit = TRUE;
                            } elseif ($pre['permission'] == "slider_delete") {
                                $slider_delete = TRUE;
                            } elseif ($pre['permission'] == "pages_all") {
                                $pages_all = TRUE;
                            } elseif ($pre['permission'] == "pages_add") {
                                $pages_add = TRUE;
                            } elseif ($pre['permission'] == "pages_edit") {
                                $pages_edit = TRUE;
                            } elseif ($pre['permission'] == "pages_delete") {
                                $pages_delete = TRUE;
                            } elseif ($pre['permission'] == "contact_all") {
                                $contact_all = TRUE;
                            } elseif ($pre['permission'] == "contact_edit") {
                                $contact_edit = TRUE;
                            } elseif ($pre['permission'] == "contact_delete") {
                                $contact_delete = TRUE;
                            }
                        }
                        ?>

                        <div class="form-group row">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr class="gray_check">
                                        <th class="text-center"><?php echo e(trans('admin.permissions')); ?> </th>
                                        <th class="text-center"><?php echo e(trans('admin.show_all')); ?></th>
                                        <th class="text-center"><?php echo e(trans('admin.add')); ?> </th>
                                        <th class="text-center"><?php echo e(trans('admin.edit')); ?> </th>
                                        <th class="text-center"><?php echo e(trans('admin.show')); ?> </th>
                                        <th class="text-center"><?php echo e(trans('admin.delete')); ?> </th>
                                    </tr>
                                </thead>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_site" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_site_value">
                                        <?php echo e(trans('admin.site')); ?>

                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'site_edit',$site_edit,['id'=>'site_edit','class'=>'check_site'])); ?>

                                            <label for="site_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_social_media" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_social_media_value">
                                        <?php echo e(trans('admin.social_media')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'social_media_all',$social_media_all,['id'=>'social_media_all','class'=>'check_social_media'])); ?>

                                            <label for="social_media_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'social_media_edit',$social_media_edit,['id'=>'social_media_edit','class'=>'check_social_media'])); ?>

                                            <label for="social_media_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_currencies" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_currencies_value">
                                        <?php echo e(trans('admin.currencies')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'currencies_all',$currencies_all,['id'=>'currencies_all','class'=>'check_currencies'])); ?>

                                            <label for="currencies_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'currencies_edit',$currencies_edit,['id'=>'currencies_edit','class'=>'check_currencies'])); ?>

                                            <label for="currencies_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_countries" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_countries_value">
                                        <?php echo e(trans('admin.countries')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'countries_all',$countries_all,['id'=>'countries_all','class'=>'check_countries'])); ?>

                                            <label for="countries_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'countries_edit',$countries_edit,['id'=>'countries_edit','class'=>'check_countries'])); ?>

                                            <label for="countries_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_log" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_log_value">
                                        <?php echo e(trans('admin.log')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'log_all',$log_all,['id'=>'log_all','class'=>'check_log'])); ?>

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
                                        <?php echo e(trans('admin.notifications')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'notifications_all',$notifications_all,['id'=>'notifications_all','class'=>'check_notifications'])); ?>

                                            <label for="notifications_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'notifications_add',$notifications_add,['id'=>'notifications_add','class'=>'check_notifications'])); ?>

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
                                        <?php echo e(trans('admin.groups')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'groups_all',$groups_all,['id'=>'groups_all','class'=>'check_groups'])); ?>

                                            <label for="groups_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'groups_add',$groups_add,['id'=>'groups_add','class'=>'check_groups'])); ?>

                                            <label for="groups_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'groups_edit',$groups_edit,['id'=>'groups_edit','class'=>'check_groups'])); ?>

                                            <label for="groups_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'groups_delete',$groups_delete,['id'=>'groups_delete','class'=>'check_groups'])); ?>

                                            <label for="groups_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_admins" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_admins_value">
                                        <?php echo e(trans('admin.admins')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'admins_all',$admins_all,['id'=>'admins_all','class'=>'check_admins'])); ?>

                                            <label for="admins_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'admins_add',$admins_add,['id'=>'admins_add','class'=>'check_admins'])); ?>

                                            <label for="admins_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'admins_edit',$admins_edit,['id'=>'admins_edit','class'=>'check_admins'])); ?>

                                            <label for="admins_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'admins_delete',$admins_delete,['id'=>'admins_delete','class'=>'check_admins'])); ?>

                                            <label for="admins_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_users" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_users_value">
                                        <?php echo e(trans('admin.users')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'users_all',$users_all,['id'=>'users_all','class'=>'check_users'])); ?>

                                            <label for="users_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'users_add',$users_add,['id'=>'users_add','class'=>'check_users'])); ?>

                                            <label for="users_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'users_edit',$users_edit,['id'=>'users_edit','class'=>'check_users'])); ?>

                                            <label for="users_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'users_delete',$users_delete,['id'=>'users_delete','class'=>'check_users'])); ?>

                                            <label for="users_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_visitors" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_visitors_value">
                                        <?php echo e(trans('admin.visitors')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'visitors_all',$visitors_all,['id'=>'visitors_all','class'=>'check_visitors'])); ?>

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
                                        <?php echo e(trans('admin.companies')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'companies_all',$companies_all,['id'=>'companies_all','class'=>'check_companies'])); ?>

                                            <label for="companies_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'companies_add',$companies_add,['id'=>'companies_add','class'=>'check_companies'])); ?>

                                            <label for="companies_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'companies_edit',$companies_edit,['id'=>'companies_edit','class'=>'check_companies'])); ?>

                                            <label for="companies_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_portfolio" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_portfolio_value">
                                        <?php echo e(trans('admin.portfolio')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'portfolio_all',$portfolio_all,['id'=>'portfolio_all','class'=>'check_portfolio'])); ?>

                                            <label for="portfolio_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'portfolio_add',$portfolio_add,['id'=>'portfolio_add','class'=>'check_portfolio'])); ?>

                                            <label for="portfolio_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'portfolio_edit',$portfolio_edit,['id'=>'portfolio_edit','class'=>'check_portfolio'])); ?>

                                            <label for="portfolio_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'portfolio_show',$portfolio_show,['id'=>'portfolio_show','class'=>'check_portfolio'])); ?>

                                            <label for="portfolio_show" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'portfolio_delete',$portfolio_delete,['id'=>'portfolio_delete','class'=>'check_portfolio'])); ?>

                                            <label for="portfolio_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_ideas" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_ideas_value">
                                        <?php echo e(trans('admin.ideas')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'ideas_all',$ideas_all,['id'=>'ideas_all','class'=>'check_ideas'])); ?>

                                            <label for="ideas_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'ideas_edit',$ideas_edit,['id'=>'ideas_edit','class'=>'check_ideas'])); ?>

                                            <label for="ideas_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_categories" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_categories_value">
                                        <?php echo e(trans('admin.categories')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'categories_all',$categories_all,['id'=>'categories_all','class'=>'check_categories'])); ?>

                                            <label for="categories_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'categories_add',$categories_add,['id'=>'categories_add','class'=>'check_categories'])); ?>

                                            <label for="categories_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'categories_edit',$categories_edit,['id'=>'categories_edit','class'=>'check_categories'])); ?>

                                            <label for="categories_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'categories_delete',$categories_delete,['id'=>'categories_delete','class'=>'check_categories'])); ?>

                                            <label for="categories_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_projects" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_projects_value">
                                        <?php echo e(trans('admin.projects')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'projects_all',$projects_all,['id'=>'projects_all','class'=>'check_projects'])); ?>

                                            <label for="projects_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'projects_add',$projects_add,['id'=>'projects_add','class'=>'check_projects'])); ?>

                                            <label for="projects_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'projects_edit',$projects_edit,['id'=>'projects_edit','class'=>'check_projects'])); ?>

                                            <label for="projects_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'projects_show',$projects_show,['id'=>'projects_show','class'=>'check_projects'])); ?>

                                            <label for="projects_show" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_gifts" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_gifts_value">
                                        <?php echo e(trans('admin.gifts')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'gifts_all',$gifts_all,['id'=>'gifts_all','class'=>'check_gifts'])); ?>

                                            <label for="gifts_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'gifts_add',$gifts_add,['id'=>'gifts_add','class'=>'check_gifts'])); ?>

                                            <label for="gifts_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'gifts_edit',$gifts_edit,['id'=>'gifts_edit','class'=>'check_gifts'])); ?>

                                            <label for="gifts_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'gifts_delete',$gifts_delete,['id'=>'gifts_delete','class'=>'gifts_delete'])); ?>

                                            <label for="gifts_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_childern" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_childern_value">
                                        <?php echo e(trans('admin.childern')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'childern_all',$childern_all,['id'=>'childern_all','class'=>'check_childern'])); ?>

                                            <label for="childern_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'childern_add',$childern_add,['id'=>'childern_add','class'=>'check_childern'])); ?>

                                            <label for="childern_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'childern_edit',$childern_edit,['id'=>'childern_edit','class'=>'check_childern'])); ?>

                                            <label for="childern_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'childern_show',$childern_show,['id'=>'childern_show','class'=>'check_childern'])); ?>

                                            <label for="childern_show" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_families" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_families_value">
                                        <?php echo e(trans('admin.families')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'families_all',$families_all,['id'=>'families_all','class'=>'check_families'])); ?>

                                            <label for="families_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'families_add',$families_add,['id'=>'families_add','class'=>'check_families'])); ?>

                                            <label for="families_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'families_edit',$families_edit,['id'=>'families_edit','class'=>'check_families'])); ?>

                                            <label for="families_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'families_show',$families_show,['id'=>'families_show','class'=>'check_families'])); ?>

                                            <label for="families_show" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_teachers" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_teachers_value">
                                        <?php echo e(trans('admin.teachers')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'teachers_all',$teachers_all,['id'=>'teachers_all','class'=>'check_teachers'])); ?>

                                            <label for="teachers_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'teachers_add',$teachers_add,['id'=>'teachers_add','class'=>'check_teachers'])); ?>

                                            <label for="teachers_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'teachers_edit',$teachers_edit,['id'=>'teachers_edit','class'=>'check_teachers'])); ?>

                                            <label for="teachers_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'teachers_show',$teachers_show,['id'=>'teachers_show','class'=>'check_teachers'])); ?>

                                            <label for="teachers_show" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_donations" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_donations_value">
                                        <?php echo e(trans('admin.donations')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'donations_all',$donations_all,['id'=>'donations_all','class'=>'check_donations'])); ?>

                                            <label for="donations_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'donations_edit',$donations_edit,['id'=>'donations_edit','class'=>'check_donations'])); ?>

                                            <label for="donations_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_tutorials" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_tutorials_value">
                                        <?php echo e(trans('admin.tutorials')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'tutorials_all',$tutorials_all,['id'=>'tutorials_all','class'=>'check_tutorials'])); ?>

                                            <label for="tutorials_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'tutorials_add',$tutorials_add,['id'=>'tutorials_add','class'=>'check_tutorials'])); ?>

                                            <label for="tutorials_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'tutorials_edit',$tutorials_edit,['id'=>'tutorials_edit','class'=>'check_tutorials'])); ?>

                                            <label for="tutorials_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'tutorials_delete',$tutorials_delete,['id'=>'tutorials_delete','class'=>'check_tutorials'])); ?>

                                            <label for="tutorials_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_ads" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_ads_value">
                                        <?php echo e(trans('admin.ads')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'ads_all',$ads_all,['id'=>'ads_all','class'=>'check_ads'])); ?>

                                            <label for="ads_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'ads_add',$ads_add,['id'=>'ads_add','class'=>'check_ads'])); ?>

                                            <label for="ads_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'ads_edit',$ads_edit,['id'=>'ads_edit','class'=>'check_ads'])); ?>

                                            <label for="ads_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'ads_delete',$ads_delete,['id'=>'ads_delete','class'=>'check_ads'])); ?>

                                            <label for="ads_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_slider" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_slider_value">
                                        <?php echo e(trans('admin.slider')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'slider_all',$slider_all,['id'=>'slider_all','class'=>'check_slider'])); ?>

                                            <label for="slider_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'slider_add',$slider_add,['id'=>'slider_add','class'=>'check_slider'])); ?>

                                            <label for="slider_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'slider_edit',$slider_edit,['id'=>'slider_edit','class'=>'check_slider'])); ?>

                                            <label for="slider_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'slider_delete',$slider_delete,['id'=>'slider_delete','class'=>'check_slider'])); ?>

                                            <label for="slider_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_pages" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_pages_value">
                                        <?php echo e(trans('admin.pages')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'pages_all',$pages_all,['id'=>'pages_all','class'=>'check_pages'])); ?>

                                            <label for="pages_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'pages_add',$pages_add,['id'=>'pages_add','class'=>'check_pages'])); ?>

                                            <label for="pages_add" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'pages_edit',$pages_edit,['id'=>'pages_edit','class'=>'check_pages'])); ?>

                                            <label for="pages_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'pages_delete',$pages_delete,['id'=>'pages_delete','class'=>'check_pages'])); ?>

                                            <label for="pages_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                                <tr class="pagetr">
                                    <td class="gray_check" rel="check_contact" style="cursor: pointer;">
                                        <input type="checkbox" class="hidden" id="check_contact_value">
                                        <?php echo e(trans('admin.contact')); ?>

                                    </td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'contact_all',$contact_all,['id'=>'contact_all','class'=>'check_contact'])); ?>

                                            <label for="contact_all" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'contact_edit',$contact_edit,['id'=>'contact_edit','class'=>'check_contact'])); ?>

                                            <label for="contact_edit" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                    <td></td>
                                    <td>
                                        <label class="m-checkbox m-checkbox--check-bold m-checkbox--state-primary">
                                            <?php echo e(Form::checkbox('permissions[]', 'contact_delete',$contact_delete,['id'=>'contact_delete','class'=>'check_contact'])); ?>

                                            <label for="contact_delete" style="height: 10px;"></label>
                                        </label> 
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class = "box-footer">
                <button type = "submit" class = "btn btn-primary btn-lg" style = "font-size: 16px;"><?php echo e(trans('admin.save')); ?></button>
                <a href = "<?php echo e(URL::to('admin/groups')); ?>" class = "btn btn-default btn-lg" style = "font-size: 16px;"><?php echo e(trans('admin.back')); ?></a>
            </div>

        </form>

    </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/groups/edit.blade.php ENDPATH**/ ?>
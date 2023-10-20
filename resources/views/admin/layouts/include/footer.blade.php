<footer class="main-footer" dir="{{$dir}}">
    <div class="pull-left d-none d-sm-inline-block">
        {{$site[$lang.'_title']}} ,&nbsp;
    </div>
     {{trans('admin.rights')}} &copy; {{date('Y')}}. Powered By Codex.
</footer>

<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    </ul>
    <!-- Tab panes -->
    <div class="tab-content" dir="{{$dir}}">
        <div class="tab-pane" id="control-sidebar-home-tab">
        </div>        
    </div>
</aside>
<!-- /.control-sidebar -->

<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

<?php $permission_orders_count = App\Models\Permission::where('group_id',Auth::User()->group_id)->where('permission','orders_all')->count(); ?>
<input type="hidden" id="orders_notify" value="{{$permission_orders_count}}">
<input type="hidden" id="text_dir" value="{{$text}}">
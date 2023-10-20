<footer class="main-footer" dir="<?php echo e($dir); ?>">
    <div class="pull-left d-none d-sm-inline-block">
        <?php echo e($site[$lang.'_title']); ?> ,&nbsp;
    </div>
     <?php echo e(trans('admin.rights')); ?> &copy; <?php echo e(date('Y')); ?>. Powered By Codex.
</footer>

<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    </ul>
    <!-- Tab panes -->
    <div class="tab-content" dir="<?php echo e($dir); ?>">
        <div class="tab-pane" id="control-sidebar-home-tab">
        </div>        
    </div>
</aside>
<!-- /.control-sidebar -->

<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

<?php $permission_orders_count = App\Models\Permission::where('group_id',Auth::User()->group_id)->where('permission','orders_all')->count(); ?>
<input type="hidden" id="orders_notify" value="<?php echo e($permission_orders_count); ?>">
<input type="hidden" id="text_dir" value="<?php echo e($text); ?>"><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/layouts/include/footer.blade.php ENDPATH**/ ?>
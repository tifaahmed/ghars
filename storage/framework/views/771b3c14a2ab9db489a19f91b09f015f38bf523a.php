<!DOCTYPE html>
<?php
$lang = App::getLocale();
$dir = "";
$arrow = "right";
$pull = "pull-left";
if ($lang == "ar") {
    $dir = "rtl";
    $arrow = "left";
    $pull = "pull-right";
}
$site = App\Models\Site::first();
?>
<html lang="<?php echo e($lang); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(url('favicon')); ?>/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(url('favicon')); ?>/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(url('favicon')); ?>/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(url('favicon')); ?>/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(url('favicon')); ?>/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(url('favicon')); ?>/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(url('favicon')); ?>/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(url('favicon')); ?>/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(url('favicon')); ?>/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo e(url('favicon')); ?>/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(url('favicon')); ?>/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(url('favicon')); ?>/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(url('favicon')); ?>/favicon-16x16.png">
        <link rel="manifest" href="<?php echo e(url('favicon')); ?>/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <meta property="og:title" content="<?php echo e($site[$lang.'_title']); ?>">
        <meta property="og:description" content="<?php echo e($site[$lang.'_desc']); ?>">
        <meta property="og:site_name" content="<?php echo e(url('/')); ?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo e(url('/')); ?>">
        <meta property="og:image" content="../og.png">

        <title><?php echo e($site[$lang.'_title']); ?> - <?php echo e(trans('admin.admin')); ?> </title>

        <!-- Bootstrap 4.0-->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">

        <!-- Bootstrap 4.0-->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/font-awesome/css/font-awesome.min.css">

        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/Ionicons/css/ionicons.min.css">

        <!-- bootstrap datepicker -->	
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_plugins/timepicker/bootstrap-timepicker.min.css">

        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/select2/dist/css/select2.min.css">

        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/css/<?php echo e($lang); ?>/master_style.css">

        <!-- bonitoadmin Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/css/<?php echo e($lang); ?>/skins/_all-skins.css">

        <?php echo $__env->yieldContent('styles'); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

        <!-- google font -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php echo $__env->make('admin.layouts.include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('admin.layouts.include.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="content-wrapper" dir="<?php echo e($dir); ?>">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <!-- /.content-wrapper -->

            <?php echo $__env->make('admin.layouts.include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <input type="hidden" value="<?php echo e(URL::to('/')); ?>" id="base-url">
        </div>

        <!-- jQuery 3 -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/jquery/dist/jquery.js"></script>
        <script src="<?php echo e(url('admin_panel')); ?>/js/notify.js"></script>
        <script src="<?php echo e(url('admin_panel')); ?>/js/ion.sound.js"></script>

        <script>
$(document).ready(function () {
    $.notify.defaults({
// whether to hide the notification on click
        clickToHide: true,
        // whether to auto-hide the notification
        autoHide: false,
        // if autoHide, hide after milliseconds
        autoHideDelay: 5000,
        // show the arrow pointing at the element
        arrowShow: true,
        // arrow size in pixels
        arrowSize: 5,
        // position defines the notification position though uses the defaults below
        position: '...',
        // default positions
        elementPosition: 'bottom left',
        globalPosition: 'top right',
        // default style
        style: 'bootstrap',
        // default class (string or [string])
        className: 'error',
        // show animation
        showAnimation: 'slideDown',
        // show animation duration
        showDuration: 400,
        // hide animation
        hideAnimation: 'slideUp',
        // hide animation duration
        hideDuration: 200,
        // padding between element and notification
        gap: 2
    });
    ion.sound({
        sounds: [
            {
                alias: "s1",
                name: "bell_ring"
            }

        ],
        path: "<?php echo url('/') ?>/admin_panel/js/sounds/",
        preload: false,
        volume: 1
    });

    function get_orders() {
        var link = "<?php echo url('/') ?>";
        $.ajax({
            type: "GET",
            url: link + "/admin/check_orders",
            success: function (datas) {
                $('#orders_header').empty();
                var text = $('#text_dir').val();
                var count = 0;
                for (var i = 0; i < datas.length; i++) {
                    count++;
                    $('#orders_header').append('<li class="' + text + '"><a href="' + link + '/admin/orders/' + datas[i].id + '/edit"><i class="fa fa-shopping-cart text-red"></i>' + datas[i].title + '</a></li>');
                }
                if (count > $('.orders_count').html()) {
                    $.notify("!!!!! New Order !!! ☺ ", "success");
                    ion.sound.play("s1", {
                        loop: 2
                    });
                }
                $('.orders_count').html(count);
                $('.orders_count_2').html(count);
            }
        });
    }

    if ($('#orders_notify').val() > 0) {
        setInterval(function () {
            get_orders();
        }, 60 * 1000); // 60 * 1000 milsec
    }

});
        </script>

        <!-- popper -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/popper/dist/popper.min.js"></script>

        <!-- Bootstrap 4.0-->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Select2 -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/select2/dist/js/select2.full.js"></script>

        <!-- SlimScroll -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

        <!-- FastClick -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/fastclick/lib/fastclick.js"></script>

        <!-- bonitoadmin App -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/js/template.js"></script>

        <!-- bonitoadmin for demo purposes -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/js/demo.js"></script>

        <!-- bootstrap datepicker -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

        <!-- bootstrap time picker -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js"></script>

        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/ckeditor/ckeditor.js"></script>

        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>

        <!-- bonitoadmin for editor -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/js/pages/editor.js"></script>

        <?php echo $__env->yieldContent('scripts'); ?>
        <script>
$('#spark').hide();
        </script>
    </body>
</html>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/layouts/form.blade.php ENDPATH**/ ?>
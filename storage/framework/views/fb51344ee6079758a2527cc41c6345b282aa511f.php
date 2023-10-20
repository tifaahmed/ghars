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

        <!-- bootstrap             4.0 -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap/dist/css/bootstrap.css">

        <!-- Bootstrap 4.0-->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">

        <!-- font awesome -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/font-awesome/css/font-awesome.css">

        <!-- ionicons -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/Ionicons/css/ionicons.css">

        <!-- theme style -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/css/<?php echo e($lang); ?>/master_style.css">

        <!-- mpt_admin skins. choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/css/<?php echo e($lang); ?>/skins/_all-skins.css">

        <!-- morris chart -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/morris.js/morris.css">

        <!-- jvectormap -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/jvectormap/jquery-jvectormap.css">

        <!-- date picker -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">

        <!-- daterange picker -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css">

        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">

        <!-- weather weather -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/weather-icons/weather-icons.css">

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

            <?php echo $__env->make('dashboard.layouts.include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('dashboard.layouts.include.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="content-wrapper" dir="<?php echo e($dir); ?>">

                <?php echo $__env->yieldContent('content'); ?>
            </div>

            <?php echo $__env->make('dashboard.layouts.include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        </div>

        <!-- jQuery 3 -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/jquery/dist/jquery.js"></script>
        <script src="<?php echo e(url('admin_panel')); ?>/js/notify.js"></script>
        <script src="<?php echo e(url('admin_panel')); ?>/js/ion.sound.js"></script>

        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/jquery-ui/jquery-ui.js"></script>

        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
$.widget.bridge('uibutton', $.ui.button);
        </script>

        <!-- popper -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/popper/dist/popper.min.js"></script>

        <!-- Bootstrap 4.0 -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap/dist/js/bootstrap.js"></script>

        <!-- FLOT CHARTS -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/Flot/jquery.flot.js"></script>

        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/Flot/jquery.flot.resize.js"></script>

        <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/Flot/jquery.flot.pie.js"></script>

        <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/Flot/jquery.flot.categories.js"></script>

        <!-- Sparkline -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/jquery-sparkline/dist/jquery.sparkline.js"></script>

        <!-- jvectormap -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>	
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

        <!-- jQuery Knob Chart -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/jquery-knob/js/jquery.knob.js"></script>

        <!-- daterangepicker -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/moment/min/moment.min.js"></script>
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- datepicker -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>

        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>

        <!-- Slimscroll -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js"></script>

        <!-- FastClick -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/fastclick/lib/fastclick.js"></script>

        <!-- ChartJS -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/chart-js/chart.js"></script>

        <!-- mpt_admin App -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/js/template.js"></script>

        <!-- mpt_admin dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/js/pages/dashboard.js"></script>

        <!-- mpt_admin for demo purposes -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/js/demo.js"></script>

        <!-- weather for demo purposes -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_plugins/weather-icons/WeatherIcon.js"></script>



        <?php echo $__env->yieldContent('scripts'); ?>

        <script>
$('#spark').hide();
        </script>

    </body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/dashboard/layouts/index.blade.php ENDPATH**/ ?>
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

        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/css/<?php echo e($lang); ?>/master_style.css">

        <!-- bonitoadmin Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo e(URL::to('admin_panel')); ?>/css/<?php echo e($lang); ?>/skins/_all-skins.css">	

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- google font -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    </head>
    <body class="hold-transition login-page">
        <div class="login-box" dir="<?php echo e($dir); ?>">

            <div class="login-logo">                    
                <a href="<?php echo e(URL::to('/')); ?>" title="<?php echo e($site[$lang.'_title']); ?>">
                    <img src="<?php echo e(URL::to('admin_panel/images/logo.png')); ?>" alt="<?php echo e($site[$lang.'_title']); ?>" style="height: 180px;">
                </a>
            </div>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- /.login-box -->


        <!-- jQuery 3 -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/jquery/dist/jquery.min.js"></script>

        <!-- popper -->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/popper/dist/popper.min.js"></script>

        <!-- Bootstrap 4.0-->
        <script src="<?php echo e(URL::to('admin_panel')); ?>/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>

    </body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/admin/layouts/login.blade.php ENDPATH**/ ?>
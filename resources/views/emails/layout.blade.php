<!DOCTYPE html>
<?php
$site = \App\Models\Site::first();
$social_media = \App\Models\SocialMedia::all();
$lang = App::getLocale();
if ($lang == "en") {
    $font = "Arial";
    $dir = "ltr";
    $img_right = "right";
    $img_left = "left";
} else {
    $font = "Arial";
    $dir = "rtl";
    $img_right = "left";
    $img_left = "right";
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl" style="font-family: '<?php echo $font; ?>', sans-serif;vertical-align: baseline;font-style: inherit;font-size: 100%;line-height: inherit;outline: 0px;padding: 0px;margin: 0px;border: 0px;font-variant: normal;text-transform: none;speak: none;">
    <head style="font-family: '<?php echo $font; ?>', sans-serif;">
        <meta charset="utf-8" style="font-family: '<?php echo $font; ?>', sans-serif;">
        <title style="font-family: '<?php echo $font; ?>', sans-serif;">{{$site[$lang.'_title']}}</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css" style="font-family: '<?php echo $font; ?>', sans-serif;">
        <style type="text/css" style="font-family: '<?php echo $font; ?>', sans-serif;">

            @font-face{
                font-family:'<?php echo $font; ?>';
                font-style:normal;
                src:local('<?php echo $font; ?>'),
                    local('OpenSans'),
                    url('http://fonts.gstatic.com/s/opensans/v10/cJZKeOuBrn4kERxqtaUH3bO3LdcAZYWl9Si6vvxL-qU.woff') format('woff');
            }

            body {
                font-family: '<?php echo $font; ?>', sans-serif;
            }
        </style>
    </head>
    <body style="font-family: '<?php echo $font; ?>', sans-serif;font-family: '<?php echo $font; ?>', sans-serif;direction: <?php echo $dir; ?>;vertical-align: baseline;font-style: inherit;font-size: 100%;line-height: inherit;outline: 0px;padding: 0px;margin: 0px;border: 0px;font-variant: normal;text-transform: none;speak: none;">
        <div class="all-wrapper" style="font-family: '<?php echo $font; ?>', sans-serif;vertical-align: baseline;font-style: inherit;font-size: 100%;line-height: inherit;outline: 0px;padding: 0px;margin: 0 auto;border: 0px;font-variant: normal;text-transform: none;speak: none;max-width: 600px;border: 1px solid #2A2B2C;overflow: hidden;background-color: #2A2B2C;">

            <div class="main-contents  mini-50" style="font-family: '<?php echo $font; ?>', sans-serif;vertical-align: baseline;font-style: inherit;font-size: 100%;line-height: inherit;outline: 0px;padding: 50px 0;margin: 0px;border: 0px;font-variant: normal;text-transform: none;speak: none; background-color: #fff; margin:25px 15px; padding-bottom:100px;">
                <div class="container clearfix" style="font-family: '<?php echo $font; ?>', sans-serif;vertical-align: baseline;font-style: inherit;font-size: 100%;line-height: inherit;outline: 0px;padding: 0px;margin: 0 auto;border: 0px;font-variant: normal;text-transform: none;speak: none;max-width: 100%;padding-top: 30px;padding-bottom: 30px;">
                    <a href="https://atyabalmarshoud.com/" title="{{$site[$lang.'_title']}}" class="logo" style="font-family: '<?php echo $font; ?>', sans-serif;position: relative;color: #3d3d3d;outline: 0px;display: block;vertical-align: middle;margin: 0;text-decoration: none !important;"><img src="https://atyabalmarshoud.com/interface/assets/images/logo.svg" alt="{{$site[$lang.'_title']}}" style="font-family: '<?php echo $font; ?>', sans-serif;vertical-align: baseline;font-style: inherit;font-size: 100%;line-height: inherit;outline: 0px;padding: 0px;margin: 0 auto;border: 0px;font-variant: normal;text-transform: none;speak: none;display: block;max-width: 100%;"></a>
                </div>
                <div class="container" style="font-family: '<?php echo $font; ?>', sans-serif;vertical-align: baseline;font-style: inherit;font-size: 100%;line-height: inherit;outline: 0px;padding: 0px;margin: 0 auto;border: 0px;font-variant: normal;text-transform: none;speak: none;max-width: 100%;padding-right: 30px;padding-left: 30px;">

                    @yield('content')

                </div>
            </div>
            <!-- end of main contents -->

            <div class="br-10" style="font-family: '<?php echo $font; ?>', sans-serif;vertical-align: baseline;font-style: inherit;font-size: 100%;line-height: inherit;outline: 0px;padding: 0px;margin: 0px;border: 0px;font-variant: normal;text-transform: none;speak: none;padding-bottom:1.6667%;"></div>
            <div class="footer" style="font-family: '<?php echo $font; ?>', sans-serif;vertical-align: baseline;font-style: inherit;font-size: 100%;line-height: inherit;outline: 0px;padding: 30px 0;margin: 0px;border: 0px;font-variant: normal;text-transform: none;speak: none;display: block;text-align: center;">
                <div class="container" style="font-family: '<?php echo $font; ?>', sans-serif;vertical-align: baseline;font-style: inherit;font-size: 100%;line-height: inherit;outline: 0px;padding: 0px;margin: 0 auto;border: 0px;font-variant: normal;text-transform: none;speak: none;max-width: 100%;padding-right: 30px;padding-left: 30px;">
                    <p class="copyrights" style="font-family: '<?php echo $font; ?>', sans-serif;vertical-align: baseline;font-style: inherit;font-size: 16px;line-height: 36px;outline: 0px;padding: 0px;margin: 0px;border: 0px;font-variant: normal;text-transform: none;speak: none;color: #fff;margin-bottom: 0; ">
                        <a href="https://atyabalmarshoud.com/" title="{{$site[$lang.'_title']}}">Unsubscribe</a>
                    </p>

                    <p class="copyrights" style="font-family: '<?php echo $font; ?>', sans-serif;vertical-align: baseline;font-style: inherit;font-size: 16px;line-height: 36px;outline: 0px;padding: 0px;margin: 0px;border: 0px;font-variant: normal;text-transform: none;speak: none;color: #fff;margin-bottom: 0; ">Copyrights &copy; {{date('Y')}} {{$site[$lang.'_title']}} {{trans('admin.rights')}} </p>
                </div>
            </div>
            <!-- end of footer -->


        </div>
        <!-- end of all-wrapper -->

    </body>
</html>
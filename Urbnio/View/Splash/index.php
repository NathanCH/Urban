<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= APP_NAME; ?> - <?= APP_VER; ?></title>
        <link rel="stylesheet" type="text/less" href="<?= CSS_PATH; ?>/splash.less" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.7.4/less.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700|Lato:300,400,700' rel='stylesheet' type='text/css' />
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&sensor=false"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places"></script>
        <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
        <script src="<?= JS_PATH; ?>/components.js"></script>
    </head>
    <body>
        <section class="fullscreen-container">
            <div class="map-overlay">
                <div class="row">
                    <div class="small-12 medium-12 large-12 columns">

                        <div class="row">
                            <div class="small-offset-1 small-10 medium-offset-2 medium-8 large-offset-2 large-4 columns">
                                <div class="splash-content">
                                    <h1>urbn.io</h1>
                                    <p>
                                        a website for architecture and urban enthusiasts - track your neighbourhood's growth, discuss local politics, and get involved.
                                    </p>
                                    <a href="http://github.com/NathanCH/urban" class="github" title="View source on Github">View source.</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="map" data-map-type="subtle" data-map-event="pan"></div>
        </section>

        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-9245624-4', 'urbn.io');
        ga('require', 'linkid', 'linkid.js');
        ga('require', 'displayfeatures')
        ga('send', 'pageview');
        </script>
    </body>
</html>
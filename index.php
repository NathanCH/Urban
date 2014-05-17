<?php
require_once 'core/init.php';
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo Config::get('app/name'); ?> <?php echo Config::get('app/version'); ?></title>
        <link rel="stylesheet" type="text/css" href="css/reset.css" />
        <link rel="stylesheet" type="text/css" href="css/foundation.css" />
        <link rel="stylesheet" type="text/css" href="css/typography.css" />
        <link rel="stylesheet" type="text/css" href="css/forms.css" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open Sans:700,400,400italic' rel='stylesheet' type='text/css' />
        <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
        <script src="js/oak.js"></script>
    </head>
    <body id="splash">
        <div class="container container-centered">
            <div class="box">
                <header class="box-header row">
                    <div class="large-12 column center">
                        <h1>Urban</h1>
                        <h3>adventure ready</h3>
                    </div>
                </header>
                <div class="row">
                    <form action="#">
                        <!-- Email Input -->
                        <div class="input-container">
                            <i class="fa fa-envelope"></i>
                            <input type="email" name="email" placeholder="Email" />
                        </div>
                        <!-- Password Input -->
                        <div class="input-container">
                            <i class="fa fa-lock"></i>
                            <input type="password" name="password" placeholder="********" />
                        </div>
                    </form>
                </div>
                <footer class="box-footer row row-inline-input">
                    <div class="small-12 medium-8 large-8 columns">
                        <input type="hidden" name="remember_login" />
                        <label>
                            <span class="input-checkbox">

                            </span>
                            Remember Me?
                        </label>
                    </div>
                    <div class="small-12 medium-4 large-4 columns">
                        <button id="submit" class="large-12 fill button button-primary">
                            Login
                        </button>
                    </div>
                </footer>
            </div>
            <footer class="copyright center">
                2014 &copy; urban.wiki
            </footer>
        </div>
    </body>
</html>
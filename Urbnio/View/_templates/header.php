<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="<?= APP_TAG; ?>" name="description">
        <title><?= APP_NAME; ?> - <?= APP_VER; ?></title>
        <link rel="stylesheet" type="text/less" href="<?= CSS_PATH; ?>/main.less" />
        <link rel="stylesheet" type="text/less" href="<?= CSS_PATH; ?>/shame.less" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.7.4/less.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700|Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&sensor=false&libraries=places"></script>
        <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
        <script src="<?= JS_PATH; ?>/functions.js"></script>
        <script src="<?= JS_PATH; ?>/extensions.js"></script>
        <script src="<?= JS_PATH; ?>/components.js"></script>
    </head>
    <body>
        <?php
        // Display flash message.
        echo $this->element('debug', array(
            'enabled' => true,
            'data' => $data
        ));
        ?>
        <header class="site-header">
            <div class="row-grey">
                <div class="site-container site-container-centered">
                    <div class="row">
                        <div class="small-12 medium-12 large-12 columns">
                            <a href="#" class="button button-text button-text-grey left mtm mbm">Send Feedback</a>
                            <a href="#" class="button button-text button-text-grey right mtm mbm">View Source</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-white">
                <div class="site-container site-container-centered">
                    <div class="row">
                        <div class="small-12 medium-7 large-7 columns">
                            <div class="site-logo-container">
                                <span class="logo-text"><a href="<?= URL ?>">Urbn</a></span>
                                <span class="slogan">for architecture and urban enthusiasts.</span>
                            </div>
                        </div>
                        <div class="small-12 medium-5 large-5 columns">
                            <?php
                            // Display flash message.
                            echo $this->element('user_control', array(
                                'data' => $data
                            ));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="site-container site-container-centered">
            <div class="notifications">
                <?php
                // Display flash message.
                echo $this->element('flash');
                ?>
            </div>
        </div>
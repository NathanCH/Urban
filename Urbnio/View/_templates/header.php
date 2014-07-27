<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= APP_NAME; ?> - <?= APP_VER; ?></title>
        <link rel="stylesheet" type="text/css" href="<?= URL; ?>Public/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL; ?>Public/css/foundation-grid.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL; ?>Public/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL; ?>Public/css/typography.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL; ?>Public/css/forms.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL; ?>Public/css/components.css" />
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css' />
        <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
        <script src="<?= URL; ?>public/js/functions.js"></script>
    </head>
    <body>
        <header class="site-header">
            <div class="site-container site-container-centered">
                <div class="row">
                    <div class="small-12 medium-8 large-8 columns">
                        <div class="row site-logo-container">
                            <div class="small-2 medium-1 large-1 columns">
                                <a href="<?= URL ?>">
                                    <img class="logo-icon" src="<?= URL; ?>public/img/logo-icon.png" />
                                </a>
                            </div>
                            <div class="small-10 medium-11 large-11 columns">
                                <span class="logo-text mlm"><a href="<?= URL ?>">Urban</a></span>
                                <span class="slogan mlm">for architecture and urban enthusiasts.</span>
                            </div>
                        </div>
                    </div>
                    <div class="small-12 medium-4 large-4 columns">
                        <nav class="site-navigation right">
                            <ul>
                                <li class="site-navigation-item">
                                    <a href="<?= URL; ?>user/login">Login</a>
                                </li>
                                <li class="site-navigation-item">
                                    <a href="<?= URL; ?>user/register">Register</a>
                                </li>
                                <li class="site-navigation-item">
                                    <a href="<?= URL; ?>user/logout">Logout</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="notifications">
                <?php
                // Display flash message.
                echo $this->element('flash');
                ?>
            </div>
            </div>
        </div>
        </header>
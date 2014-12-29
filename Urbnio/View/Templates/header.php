<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="<?= APP_TAG; ?>" name="description">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= APP_NAME; ?> - <?= APP_VER; ?></title>
        <link rel="stylesheet" type="text/less" href="<?= CSS_PATH; ?>/static.less" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.7.4/less.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700|Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&sensor=false&libraries=places"></script>
        <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
        <script src="<?= JS_PATH; ?>/urbn.js"></script>
        <script src="<?= JS_PATH; ?>/extensions.js"></script>
    </head>
    <body>
        <?php
        // Display flash message.
        echo $this->element('debug', array(
            'data' => $data
        ));
        ?>
        <header class="site-header">
            <div class="row-grey">
                <div class="site-wrap">
                    <div class="row">
                        <div class="small-12 medium-12 large-12 columns">
                            <a href="mailto:nathancharrois@gmail.com" class="link-grey left mtm mbm">Send Feedback</a>
                            <a href="https://github.com/NathanCH/Urban" class="link-grey right mtm mbm">View Source</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-white">
                <div class="site-wrap">
                    <div class="row">
                        <div class="small-12 medium-7 large-7 columns">
                            <div class="site-logo-container">
                                <span class="logo-text"><a href="<?= URL ?>"><?= APP_NAME; ?></a></span>
                                <span class="slogan"><?= APP_TAG; ?></span>
                            </div>
                        </div>
                        <div class="small-12 medium-5 large-5 columns">
                            <?php
                            if(isset($data['logged_in']) && $data['logged_in']){
                            ?>
                            <div class="user-controls right">
                                <div class="display-picture-container">
                                    <a href="#">
                                        <?php
                                        // Profile photo is not set.
                                        if(!$data['profile_photo']['set']) {
                                        ?>
                                        <img src="http://placehold.it/50x50" class="display-picture" />
                                        <?php
                                        }

                                        else{
                                        ?>
                                        <img src="<?php echo URL; ?>/<?php echo $data['profile_photo']['file_name']; ?>" class="display-picture" />
                                        <?php
                                        }
                                        ?>
                                    </a>
                                </div>
                                <span class="dropdown">
                                    <a class="button button-text button-text-grey" data-event="toggle-dropdown"><?= $data['user_data']['name'] ?></a>
                                    <ul class="dropdown-menu hide">
                                        <li><a href="<?= URL; ?>property/add">Add Property</a></li>
                                        <li><a href="<?= URL; ?>user/edit">Edit Profile</a></li>
                                        <li><a href="<?= URL; ?>user/change-password">Change Password</a></li>
                                        <li><a href="<?= URL; ?>user/logout">Logout</a></li>
                                    </ul>
                                </span>
                            </div>
                            <?php
                            }

                            // User isn't logged in.
                            else{
                            ?>
                            <div class="header-sign-in right">
                                <div class="row">
                                    <div class="small-12 medium-12 large-5 columns">
                                        <a class="button button-primary" href="<?= URL; ?>user/login/">Sign in</a>
                                    </div>
                                    <div class="small-12 medium-12 large-7 columns">
                                        <span class="text">
                                            or <a class="mls" href="<?= URL; ?>user/register/">create account</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="notifications-container">
            <?php
            // Display flash message.
            echo $this->element('flash');
            ?>
        </div>
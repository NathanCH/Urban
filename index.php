<?php

/**
 *  Urbn.io
 *  The urban enthusiasts.
 *
 *  @author nathancharrois@gmail.com
 *  @link http://www.cetan.ca
 *
 *  OOP principles largely based on
 *  PHP OOP Login/Register System (tutorial series)
 *
 *  @author phpacademy
 *  @link https://www.youtube.com/watch?v=c_hNNAdyfQk
 *
 *  MVC Skeleton Pattern by
 *
 *  @author Panique
 *  @link https://github.com/panique/php-mvc/
 *  @license http://opensource.org/licenses/MIT
 */

/**
 *  Load configutarion file.
 */
    require 'application/config/config.php';

/**
 *  Load helpers.
 *
 *  @todo replace with autoloader.
 */
    require 'application/helpers/DB.php';
    require 'application/helpers/route.php';
    require 'application/helpers/input.php';
    require 'application/helpers/validate.php';
    require 'application/helpers/session.php';

/**
 *  Load application.
 */
    require 'application/libs/application.php';
    require 'application/libs/controller.php';

/**
 *  Start the application.
 */
    $app = new Application();

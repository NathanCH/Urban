<?php

/**
 *  Urban
 *  The description of urban is unclear.
 *
 *  @author nathancharrois@gmail.com
 *  @link http://www.cetan.ca
 *
 *  MVC Skeleton Pattern by
 *
 *  @author Panique
 *  @link https://github.com/panique/php-mvc/
 *  @license http://opensource.org/licenses/MIT
 */

/**
 *  Require Composer generated autoloader.
 */
    require 'vendor/autoload.php';

/**
 *  Load configutarion file.
 */
    require 'application/config/config.php';


/**
 *  Load classes.
 *  @todo replace with autoloader.
 */
    require 'application/helpers/route.php';
    require 'application/helpers/input.php';
    require 'application/helpers/validate.php';


/**
 *  Load application.
 */
    require 'application/libs/application.php';
    require 'application/libs/controller.php';


/**
 *  Start the application.
 */
    $app = new Application();

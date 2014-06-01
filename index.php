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
 *  Load application configuration and classes.
 */

    require 'application/config/config.php';
    require 'application/libs/application.php';
    require 'application/libs/controller.php';

/**
 *  Start the application.
 */

    $app = new Application();

<?php

/**
 *  Report errors.
 */
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

/**
 *  Project URL.
 */
    define('URL', 'http://localhost/2014/urban/');

/**
 *  Database Configuration.
 */
    define('DB_TYPE', 'mysql');
    define('DB_HOST', '127.0.0.1');
    define('DB_NAME', 'urban');
    define('DB_USER', 'root');
    define('DB_PASS', '');

/**
 *  Application Info.
 */
    define('APP_NAME', 'Urban');
    define('APP_VER' , '0.1');

/**
 *  View Path
 */
    define('PATH_VIEWS', 'application/views/');
    define('PATH_VIEW_FILE_TYPE' , '.php');
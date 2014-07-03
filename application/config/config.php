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
 *  Cookie and Sessions.
 */
    define('SESSION_NAME', 'user');
    define('COOKIE_NAME', 'hash');
    define('COOKIE_EXPIRY', 604800);

/**
 *  Application Info.
 */
    define('APP_NAME', 'Urbn');
    define('APP_VER' , '0.1');

/**
 *  Layout Path.
 */
    define('LAYOUT_VIEWS', 'application/layouts/');
    define('LAYOUT_VIEW_FILE_TYPE' , '.php');

/**
 *  View Path.
 */
    define('PATH_VIEWS', 'application/views/');
    define('PATH_VIEW_FILE_TYPE' , '.php');

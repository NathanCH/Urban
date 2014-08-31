<?php

define('URL', 'http://' . $_SERVER['SERVER_NAME'] . '/2014/urban/');
// Live URL: define('URL', 'http://' . $_SERVER['SERVER_NAME'] . '/');

define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'urban');
define('DB_USER', 'root');
define('DB_PASS', '');

define('SESSION_NAME', 'user');
define('COOKIE_NAME', 'hash');
define('COOKIE_EXPIRY', 604800);

define('APP_NAME', 'Urbn');
define('APP_VER' , '0.2');
define('APP_LOCALE', 'en_us');

define('LAYOUT_PATH', 'Urbnio/Layout/');
define('LAYOUT_FILE_EXT' , '.php');

define('VIEW_PATH', 'Urbnio/View/');
define('VIEW_FILE_EXT' , '.php');

define('ELEMENT_PATH', 'Urbnio/Element/');
define('ELEMENT_FILE_EXT' , '.php');

define('LANG_PATH', 'Urbnio/i18n/');
define('LANG_FILE_EXT' , '.php');

define('CSS_PATH', URL . 'Static/css');
define('JS_PATH', URL . 'Static/js');
define('IMG_PATH', URL . 'Static/img');

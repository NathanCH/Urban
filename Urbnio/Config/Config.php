<?php
define('FOLDER', '/2014/urban/');
define('URL', 'http://' . $_SERVER['SERVER_NAME'] . FOLDER);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . FOLDER);

define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'urban');
define('DB_USER', 'root');
define('DB_PASS', '');

define('SESSION_NAME', 'user');
define('COOKIE_NAME', 'hash');
define('COOKIE_EXPIRY', 604800);

define('APP_NAME', 'Urbn');
define('APP_VER' , '0.3');
define('APP_TAG' , 'for architecture and urban enthusiasts.');
define('APP_LOCALE', 'en_us');

define('LAYOUT_PATH', 'Urbnio/Layout/');
define('LAYOUT_FILE_EXT' , '.php');

define('VIEW_PATH', 'Urbnio/View/');
define('VIEW_FILE_EXT' , '.php');

define('ELEMENT_PATH', 'Urbnio/Element/');
define('ELEMENT_FILE_EXT' , '.php');

define('LANG_PATH', 'Urbnio/i18n/');
define('LANG_FILE_EXT' , '.php');

define('CSS_PATH', URL . 'Public/static/css');
define('JS_PATH', URL . 'Public/src');
define('IMG_PATH', URL . 'Public/static/img');

define('USER_UPLOAD_PATH', 'Output/user_uploads/');

define('PLANET', 0);
define('CONTINENT', 1);
define('SUBCONTINENT', 2);
define('COUNTRY', 3);
define('REGION', 4);
define('SUBREGION', 5);
define('CITY', 6);
define('DISTRICT', 7);
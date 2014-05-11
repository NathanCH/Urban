<?php
session_start();

// Set global config variable.
$GLOBALS['config'] = array(
    'app' => array(
        'name' => 'urban',
        'version' => '0.01'
    ),
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'urban'
    )
);

// Auto load classes with anonymous function.
spl_autoload_register(function($class){
    require_once 'classes/'. $class .'.php';
});

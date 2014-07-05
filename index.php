<?php

require 'Urbnio/Config/Config.php';

// Autoload Classes.
spl_autoload_register(function($c){
    @include preg_replace('#\\\|_(?!.+\\\)#','/',$c).'.php';
});

$app = new Urbnio\Lib\Application();
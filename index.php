<?php

require 'Urbnio/Config/Config.php';

// Autoload Classes.
spl_autoload_register(function($c){
    // The move light weight psr-o compliant autoloader.
    // source: https://gist.github.com/adriengibrat/4761717
    @include preg_replace('#\\\|_(?!.+\\\)#','/',$c).'.php';
});

$app = new Urbnio\Lib\Application();
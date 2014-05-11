<?php

// Class to handle global config array.
class Config{
    public static function get($path = null){
        // Check if the path has been passed.
        if($path){
            // Point to global array.
            $config = $GLOBALS['config'];

            // Explode path and return array.
            $path = explode('/', $path);

            // Get access to each 'bit'.
            foreach ($path as $bit) {

                // Check if 'bit' is actually set in the config.
                if(isset($config[$bit])){
                    // If it exists, redefine $config.
                    $config = $config[$bit];
                }
            }

            return $config;
        }
    }
}
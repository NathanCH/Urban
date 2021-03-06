<?php
namespace Urbnio\Helper;

class Route {
    /**
     * @param  $location    string
     * @param  $action      string  (optional)
     * @todo   set up HTTP response controller to handle views and layout.
     */
    public static function redirect($location, $action = null) {

        $path = URL . $location;

        // Handle HTTP repsonse codes.
        if(is_numeric($location)) {

            switch ($location) {
                case 404:
                    header('HTTP/1.0 404 Not Found!');
                    echo 'HTTP 404!';
                    exit();
                break;
            }
        }

        // Append action to path.
        if($action) {
            $path .= '/' . $action;
        }

        header("Location: $path");
    }

    /**
     * Create sluggable URL from string.
     */
    public static function sluggable($string) {
        $string = trim($string);
        $string = strtolower($string);
        $string = preg_replace('~[^\\pL\d]+~u', '-', $string);
        return rawurlencode($string);
    }
}
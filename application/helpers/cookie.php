<?php

/**
 *  Cookie Helper
 */

    class Cookie {

        /**
         *  Check if cookie exists.
         *
         *  @param  string    $name   name of the cookie.
         */
            public static function exists($name) {
                return (isset($_COOKIE[$name])) ? true : false;
            }

        /**
         *  Get the value of a cookie.
         *
         *  @param  string    $name   name of the cookie.
         */
            public static function get($name) {
                return $_COOKIE[$name];
            }

        /**
         *  Create a cookie
         *
         *  @param  string    $name   name of the cookie.
         */
            public static function create($name, $value, $expiry) {
                // Set cookie
                if( setcookie($name, $value, time() + $expiry, '/') ) {
                    return true;
                }

                return false;
            }

        /**
         *  Delete cookie
         *
         *  @param  string    $name   name of the cookie.
         */
            public static function delete($name) {
                // Reset cookie with empty string.
                self::create($name, '', time() - 1);
            }
    }
<?php

/**
 *  Route Class
 *
 *  @author nathancharrois@gmail.com
 */

    class Route {

        /**
         *  Method to handle redirection.
         *  @param $controller  string
         *  @param $action      string  (optional)
         */
            public static function redirect($controller, $action = null) {
                $path = URL . $controller;

                // Append action to path.
                if($action) {
                    $path .= '/' . $action;
                }

                header("Location: $path");
            }
    }
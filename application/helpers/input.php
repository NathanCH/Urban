<?php

/**
 *  Input Class
 *
 *  @todo validate a token to prevent cross site form submission.
 */

    class Input{

        /**
         *  Check if post data exists.
         *  @param $method   string
         */
            public static function exists($method = 'post') {
                switch ($method) {
                    case 'post':
                        return (!empty($_POST)) ? true : false;
                        break;

                    case 'get':
                        return (!empty($_GET)) ? true : false;
                        break;

                    default:
                        return false;
                        break;
                }
            }

        /**
         *  Escape and sanitize $_POST data.
         *  @param $data   string
         */
            public static function escape($data) {
                return htmlentities($data, ENT_QUOTES, 'UTF-8');
            }
    }
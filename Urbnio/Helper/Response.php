<?php
namespace Urbnio\Helper;

/**
 *  Response Helper.
 *
 *  @todo add 404 pages.
 */

    class Response {

        /**
         *  Escape string before displaying.
         *
         *  @param $data   string
         */
            public static function escape($data) {
                return htmlentities($data, ENT_QUOTES, 'UTF-8');
            }
    }
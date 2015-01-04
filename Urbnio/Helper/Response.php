<?php
namespace Urbnio\Helper;

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
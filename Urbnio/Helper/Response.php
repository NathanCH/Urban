<?php
namespace Urbnio\Helper;

class Response {
    public static function escape($data) {
        return htmlentities($data, ENT_QUOTES, 'UTF-8');
    }
}
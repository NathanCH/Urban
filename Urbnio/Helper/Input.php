<?php
namespace Urbnio\Helper;

class Input{
    /**
     * @param $method   string
     */
    public static function exists($method = 'post') {

        switch ($method) {
            case 'post':
                return (!empty($_POST)) ? true : false;
            break;

            case 'file':
                return (!empty($_FILES)) ? true : false;
            break;

            case 'get':
                return (!empty($_GET)) ? true : false;
            break;

            default:
                return false;
            break;
        }
    }
}
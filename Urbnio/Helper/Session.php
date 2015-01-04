<?php
namespace Urbnio\Helper;

class Session {
/**
 *  Put data into a session.
 *
 *  @param  string    $name   name of the session.
 *  @param  value     $value  contents of the session.
 */
    public static function put($name, $value) {
        return $_SESSION[$name] = $value;
    }

/**
 *  Get the session info.
 *
 *  @param  string    $name   name of the session.
 *  @param  value     $value  contents of the session.
 */
    public static function get($name) {
        return $_SESSION[$name];
    }

/**
 *  Check if a session exists.
 *
 *  @param  string    $name   name of the session.
 */

    public static function exists($name) {
        return (isset($_SESSION[$name])) ? true : false;
    }

/**
 *  Delete current session.
 *
 *  @param  string    $name   name of the session.
 */
    public static function delete($name){
        if(self::exists($name)){
            unset($_SESSION[$name]);
        }
    }

/**
 *  Dislpay flash message.
 *
 *  @param string   $name       the name of the session.
 *  @param string   $content    the flash message.
 */

    public static function flash($name, $content = '') {
        if(self::exists($name)) {
            $session = $_SESSION[$name];
            unset($_SESSION[$name]);
            return $session;
        }

        // Assign $content to a session.
        else{
            return $_SESSION[$name] = $content;
        }
    }
}
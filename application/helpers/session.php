<?php

/**
 *  Senssion Helper
 *
 *  @todo create method to create/delete/get sessions.
 */

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
         *  @return boolean           if the session exists.
         */

            public static function exists($name) {
                return (isset($_SESSION[$name])) ? true : false;
            }

        /**
         *  Delete current session.
         *
         *  @param  string    $name   name of the session.
         *  @return boolean           if the session has been deleted.
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
                // If the session already exists.
                if(Session::exists($name)) {
                    // Assign this session to variable.
                    $session = $_SESSION[$name];
                    // Clear the session.
                    unset($_SESSION[$name]);
                    // Return the session as a string.
                    return $session;
                }

                // Assign $content to a session.
                else{
                    return $_SESSION[$name] = $content;
                }
            }

    }
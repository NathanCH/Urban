<?php

/**
 *  Senssion Helper
 *
 *  @todo create method to create/delete/get sessions.
 */

    class Session {

        /**
         *  Check if a session exists.
         *
         *  @param  string    $name   name of the session
         *  @return boolean           if the session exists.
         */

            public static function exists($name) {
                return (isset($_SESSION[$name])) ? true : false;
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
<?php

/**
 *  Hash helper.
 */

    class Hash{
        /**
         *  Generate hash using sha256 with optional salt.
         *
         *  @param string $password   password to be hashed.
         */
            public static function make($password, $salt = '') {
                return hash('sha256', $password . $salt);
            }

        /**
         *  Generated salt.
         *
         *  @param string   $length    set length of salt.
         */
            public static function salt($length) {
                return mcrypt_create_iv($length);
            }

        /**
         *  Check if has is unique.
         */
            public static function unique() {
                return self::make(uniqid());
            }
    }
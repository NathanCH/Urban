<?php
namespace Urbnio\Helper;

/**
 *  Hash helper.
 */

    class Hash{

        /**
         *  @param string $password   password to be hashed.
         */
            public static function encrypt_password($password) {
                return password_hash($password, PASSWORD_DEFAULT);
            }

        /**
         *  @param string $password   password to be dycrpted.
         *  @param string $hash       the user's hash.
         */
            public static function is_correct_password($password, $hash) {
                return password_verify($password, $hash);
            }

        /**
         *  Create a unique hash to store in a session.
         */
            public static function make_session_hash() {
                return bin2hex(openssl_random_pseudo_bytes(16));
            }
    }
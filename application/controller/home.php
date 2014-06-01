<?php

/**
 *  Home Controller
 *
 *  Sets display for the landing page of the application.
 */

    class Home extends Controller {

            public function login() {

                // load views. within the views we can echo out $songs and $amount_of_songs easily
                require 'application/views/_templates/header.php';
                require 'application/views/public/login.php';
                require 'application/views/_templates/footer.php';
            }
    }

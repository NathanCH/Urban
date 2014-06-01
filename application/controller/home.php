<?php

/**
 *  Home Page Controller
 *
 *  Sets display for the landing page of the application.
 */

    class Home extends Controller {

            public function index() {

                // View files.
                require 'application/views/_templates/header.php';
                require 'application/views/public/login.php';
                require 'application/views/_templates/footer.php';
            }
    }

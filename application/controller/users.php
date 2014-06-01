<?php

/**
 *  Users Controller
 */

    class Users extends Controller {

        public function login() {

            // If post data exists.
            if(Input::exists()) {
                var_dump($_POST);

                Route::redirect('home');
            }

        }
    }
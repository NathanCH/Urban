<?php

/**
 *  Users Controller
 */

    class Users extends Controller {

        /**
         *  Action to handle login
         *  @todo show errors
         *  @todo validation rules
         */
            public function login() {

                // If post data exists.
                if(Input::exists()) {

                    // The form input to validate and the validation rules.
                    $items = array(
                        'email' => array(
                            'required' => true
                        ),
                        'password' => array(
                            'required' => true
                        )
                    );

                    // Create validation object.
                    $validate = new Validate();

                    // Check the post data against the validation rules.
                    $validation = $validate->check($_POST, $items);

                    // Display errors.
                    var_dump($validation->errors());

                    //Route::redirect('home');
                }

            }
    }
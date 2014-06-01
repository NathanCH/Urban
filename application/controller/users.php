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

                    // Check if validation has passed.
                    if($validation->passed()) {
                        echo 'passed';
                    }

                    // Render validation errors.
                    else{
                        foreach($validation->errors() as $error) {
                            echo $error . '<br />';
                        }
                    }

                }

                // Route::redirect('home');

                // Render view files.
                $this->render('_templates/header');
                $this->render('public/login');
                $this->render('_templates/footer');

            }
    }
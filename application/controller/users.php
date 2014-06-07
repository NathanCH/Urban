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

                $view = array();

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

                    $errors = array();

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
                        foreach($validation->errors() as $item => $message) {
                            // Send validation errors to view.
                            $data['errors'][] = array('message' => $message, 'item' => $item);
                        }
                    }

                }


                // Route::redirect('home');

                // Render view files.
                $this->render('_templates/header');
                $this->render('public/login', $data);
                $this->render('_templates/footer');

            }
    }
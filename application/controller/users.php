<?php

/**
 *  Users Controller
 *
 *  @author nathancharrois@gmail.com
 */

    class Users extends Controller {

        /**
         *  Handle user login.
         *
         *  @todo process login.
         */
            public function login() {

                // Render view files.
                $this->render('_templates/header');
                $this->render('users/login');
                $this->render('_templates/footer');

            }

        /**
         *  Handle account creation.
         */

            public function register() {

                $data = array();

                // If registration data has been submitted.
                if(Input::exists()) {
                    // The form inputs to validate and the validation rules.
                    $items = array(
                        'email' => array(
                            'required' => true,
                            'min' => 7,
                            'max' => 64,
                            'unique' => 'users'
                        ),
                        'password' => array(
                            'required' => true,
                            'min' => 6
                        ),
                        'confirm-password' => array(
                            'required' => true,
                            'matches' => 'password'
                        )
                    );

                    // Create validation object.
                    $validate = new Validate();

                    // Check the post data against the validation rules.
                    $validation = $validate->check($_POST, $items);

                    // Check if validation has passed.
                    if($validation->passed()) {

                    }

                    // Render validation errors.
                    else{
                        $data = array('errors' => $validation->errors());
                    }

                }

                // Render view files.
                $this->render('_templates/header');
                $this->render('users/register', $data);
                $this->render('_templates/footer');
            }
    }
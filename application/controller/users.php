<?php

/**
 *  Users Controller
 *
 *  @author nathancharrois@gmail.com
 */

    class Users extends Controller {

        /**
         *  Index page.
         *
         *  @todo figure out what to do here.
         */

            public function index() {
                // For now, render blank page.
                $this->render('_templates/header');
                $this->render('pages/blank');
                $this->render('_templates/footer');
            }

        /**
         *  Handle user login.
         *
         *  @todo process login.
         */
            public function login() {

                $data = array();

                // If login details have been submitted.
                if(Input::exists()) {
                    // The form inputs to validate and the validation rules.
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
                    if($validation->passed()){
                        // Load UsersModel.
                        $users_model = $this->loadModel('UsersModel');

                        if($users_model->login($_POST['email'], $_POST['password'])) {

                        }

                        // If login is unsuccesful.
                        else{
                            $data = array('errors' => array('login-failed' => "This email and password combination don't exist."));
                        }
                    }

                    // Render validation errors.
                    else{
                        $data = array('errors' => $validation->errors());
                    }
                }

                // Render view files.
                $this->render('_templates/header');
                $this->render('users/login', $data);
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

                        // Load UsersModel.
                        $users_model = $this->loadModel('UsersModel');

                        // Try to create user.
                        try {

                            $salt       = Hash::salt(32);
                            $password   = Hash::make($_POST['password'], $salt);
                            $created    = date('Y-m-d H:i:s');

                            // Register the user.
                            $users_model->register_user(array(
                                'email'     => $_POST['email'],
                                'password'  => $password,
                                'salt'      => $salt,
                                'group'     => 'user',
                                'created'   => $created
                            ));

                            // Flash message.
                            Session::flash('success', 'You have registered! Login below.');
                            Route::redirect('users', 'login');
                        }

                        catch(Exception $e) {
                            die($e->getMessage());
                        }
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
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
                $this->render('_templates/blank');
                $this->render('_templates/footer');
            }

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
         *
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
                        // Add user to database through model action.
                        // TODO: complete create user.

                        // $users_model = $this->loadModel('UsersModel');
                        // $users_model->add_user($_POST['email'], $_POST['password']);

                        // Flash message.
                        Session::flash('success', 'You have registered! Login below.');
                        Route::redirect('users', 'login');
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
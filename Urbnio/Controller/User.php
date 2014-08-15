<?php
namespace Urbnio\Controller;

use Urbnio\Helper\Input;
use Urbnio\Helper\Validate;
use Urbnio\Helper\Session;
use Urbnio\Helper\Route;
use Urbnio\Helper\Hash;
use Urbnio\Helper\Response;
use Urbnio\Lib\Controller;
use \Exception as Exception;


/**
 *  Users Controller
 *
 *  @author nathancharrois@gmail.com
 */
    class User extends Controller{

        /**
         *  Index page.
         *
         *  @todo figure out what to do here.
         */
            public function index() {

                // Render layout and view files.
                $this->render('static/index', 'pages/blank');
            }

        /**
         *  Handle user login.
         *
         *  @todo process 'if already logged in'. Give option to login as another user.
         *  @todo integrate Google Sign in.
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
                    $validate = new Validate;

                    // Check the post data against the validation rules.
                    $validation = $validate->check($_POST, $items);

                    // Check if validation has passed.
                    if($validation->passed()){
                        // Load UsersModel.
                        $users_model = $this->loadModel('UsersModel');

                        // Check if they want to be remembered.
                        $remember = ($_POST['remember_login'] === '1') ? true : false;

                        // Login the user.
                        if($users_model->login($_POST['email'], $_POST['password'], $remember)) {

                            // Set flash.
                            Session::flash('success', 'Logged in!.');
                            Route::redirect('user', 'edit');
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

               // Render layout and view files.
                $this->render('static/index', 'user/login', $data);
            }

        /**
         *  Log the user out.
         */
            public function logout() {

                // Load UsersModel.
                $users_model = $this->loadModel('UsersModel');

                // Log the user out.
                $users_model->logout();

                // Set session and redirect.
                Session::flash('success', 'Logged out!');
                Route::redirect('user', 'login');
            }



        /**
         *  Account creation.
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
                    $validate = new Validate;

                    // Check the post data against the validation rules.
                    $validation = $validate->check($_POST, $items);

                    // Check if validation has passed.
                    if($validation->passed()) {

                        // Load UsersModel.
                        $users_model = $this->loadModel('UsersModel');

                        // Try to create user.
                        try {

                            $password   = Hash::encrypt_password($_POST['password']);
                            $created    = date('Y-m-d H:i:s');

                            // Register the user.
                            $users_model->register_user(array(
                                'email'     => $_POST['email'],
                                'password'  => $password,
                                'group'     => 'user',
                                'created'   => $created
                            ));

                            // Flash message.
                            Session::flash('success', 'You have registered! Login below.');
                            Route::redirect('user', 'login');
                        }

                        catch(Exception $e) {
                            die($e->getMessage());
                        }
                    }

                    // Render validation errors.
                    else{
                        $data['errors'] = $validation->errors();
                    }

                }

                // Render layout and view files.
                $this->render('static/index', 'user/register', $data);
            }

        /**
         *  Edit user.
         *
         *  @param  $section  section of your profile you would like to edit.
         */
            public function edit($section = null) {

                $data = array();

                $users_model = $this->loadModel('UsersModel');

                // If the current user is not logged in.
                if(!$users_model->isLoggedIn()) {

                    // Redirect to login page.
                    Route::redirect('user/login');
                }

                // If user is logged in.
                else{

                    // Get user data.
                    $user_data = $users_model->data();

                    // Pages to edit.
                    switch ($section) {

                        // Change Password.
                        case 'change-password':

                            // Tell view which section to render.
                            $data['section'] = $section;

                            if(Input::exists()) {

                                // The password data for validation.
                                $items = array(
                                    'current-password' => array(
                                        'required' => true
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
                                $validate = new Validate;

                                // Check the post data against the validation rules.
                                $validation = $validate->check($_POST, $items);

                                // Check if validation has passed.
                                if($validation->passed()) {

                                    // Check if current password is incorrect.
                                    if(!Hash::is_correct_password($_POST['current-password'], $users_model->data()->password)) {

                                        // Print errors.
                                        $data['errors'] = array('Password' => 'incorrect');
                                    }

                                    else{

                                        // Try saving the password.
                                        try {

                                            $password = Hash::encrypt_password($_POST['password']);

                                            $users_model->change_password(array(
                                                'password' => $password
                                            ));

                                            // Flash message.
                                            Session::flash('success', 'Your password has been updated.');

                                            // Redirect.
                                            // Todo: Set up redirect to controller argument.
                                            // Route::redirect('user', 'edit', 'change-password');

                                        }

                                        catch(Exception $e) {
                                            die($e->getMessage());
                                        }
                                    }
                                }

                                // Render validation errors.
                                else{
                                    $data['errors'] = $validation->errors();
                                }

                            }

                        break;

                        // Edit Profile Page.
                        default:

                            // Tell view which section to render.
                            $data['section'] = null;

                            if(Input::exists()) {

                                // The form inputs to validate and the validation rules.
                                $items = array(
                                    'name' => array(
                                        'required' => false,
                                        'min' => 2,
                                        'max' => 64
                                    ),
                                    'email' => array(
                                        'required' => true,
                                        'min' => 7,
                                        'max' => 64
                                    ),
                                    'about' => array(
                                        'required' => false,
                                        'max' => 10000
                                    )
                                );

                                // Create validation object.
                                $validate = new Validate;

                                // Check the post data against the validation rules.
                                $validation = $validate->check($_POST, $items);

                                // Check if validation has passed.
                                if($validation->passed()) {

                                    // Try to edit profile.
                                    try {

                                        // Update the user.
                                        $users_model->update_user(array(
                                            'email' => $_POST['email'],
                                            'name' => $_POST['name'],
                                            'about' => $_POST['about'],
                                            'location' => $_POST['location']
                                        ));

                                        // Flash message.
                                        Session::flash('success', 'Your profile has been updated.');

                                        // Redirect.
                                        Route::redirect('user', 'edit');

                                    }

                                    catch(Exception $e) {
                                        die($e->getMessage());
                                    }
                                }



                                // Render validation errors.
                                else{
                                    $data['errors'] = $validation->errors();
                                }

                            }

                        break;
                    }

                    // Escape and prepare data for view.
                    $data['input']['email']     = Response::escape($user_data->email);
                    $data['input']['name']      = Response::escape($user_data->name);
                    $data['input']['about']     = Response::escape($user_data->about);
                    $data['input']['location']  = Response::escape($user_data->location);
                }

                // Render layout and view files.
                $this->render('static/index', 'user/edit', $data);
            }


    }
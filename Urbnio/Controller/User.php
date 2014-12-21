<?php
namespace Urbnio\Controller;

use Urbnio\Helper\Input;
use Urbnio\Helper\Validate;
use Urbnio\Helper\Session;
use Urbnio\Helper\Route;
use Urbnio\Helper\Hash;
use Urbnio\Helper\Response;
use Urbnio\Helper\i18n;
use Urbnio\Helper\Upload;
use Urbnio\Lib\Controller;
use \Exception as Exception;


/**
 *  Users Controller
 *
 *  @author nathan <nathancharrois@gmail.com>
 */
    class User extends Controller {

        /**
         *  Index page.
         */
            public function index() {

                // Render layout and view files.
                $this->render('splash/index', 'splash/index');
            }

        /**
         *  Handle user login.
         *
         *  @todo process 'if already logged in'. Give option to login as another user.
         *  @todo integrate Google Sign in.
         */
            public function login() {

                $data = array();

                $users_model = $this->loadModel('UsersModel');

                // If the current user is already logged in.
                if($users_model->is_logged_in()) {

                    // Redirect to edit page.
                    Route::redirect('user/edit');
                }

                else {

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
                                Session::flash('success', i18n::lang('flash.login'));
                                Route::redirect('user', 'edit');
                            }

                            // If login is unsuccesful.
                            else{
                                $data = array('errors' => array('login_failed' => "This email and password combination do not exist."));
                            }
                        }

                        // Render validation errors.
                        else{
                            $data = array('errors' => $validation->errors());
                        }
                    }

                    // Set locale date.
                    $data['content']['page-title'] = i18n::lang('page-title.login');
                    $data['content']['button'] = i18n::lang('button.login');
                    $data['content']['form.remember-me'] = i18n::lang('form.remember-me');
                    $data['content']['error.list'] = i18n::lang('error.list');

                    // Render layout and view files.
                    $this->render('static/index', 'user/login', $data);
                }
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
                Session::flash('success', i18n::lang('flash.logged-out'));
                Route::redirect('user', 'login');
            }



        /**
         *  Account creation.
         */
            public function register() {

                $data = array();

                $users_model = $this->loadModel('UsersModel');

                // If the current user is already logged in.
                if($users_model->is_logged_in()) {

                    // Redirect to edit page.
                    Route::redirect('user/edit');
                }

                else {

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
                                // Route::redirect('user/login');
                                Session::flash('success', i18n::lang('flash.registered'));
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

                    // Set locale date.
                    $data['content']['page-title'] = i18n::lang('page-title.register');
                    $data['content']['button'] = i18n::lang('button.create-account');
                    $data['content']['error.list'] = i18n::lang('error.list');

                    // Render layout and view files.
                    $this->render('static/index', 'user/register', $data);

                }
            }

        /**
         *  Edit user.
         *
         *  @todo  abstract file setup and upload.
         */
            public function edit() {

                $data = array();

                $users_model = $this->loadModel('UsersModel');

                // If the current user is not logged in.
                if(!$users_model->is_logged_in()) {

                    // Redirect to login page.
                    Route::redirect('user/login');
                }

                // If user is logged in.
                else{

                    if(Input::exists()) {

                        // Create validation object.
                        $validate = new Validate;

                        // $_POST data and validation.
                        $post_data = array(
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

                        // Validate $_POST data
                        $validation = $validate->check($_POST, $post_data);




                        if($_FILES['profile_photo']['tmp_name']) {

                            // File's validation rules.
                            $file_data = array(
                                'profile_photo' => array(
                                    'required' => false,
                                    'max_file_size' => 1024,
                                    'file_type' => 'image'
                                )
                            );

                            // Setup upload class and set directory.
                            $upload = Upload::start('uploads/users/');

                            // Prepare file for upload.
                            $upload->set_file($_FILES['profile_photo']);

                            // Validate $_FILE data.
                            $upload->set_callback($validation, array('check_file' => $file_data));

                            // Upload the file and get the results.
                            $profile_photo = $upload->upload();
                        }

                        // Check if validation has passed.
                        if($validation->passed()) {

                            // Try to edit profile.
                            try {

                                // Update the user.
                                $users_model->update_user(array(
                                    'location' => $_POST['location'],
                                    'name' => $_POST['name'],
                                    'email' => $_POST['email'],
                                    'about' => $_POST['about']
                                ));

                                if($_FILES['profile_photo']['tmp_name']) {

                                    $users_model->upload_user_file(array(
                                        'user_id' => $users_model->data()->id,
                                        'file_name' => $profile_photo['filename']
                                    ));
                                }

                                // Get updated data.
                                $users_model = $this->loadModel('UsersModel');

                                // Flash message.
                                // Route::redirect('user/edit');
                                Session::flash('success', i18n::lang('flash.update-profile'));
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

                    // Get user data.
                    $user_data = $users_model->data();

                    // Get profile data.
                    $user_profile_photo = $users_model->get('users_file', $users_model->data()->id);

                    // Set locale date.
                    $data['content']['page-title'] = i18n::lang('page-title.edit');
                    $data['content']['form.email-public'] = i18n::lang('form.email-public');
                    $data['content']['button'] = i18n::lang('button.save');
                    $data['content']['error.list'] = i18n::lang('error.list');

                    // Escape and prepare data for view.
                    $data['input']['email']     = Response::escape($user_data->email);
                    $data['input']['name']      = Response::escape($user_data->name);
                    $data['input']['about']     = Response::escape($user_data->about);
                    $data['input']['location']  = Response::escape($user_data->location);

                    if($user_profile_photo){
                        // Additional profile data.
                        $data['profile_photo']['set']          = true;
                        $data['profile_photo']['file_name']    = $user_profile_photo->file_name;
                    }

                    else{
                        $data['profile_photo']['set']          = false;
                    }

                }

                // Render layout and view files.
                $this->render('static/index', 'user/edit', $data);
            }

        /**
         *  Change password.
         */
            public function change_password() {

                $data = array();

                $users_model = $this->loadModel('UsersModel');

                // If the current user is not logged in.
                if(!$users_model->is_logged_in()) {

                    // Redirect to login page.
                    Route::redirect('User/login');
                }

                // If user is logged in.
                else{

                    // Get user data.
                    $user_data = $users_model->data();

                    if(Input::exists()) {

                        // The password data for validation.
                        $items = array(
                            'current-password' => array(
                                'required' => true,
                                'check_password' => $users_model->data()->password
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

                            // Try saving the password.
                            try {

                                $password = Hash::encrypt_password($_POST['password']);

                                $users_model->change_password(array(
                                    'password' => $password
                                ));

                                // Flash message.
                                Session::flash('success', i18n::lang('flash.update-password'));
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
                }

                // Set locale date.
                $data['content']['page-title'] = i18n::lang('page-title.change-password');
                $data['content']['button'] = i18n::lang('button.save');
                $data['content']['button.forgot-password'] = i18n::lang('button.forgot-password');
                $data['content']['error.list'] = i18n::lang('error.list');


                // Render layout and view files.
                $this->render('static/index', 'user/change-password', $data);
            }
    }
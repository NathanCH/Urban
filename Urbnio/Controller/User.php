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

class User extends Controller {

    public function index() {
        Route::redirect('user/login');
    }

    /**
     * @todo process 'if already logged in'. Give option to login as another user.
     * @todo integrate Google Sign in.
     */
    public function login() {

        $data = array();
        $users_model = $this->loadModel('UsersModel');

        if($users_model->is_logged_in()) {
            Route::redirect('user/edit');
        }

        else {

            if(Input::exists()) {

                $items = array(
                    'email' => array(
                        'required' => true
                    ),
                    'password' => array(
                        'required' => true
                    )
                );

                $validate = new Validate;
                $validation = $validate->check($_POST, $items);

                if($validation->passed()){

                    $users_model = $this->loadModel('UsersModel');

                    // Check if they want to be remembered.
                    $remember = ($_POST['remember_login'] === '1') ? true : false;

                    if($users_model->login($_POST['email'], $_POST['password'], $remember)) {
                        Session::flash('success', i18n::lang('flash.login'));
                        Route::redirect('user', 'edit');
                    }

                    else{
                        $data = array('errors' => array('login_failed' => "This email and password combination do not exist."));
                    }
                }

                else{
                    $data = array('errors' => $validation->errors());
                }
            }

            $data['content']['page-title'] = i18n::lang('page-title.login');
            $data['content']['button'] = i18n::lang('button.login');
            $data['content']['form.remember-me'] = i18n::lang('form.remember-me');
            $data['content']['error.list'] = i18n::lang('error.list');

            $this->render('static_layout', 'user/login', $data);
        }
    }

    public function logout() {
        $users_model = $this->loadModel('UsersModel');
        $users_model->logout();
        Session::flash('success', i18n::lang('flash.logged-out'));
        Route::redirect('user', 'login');
    }

    public function register() {

        $data = array();
        $users_model = $this->loadModel('UsersModel');

        if($users_model->is_logged_in()) {
            Route::redirect('user/edit');
        }

        else {

            if(Input::exists()) {

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

                $validate = new Validate;
                $validation = $validate->check($_POST, $items);

                if($validation->passed()) {

                    $users_model = $this->loadModel('UsersModel');

                    try {

                        $password = Hash::encrypt_password($_POST['password']);
                        $created = date('Y-m-d H:i:s');

                        $users_model->register_user(array(
                            'email'     => $_POST['email'],
                            'password'  => $password,
                            'group'     => 'user',
                            'created'   => $created
                        ));

                        Session::flash('success', i18n::lang('flash.registered'));
                    }

                    catch(Exception $e) {
                        die($e->getMessage());
                    }
                }

                else{
                    $data['errors'] = $validation->errors();
                }
            }

            $data['content']['page-title'] = i18n::lang('page-title.register');
            $data['content']['button'] = i18n::lang('button.create-account');
            $data['content']['error.list'] = i18n::lang('error.list');

            $this->render('static_layout', 'user/register', $data);
        }
    }

    public function edit() {

        $data = array();
        $users_model = $this->loadModel('UsersModel');

        if(!$users_model->is_logged_in()) {
            Route::redirect('user/login');
        }

        else{

            if(Input::exists()) {

                $validate = new Validate;
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

                $validation = $validate->check($_POST, $post_data);

                if($validation->passed()) {

                    try {
                        $users_model->update_user(array(
                            'location' => $_POST['location'],
                            'name' => $_POST['name'],
                            'email' => $_POST['email'],
                            'about' => $_POST['about']
                        ));

                        // Get updated data.
                        $users_model = $this->loadModel('UsersModel');

                        Session::flash('success', i18n::lang('flash.update-profile'));
                    }

                    catch(Exception $e) {
                        die($e->getMessage());
                    }
                }

                else{
                    $data['errors'] = $validation->errors();
                }
            }

            $user_data = $users_model->data();
            $user_profile_photo = $users_model->get('users_file', $users_model->data()->id);

            $data['content']['page-title'] = i18n::lang('page-title.edit');
            $data['content']['form.email-public'] = i18n::lang('form.email-public');
            $data['content']['button'] = i18n::lang('button.save');
            $data['content']['error.list'] = i18n::lang('error.list');

            $data['input']['email']     = Response::escape($user_data->email);
            $data['input']['name']      = Response::escape($user_data->name);
            $data['input']['about']     = Response::escape($user_data->about);
            $data['input']['location']  = Response::escape($user_data->location);

            if($user_profile_photo){
                $data['profile_photo']['set']          = true;
                $data['profile_photo']['file_name']    = $user_profile_photo->file_name;
            }

            else{
                $data['profile_photo']['set']          = false;
            }
        }

        $this->render('static_layout', 'user/edit', $data);
    }

    public function change_password() {

        $data = array();
        $users_model = $this->loadModel('UsersModel');

        if(!$users_model->is_logged_in()) {
            Route::redirect('User/login');
        }

        else{

            $user_data = $users_model->data();

            if(Input::exists()) {
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

                $validate = new Validate;
                $validation = $validate->check($_POST, $items);

                if($validation->passed()) {

                    try {
                        $password = Hash::encrypt_password($_POST['password']);
                        $users_model->change_password(array(
                            'password' => $password
                        ));

                        Session::flash('success', i18n::lang('flash.update-password'));
                    }

                    catch(Exception $e) {
                        die($e->getMessage());
                    }
                }

                else{
                    $data['errors'] = $validation->errors();
                }
            }
        }

        $data['content']['page-title'] = i18n::lang('page-title.change-password');
        $data['content']['button'] = i18n::lang('button.save');
        $data['content']['button.forgot-password'] = i18n::lang('button.forgot-password');
        $data['content']['error.list'] = i18n::lang('error.list');

        $this->render('static_layout', 'user/change-password', $data);
    }
}
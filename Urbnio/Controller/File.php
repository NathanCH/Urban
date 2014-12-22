<?php
namespace Urbnio\Controller;

use Urbnio\Lib\Controller;
use Urbnio\Helper\Input;
use Urbnio\Helper\Upload;
use Urbnio\Helper\Route;
use Urbnio\Helper\Validate;
use \Exception as Exception;


/**
 *  Upload Controller
 *
 *  @author nathan <nathancharrois@gmail.com>
 */
    class File extends Controller {

        public function add_profile_photo() {


            $users_model = $this->loadModel('UsersModel');

            // If the current user is already logged in.
            if(!$users_model->is_logged_in()) {

                // Redirect to edit page.
                Route::redirect('user/edit');
            }

            // If user is logged in.
            else{

                if(Input::exists('file')) {

                    $validate = new Validate;

                    $file_data = array(
                        'profile_photo' => array(
                            'required' => true,
                            'max_file_size' => 125,
                            'file_type' => 'image'
                        )
                    );

                    // Setup upload class and set directory.
                    $upload = new Upload('uploads/users/');

                    // Prepare file for upload.
                    $upload->set_file($_FILES['files']);

                    $profile_photo = $upload->upload();

                    $validation = $validate->check_file($upload, $file_data);

                    // Check if validation has passed.
                    if($validate->passed()) {

                        // Try to edit profile.
                        try {

                            $users_model->upload_user_file(array(
                                'user_id' => $users_model->data()->id,
                                'file_name' => $profile_photo['filename']
                            ));

                            // Get profile data.
                            $user_profile_photo = $users_model->get('users_file', $users_model->data()->id);

                            echo USER_UPLOAD_PATH . '/' . $user_profile_photo->file_name;

                            // Flash message.
                            // Route::redirect('user/edit');
                            // Session::flash('success', i18n::lang('flash.update-profile'));
                        }

                        catch(Exception $e) {
                            die($e->getMessage());
                        }

                    }
                }
            }



            // 2. In controller, upload file normally. Then generate 3 sizes of avatar with image path.
            // 3. Save images as current image name + _small, _medium, _large.
            // 4. On display page, get the current image name, and depending on the situation display certain size.
            // var_dump($_FILES['files']);

            // $path = 'http://localhost/2014/urban/uploads/users/55a5e3158734e585ee061bf1e54bf0b55b06b3101417161134';

            // echo $path;
        }

    }
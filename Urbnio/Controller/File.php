<?php
namespace Urbnio\Controller;
use Urbnio\Helper\Input;
use Urbnio\Helper\Route;
use Urbnio\Helper\Upload;
use Urbnio\Helper\Validate;
use Urbnio\Helper\ImageResize;
use Urbnio\Lib\Controller;
use \Exception as Exception;

class File extends Controller {

    public function add_profile_photo() {

        $users_model = $this->loadModel('UsersModel');

        // If the current user is already logged in.
        if (!$users_model->is_logged_in()) {

            // Redirect to edit page.
            Route::redirect('user/edit');
        }

        // If user is logged in.
        else {

            if (Input::exists('file')) {

                $validate = new Validate;

                $file_data = array(
                    'profile_photo' => array(
                        'required' => true,
                        'max_file_size' => 8000,
                        'file_type' => 'image',
                    ),
                );

                // Setup upload class and set directory.
                $upload = new Upload('uploads/users/');

                // Prepare file for upload.
                $upload->set_file($_FILES['files']);
                $profile_photo = $upload->upload();
                $validation = $validate->check_file($upload, $file_data);

                // Check if validation has passed.
                if ($validate->passed()) {

                    // Try to edit profile.
                    try {

                        $image = USER_UPLOAD_PATH . '/' . $profile_photo['filename'];

                        // Update user file record.
                        $users_model->upload_user_file(array(
                            'user_id' => $users_model->data()->id,
                            'file_name' => $this->create_image($image, 'square_90'),
                        ));

                        $user_profile_photo = $users_model->get('users_file', $users_model->data()->id);
                        echo URL . $user_profile_photo->file_name;

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                }
            }
        }
    }

    private function create_image($image, $size) {
        $file_type = IMAGETYPE_JPEG; // ImageResize property.

        $file_name = array(
            'square_90' => '_90x90.jpg',
            'square_24' => '_24x24.jpg'
        );

        $new_image = new ImageResize($image);
        $new_file_name = $image . $file_name[$size];

        switch ($size) {
            case 'square_90':
                $new_image->crop(90, 90);
                $new_image->save($new_file_name, $file_type);
            break;
            case 'square_24':
                $new_image->crop(24, 24);
                $new_image->save($new_file_name, $file_type);
            break;
        }

        return $new_file_name;
    }
}
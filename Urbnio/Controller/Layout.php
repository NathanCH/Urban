<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;

/**
 *  Layout Controller
 *
 *  @author nathan <nathancharrois@gmail.com>
 */
    class Layout extends Controller {

            public function fetch_header() {

                $data = array();

                $users_model = $this->loadModel('UsersModel');

                // If the current user is logged in.
                if($users_model->is_logged_in()) {

                    $user_data = $users_model->data();

                    $data['logged_in'] = true;
                    $data['user_data'] = (array) $user_data;

                     // Get profile data.
                    $user_profile_photo = $users_model->get('users_file', $users_model->data()->id);

                    if($user_profile_photo){
                        // Additional profile data.
                        $data['profile_photo']['set']          = true;
                        $data['profile_photo']['file_name']    = $user_profile_photo->file_name;
                    }

                    else{

                        $data['profile_photo']['set']          = false;
                    }
                }

                $data['header'] = $this->view('_templates/header', $data);

                return $data;
            }

            public function fetch_footer() {

                $data['footer'] = $this->view('_templates/footer');

                return $data;
            }

    }
?>
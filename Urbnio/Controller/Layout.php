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

                // If the current user is already logged in.
                if($users_model->is_logged_in()) {

                    $user_data = $users_model->data();

                    $data['logged_in'] = true;
                    $data['user_data'] = (array) $user_data;
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
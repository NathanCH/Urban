<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;

/**
 *  Layout Controller
 *
 *  @author nathan <nathancharrois@gmail.com>
 */
    class Layout extends Controller {

            private $_path = null;

            public function get_path() {
                return $this->_path;
            }

            public function splash_layout() {
                $data['header'] = $this->fetch_header();
                $data['footer'] = $this->fetch_footer();

                $this->_path = 'splash/index';
                return $data;
            }

            public function static_layout() {
                $data['header'] = $this->fetch_header();
                $data['footer'] = $this->fetch_footer();

                $this->_path = 'static/index';
                return $data;
            }

            public function pages_layout($page) {
                $data['header'] = $this->fetch_header();
                switch ($page) {
                    case 'pages/index':
                        $data['hero'] = $this->fetch_hero();
                        // Fetch cities.
                    break;
                }

                $data['footer'] = $this->fetch_footer();

                $this->_path = $page;
                return $data;
            }

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
                return $this->view('Templates/header', $data);
            }

            public function fetch_footer() {
                return $this->view('Templates/footer');
            }

            public function fetch_hero() {
                return $this->view('Components/hero');
            }

    }
?>
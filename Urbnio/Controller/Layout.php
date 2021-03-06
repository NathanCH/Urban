<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;
use Urbnio\Helper\i18n;

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
            break;
        }

        $data['footer'] = $this->fetch_footer();
        $this->_path = $page;

        return $data;
    }

    public function map_layout() {
        $data['header'] = $this->fetch_header();
        $this->_path = 'map/index';

        return $data;
    }

    public function fetch_header() {

        $data = array();
        $users_model = $this->loadModel('UsersModel');

        if($users_model->is_logged_in()) {

            $user_data = $users_model->data();

            $data['logged_in'] = true;
            $data['user_data'] = (array) $user_data;

             // Get profile data.
            $user_profile_photo = $users_model->get('users_file', $users_model->data()->id);

            if($user_profile_photo){
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
        $data['content']['button'] = i18n::lang('button.search-listings');
        return $this->view('Components/hero', $data);
    }
}
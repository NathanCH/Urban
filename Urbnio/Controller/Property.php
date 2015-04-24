<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;
use Urbnio\Helper\Input;
use Urbnio\Helper\i18n;
use Urbnio\Helper\Validate;
use Urbnio\Helper\Route;

class Property extends Controller {

    public function index() {
        $this->render('static_layout', 'pages/blank');
    }

    public function add() {

        $data = array();
        $users_model = $this->loadModel('UsersModel');

        if(!$users_model->is_logged_in()) {
            Route::redirect('user/login');
        }

        else{

            if(Input::exists()) {

                $items = array(
                    'name' => array(
                        'required' => true
                    ),
                    'address' => array(
                        'required' => true
                    )
                );

                $validate = new Validate;
                $validation = $validate->check($_POST, $items);

                if($validation->passed()) {
                    echo 'passed';
                }
                else {
                    $data['errors'] = $validation->errors();
                }
            }

            $data['logged_in'] = true;
            $data['content']['page-title'] = i18n::lang('page-title.add-property');
            $data['content']['button'] = i18n::lang('button.next-step');
            $data['content']['error.list'] = i18n::lang('error.list');
        }

        $this->render('static_layout', 'property/add', $data);
    }
}
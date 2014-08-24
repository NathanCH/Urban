<?php
namespace Urbnio\Controller;

use Urbnio\Lib\Controller;
use Urbnio\Helper\Input;
use Urbnio\Helper\i18n;
use Urbnio\Helper\Validate;


/**
 *  Property Controller
 *
 *  @author nathancharrois@gmail.com
 */
    class Property extends Controller {

        /**
         * Add property.
         */
            public function add() {

                $data = array();

                $users_model = $this->loadModel('UsersModel');

                // If the current user is not logged in.
                if(!$users_model->is_logged_in()) {

                    // Redirect to login page.
                    Route::redirect('User/login');
                }

                // If the user is logged in.
                else{

                    if(Input::exists()) {

                        $items = array(
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

                    // Logged in.
                    $data['logged_in'] = true;

                    // Set locale data.
                    $data['content']['label'] = i18n::lang('label.add-property');
                    $data['content']['button'] = i18n::lang('button.next-step');
                    $data['content']['error.list'] = i18n::lang('error.list');

                }

                // Render layout and view files.
                $this->render('Static/index', 'Property/add', $data);
            }

    }
?>
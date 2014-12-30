<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;
use Urbnio\Helper\Input;
use Urbnio\Helper\i18n;
use Urbnio\Helper\Validate;
use Urbnio\Helper\Route;


/**
 *  Pages Controller
 *
 *  @author nathan <nathancharrois@gmail.com>
 */
    class Pages extends Controller {

        public function index() {
            $data = array();
            $regions_model = $this->loadModel('RegionsModel');
            $regions_list = $regions_model->data();

            $data['regions_list'] = $regions_list;

            $this->render('pages_layout', 'pages/index', $data);
        }
    }
?>
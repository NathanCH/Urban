<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;
use Urbnio\Helper\Input;
use Urbnio\Helper\i18n;
use Urbnio\Helper\Validate;
use Urbnio\Helper\Route;

class Pages extends Controller {

    public function index() {
        $data = array();
        $regions_model = $this->loadModel('RegionsModel');
        $regions_list = $regions_model->data();

        $ratings_model = $this->loadModel('RatingsModel');
        $ratings_model->set_category('region');
        $rating = $ratings_model->get_rating('1');

        if($rating) {
            echo $rating;
        }

        $data['regions_list'] = $regions_list;
        $this->render('pages_layout', 'pages/index', $data);
    }
}

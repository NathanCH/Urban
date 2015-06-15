<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;
use Urbnio\Behaviour\TreeBehaviour;
use Urbnio\Helper\Route;

class Pages extends Controller {

    public function index() {
        $data = array();
        $rating = array();
        $region_block = array();

        $regions_model = $this->loadModel('RegionsModel');
        $regions_list = $regions_model->data();

        $ratings_model = $this->loadModel('RatingsModel');
        $ratings_model->set_category('region');

        // Get Region data.
        // todo: move to its own controller.
        foreach ($regions_list as $regions => $region) {
            $region_block[$region->id] = array(
                'id' => $region->id,
                'name' => $region->name,
                'short_name' => $region->short_name,
                'level' => $region->level,
                'rating' => $ratings_model->get_rating($region->id),
                'article_count' => null,
                'region_picture' => null,
                'link' => Route::sluggable($region->name)
            );
        }

        $data['regions_list'] = $region_block;
        $this->render('pages_layout', 'pages/index', $data);
    }
}

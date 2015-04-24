<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;

class Map extends Controller {

    public function index() {
        $this->render('map_layout', 'map/index');
    }
}

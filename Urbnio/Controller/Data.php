<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;
use Urbnio\Helper\Tunnel;

class Data extends Controller {

    private $tunnel;

    public function __construct() {
        $this->tunnel = new Tunnel();
    }

    public function get($data_type, $location) {
        return $this->$data_type($location);
    }

    public function drinking_water($location) {
        return $this->tunnel->get('
            node
                ["name"="'.ucfirst($location).'"];
            node
                (around:5000)
                ["amenity"="drinking_water"];
        ');
    }

    public function waste_basket($location) {
        return $this->tunnel->get('
            node
                ["name"="'.ucfirst($location).'"];
            node
                (around:10000)
                ["amenity"="waste_basket"];
        ');
    }
}


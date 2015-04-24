<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;
use Urbnio\Helper\Tunnel;

class Data extends Controller {

    public function drinking_water($location) {
        $tunnel = new Tunnel();
        $results = $tunnel->query('
            node
                ["name"="'.ucfirst($location).'"];
            node
                (around:5000)
                ["amenity"="drinking_water"];
        ');

        return $results;
    }
}


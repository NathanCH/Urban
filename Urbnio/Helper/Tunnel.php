<?php
namespace Urbnio\Helper;
use \Exception as Exception;

class Tunnel{

    private $connection;
    private $api_endpoint = "http://overpass-api.de/api/";

    public function query($query) {

        $ch = curl_init();
        $url = $this->api_endpoint . 'interpreter?data=[out:json][timeout:25];' . $query . 'out;';

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $output = curl_exec($ch);

        curl_close($ch);

        return $output;
    }
}
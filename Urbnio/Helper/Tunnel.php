<?php
namespace Urbnio\Helper;
use \Exception as Exception;

/**
 * TunnelHelper
 * Interact with Urbn DB and Overpass API to return OSM data.
 *
 * @link   http://overpass-api.de/
 * @author nathancharrois@gmail.com
 */
class Tunnel{

    private $api_endpoint = "http://overpass-api.de/api/interpreter?data=";
    private $query_options = [
        'output' => 'json',
        'timeout' => 25
    ];

    public function __construct(array $options = null) {
        if($options) {
           $this->query_options = $options;
        }

        $this->api_endpoint .= $this->set_options();
    }

    public function get($data) {
        return $this->request($data);
    }

    private function set_options() {
        $output = "[out:{$this->query_options['output']}]";
        $timeout = "[timeout:{$this->query_options['timeout']}];";

        return $output . $timeout;
    }

    private function request($data) {

        $query = preg_replace('/\s+/', '', $data);
        $url = $this->api_endpoint . $query . 'out;';
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);

        $output = curl_exec($curl);

        curl_close($curl);

        return $output;
    }
}
<?php
namespace Urbnio\Model;
use Urbnio\Helper\DB;
use Urbnio\Helper\Session;
use \Exception as Exception;

class RegionsModel{

    private $_db = null,
            $_data;

    public function __construct($building = null) {
        $this->_db = DB::getInstance();

        if($building){
            $this->find($building);
        }

        else{
            $this->get_last_updated();
        }
    }

    public function find($building = null) {
        if($building) {
            $data = $this->_db->query("SELECT * FROM regions WHERE `id` = ?", array($building));
            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
            return false;
        }
        return true;
    }

    public function get_last_updated($count = null) {
        if(!$count) {
            $data = $this->_db->query("SELECT * FROM regions");
        }
        else{
            $data = $this->_db->query("SELECT * FROM regions LIMIT $count");
        }
        $this->_data = $data->results();
    }

    public function data() {
        return $this->_data;
    }
}
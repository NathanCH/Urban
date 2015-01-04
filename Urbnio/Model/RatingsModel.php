<?php
namespace Urbnio\Model;
use Urbnio\Helper\DB;
use Urbnio\Helper\Session;
use Urbnio\Helper\i18n;
use \Exception as Exception;

class RatingsModel{

    private $_db = null,
            $_data,
            $_category,
            $_allowed_categories = array(
                'region',
                'building',
                'event'
            );

    function __construct($building = null) {
        $this->_db = DB::getInstance();
    }

    private function match_category($category) {
        if(in_array($category, $this->_allowed_categories)) {
            return true;
        }
    }

    public function get_rating($item_id) {
        if($this->get_data($item_id)) {
            return $this->_data->rating;
        }
        return false;
    }

    private function get_data($item_id) {
        if($this->match_category($this->_category)) {
            $data = $this->_db->query("
                SELECT FORMAT(AVG(rating), 2) 'rating'
                FROM ratings
                WHERE `category` = ?", array(
                    $this->_category
            ));

            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }

            return false;
        }

        return false;
    }

    public function set_category($category) {
        return $this->_category = $category;
    }
}
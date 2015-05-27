<?php
namespace Urbnio\Model;
use Urbnio\Helper\DB;

class HierarchyModel {

    private $db = null,
            $hierarchy = null,
            $items_table = 'items_test';

    public function __construct() {
        $this->db = DB::getInstance();
        $this->hierarchy_levels = $this->hierarchy_levels();
    }

    /**
     * Associate hierarchy levels to names.
     *
     * @return hierarchy level name array (eg. Country, Region, City).
     */
    private function hierarchy_levels() {
        $data = $this->db->query("SELECT * FROM hierarchy_levels");

        if($data->count()) {
            foreach($data->results() as $level => $info) {
                $hierarchy[] = $info->name;
            }

            return $hierarchy;
        }
    }

    /**
     * Return parents starting from node.
     */
    public function get_parents($item_id) {
        $data = $this->db->query("
            SELECT v.*
            FROM ".$this->items_table." v
            JOIN hierarchy_paths t
            ON (v.id = t.ancestor)
            WHERE t.descendant = {$item_id};
        ");

        return $data->results();
    }
}
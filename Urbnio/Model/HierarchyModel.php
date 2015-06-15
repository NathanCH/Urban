<?php
namespace Urbnio\Model;
use Urbnio\Helper\DB;

class HierarchyModel {

    private $db = null,
            $hierarchy_levels = null,
            $items_table = 'hierarchy_items';

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

     private function is_level($level) {
        return array_key_exists($level, $this->hierarchy_levels);
    }


    private function is_item($item_id) {
        return is_numeric($item_id) && floor($item_id) == $item_id;
    }

    /**
     * Return parents of a node.
     */
    public function get_parents($item_id) {
        if(!$this->is_item($item_id)) {
            return false;
        }

        $data = $this->db->query("
            SELECT v.*
            FROM ".$this->items_table." v
            JOIN hierarchy_paths t
            ON (v.id = t.ancestor)
            WHERE t.descendant = {$item_id};
        ");

        return $data->results();
    }

    /**
     * Return all children of a node.
     *
     * @param int $item_id
     * @param int $depth    limit returned items by distance from $item_id.
     */
    public function get_children($item_id, $depth = false) {
        if(!$this->is_item($item_id)) {
            return false;
        }

        $query = "
            SELECT v.*
            FROM ".$this->items_table." v
            JOIN hierarchy_paths t
            ON (v.id = t.descendant)
            WHERE t.ancestor = {$item_id}
        ";

        if($depth) {
            $query .= "AND t.length <= {$depth}";
        }

        $data = $this->db->query($query);

        return $data->results();
    }

    /**
     * Return nodes by distance from root.
     */
    public function get_items_by_depth($depth) {
        if(!$this->is_level($depth)) {
            return false;
        }

        $data = $this->db->query("
            SELECT v.*
            FROM ".$this->items_table." v
            JOIN hierarchy_paths t
            ON (v.id = t.descendant)
            WHERE t.length = {$depth}
            AND t.ancestor = 4;
        ");

        return $data->results();
    }
}
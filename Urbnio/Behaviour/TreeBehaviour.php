<?php
namespace Urbnio\Behaviour;
use Urbnio\Model\HierarchyModel;
use Urbnio\Helper\DB;
use Urbnio\Helper\Route;

class TreeBehaviour extends HierarchyModel {

    /**
     * Convert to useable array.
     */
    private function build_array($items) {

        $items_array = array();

        foreach ($items as $key => $item) {

            $path = $this->build_path($item->id);

            // Build item array.
            $item_array[$key]['id']   = $item->id;
            $item_array[$key]['name'] = $item->value;
            $item_array[$key]['path'] = $path;
        }

        return $item_array;
    }

    /**
     * Build path.
     */
    public function build_path($item_id) {

        $path = null;
        $parents = array_reverse($this->get_parents($item_id));

        foreach ($parents as $id => $parent) {
            $path .= Route::sluggable($parent->value) . '/';
        }

        return $path;
    }

    /**
     * Build breadcrumbs array.
     *
     * @param  $item_id   all parents of this node.
     * @return array      breadcrumb text and path.
     */
    public function breadcrumbs($item_id) {

        // Set to ascending order.
        $parents = array_reverse($this->get_parents($item_id));

        return $this->build_array($parents);
    }

    /**
     * Build tree starting from any node.
     *
     * @param   $depth  depth of the tree.
     * @return  array   array of children and their properties.
     */
    public function build_tree($item_id, $depth = false) {
        $items =  $this->get_children($item_id, $depth);
        return $this->build_array($items);
    }

    public function build_tree_from_level($level) {
        $items = $this->get_items_by_depth($level);
        return $this->build_array($items);
    }
}
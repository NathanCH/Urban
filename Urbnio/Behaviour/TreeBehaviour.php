<?php
namespace Urbnio\Behaviour;
use Urbnio\Model\HierarchyModel;
use Urbnio\Helper\DB;
use Urbnio\Helper\Route;

class TreeBehaviour extends HierarchyModel {

    /**
     * Build breadcrumbs array.
     *
     * @param  int      starting
     * @return array    breadcrumb text and path.
     */
    public function breadcrumbs($item_id) {

        // Set to ascending order.
        $parents = array_reverse($this->get_parents($item_id));

        // Store controller path.
        $path = null;

        foreach ($parents as $key => $parent) {

            // Append each parent to current path.
            $path .= Route::sluggable($parent->value) . '/';

            // Build item array.
            $item_array[$key]['name'] = $parent->value;
            $item_array[$key]['path'] = $path . $parent->id;
        }

        return $item_array;
    }
}
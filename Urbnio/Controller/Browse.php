<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;
use Urbnio\Behaviour\TreeBehaviour;
use Urbnio\Helper\Input;
use Urbnio\Helper\i18n;
use Urbnio\Helper\Validate;
use Urbnio\Helper\Route;

class Browse extends Controller {

    public function index() {

        $data = array();
        $tree = new TreeBehaviour;

        $data['breadcrumbs'] = $tree->breadcrumbs('12');
        $data['items'] = $tree->build_tree_from_level(REGION);

        $data['content']['page-title'] = i18n::lang('page-title.browse');
        $this->render('static_layout', 'browse/index', $data);
    }
}
<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;

class Splash extends Controller {

    public function index() {
        $this->render('splash_layout', 'splash/index');
    }

}
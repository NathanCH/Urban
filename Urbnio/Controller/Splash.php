<?php
namespace Urbnio\Controller;

use Urbnio\Lib\Controller;


/**
 *  Users Controller
 *
 *  @author nathan <nathancharrois@gmail.com>
 */
    class Splash extends Controller {

        /**
         *  Splash page.
         */
            public function index() {

                // Render layout and view files.
                $this->render('splash/index', 'splash/index');
            }

    }
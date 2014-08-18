<?php
namespace Urbnio\Controller;

use Urbnio\Lib\Controller;


/**
 *  Users Controller
 *
 *  @author nathancharrois@gmail.com
 */
    class Splash extends Controller {


        /**
         *  Index page.
         *
         *  @todo figure out what to do here.
         */
            public function index() {

                // Render layout and view files.
                $this->render('Splash/index', 'Splash/index');
            }

    }
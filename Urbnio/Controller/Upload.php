<?php
namespace Urbnio\Controller;

use Urbnio\Lib\Controller;


/**
 *  Upload Controller
 *
 *  @author nathan <nathancharrois@gmail.com>
 */
    class Upload extends Controller {

        public function profile_photo() {

            $path = 'http://localhost/2014/urban/uploads/users/55a5e3158734e585ee061bf1e54bf0b55b06b3101417161134';

            echo $path;
        }

    }
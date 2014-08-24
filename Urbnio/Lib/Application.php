<?php
namespace Urbnio\Lib;
use Urbnio\Controller\User;
use Urbnio\Helper\Cookie;
use Urbnio\Helper\Input;
use Urbnio\Helper\Session;
use Urbnio\Helper\DB;
use Urbnio\Helper\i18n;

class Application {

    private $url_controller = null,
            $url_action = null,
            $url_parameter_1 = null,
            $url_parameter_2 = null,
            $url_parameter_3 = null;

    /**
     *  "Start" the application:
     *  Analyze the URL elements and calls the according controller/method or the fallback
     *
     *  @author panique@web.de
     */
        public function __construct() {

            // Start session.
            session_start();

            // Set user's location.
            $this->set_session_language();

            // Create array with URL parts in $url
            $this->splitUrl();

            // Check for controller: does such a controller exist ?
            if (file_exists('./Urbnio/Controller/' . $this->url_controller . '.php')) {

                // Append controller action to class location.
                $controller_action = $this->url_controller;
                $class_location = '\\Urbnio\\Controller\\' . $controller_action;

                $this->url_controller = new $class_location;

                // Check for method: does such a method exist in the controller?
                if (method_exists($this->url_controller, $this->url_action)) {

                    // Call the method and pass the arguments to it.
                    if (isset($this->url_parameter_3)) {
                        // Will translate to something like $this->home->method($param_1, $param_2, $param_3);
                        $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3);
                    } elseif (isset($this->url_parameter_2)) {
                        // Will translate to something like $this->home->method($param_1, $param_2);
                        $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2);
                    } elseif (isset($this->url_parameter_1)) {
                        // Will translate to something like $this->home->method($param_1);
                        $this->url_controller->{$this->url_action}($this->url_parameter_1);
                    } else {
                        // If no parameters given, just call the method without parameters, like $this->home->method();
                        $this->url_controller->{$this->url_action}();
                    }
                } else {
                    // Default/fallback: call the index() method of a selected controller.
                    $this->url_controller->index();
                }
            } else {

                $splash = new User();
                $splash->login();
            }
        }

    /**
     *  Get and split the URL
     *
     *  @author panique@web.de
     */
        private function splitUrl() {

            if (isset($_GET['url'])) {

                // Split URL.
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);

                // Put URL parts into according properties.
                $this->url_controller = (isset($url[0]) ? $url[0] : null);
                $this->url_action = (isset($url[1]) ? $url[1] : null);
                $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
                $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
                $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);

                // For debugging.
                // echo 'Controller: ' . $this->url_controller . '<br />';
                // echo 'Action: ' . $this->url_action . '<br />';
                // echo 'Parameter 1: ' . $this->url_parameter_1 . '<br />';
                // echo 'Parameter 2: ' . $this->url_parameter_2 . '<br />';
                // echo 'Parameter 3: ' . $this->url_parameter_3 . '<br />';
            }
        }


        /**
         *  Set language.
         *
         *  @todo set users location based on input.
         */
            public function set_session_language() {

                // English.
                if(APP_LOCALE == 'en_us') {

                    // Get path to language file.
                    $path = LANG_PATH . '/' . APP_LOCALE . LANG_FILE_EXT;

                }

                // Set language data.
                $language_data = include $path;

                $i18n = new i18n;

                $i18n->set_language_data($language_data);

            }
}

<?php
namespace Urbnio\Lib;
use Urbnio\Controller\Layout;

/**
 *  This is the "base controller class". All other controllers extend this class.
 */
    class Controller {

        /**
         *  Load the model with the given name.
         *
         *  @param   string $model_name      The name of the model
         *  @param   string $dependency      Pass the model dependencies.
         *  @return  object model
         *
         *  @author panique@web.de
         */
            public function loadModel($model_name, $dependency = null) {

                // Append controller action to class location.
                $controller_action = $model_name;
                $class_location = '\\Urbnio\\Model\\' . $controller_action;

                return new $class_location($dependency);
            }

        /**
         *  Render layout and view files.
         *
         *  @param $layout the layout to render.
         *  @param $view the view to render.
         *  @param $data_array data to be passed to view() and layout().
         *
         *  @author nathancharrois@gmail.com
         */
            public function render($layout, $view, $data = array()) {

                // Returns view HTML.
                $prepare_view = $this->view($view, $data);

                // Store view HTML inside along with rest of $data.
                $data['view_content'] = $prepare_view;

                // Returns layout HTML.
                $prepare_layout = $this->layout($layout, $view, $data);

                echo $prepare_layout;
            }

        /**
         *  Prepare view files.
         *
         *  @param $view the view to render.
         *  @param $data_array data to be passed to the view.
         *
         *  @author nathancharrois@gmail.com
         */
            public function view($view, $data = array()) {

                extract($data);

                // Start buffer.
                ob_start();

                // Build full path to view file.
                $path = VIEW_PATH . $view . VIEW_FILE_EXT;

                include $path;

                // Render view file.
                $html = ob_get_clean();

                return $html;
            }

        /**
         *  Render Layout.
         *
         *  @param $layout  the layout to render.
         *  @param $data    array data to be passed to the layout.
         *  @param $view
         *
         *  @author nathancharrois@gmail.com
         */
            public function layout($layout, $view, $data = array()) {

                $set_layout = new Layout();

                $data['layout'] = $set_layout->$layout($view);
                $data['layout_path'] = $set_layout->get_path();

                extract($data);

                // Start buffer.
                ob_start();

                // Build full path to layout file.
                $path = LAYOUT_PATH . $data['layout_path'] . LAYOUT_FILE_EXT;

                include $path;

                // Render layout file.
                $html = ob_get_clean();

                return $html;
            }

            /**
             *  Render Element.
             *
             *  @param  string   $name  the name of the element file.
             *  @param  array    $data  element options and/or data.
             *
             *  @author nathancharrois@gmail.com
             */
                public function element($name, $data = array()) {

                    extract($data);

                    // Start buffer.
                    ob_start();

                    // Build full path to element.
                    $path = ELEMENT_PATH . $name . ELEMENT_FILE_EXT;

                    include $path;

                    // Render the element file.
                    $html = ob_get_clean();

                    return $html;
                }

    }

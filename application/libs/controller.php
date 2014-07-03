<?php

/**
 *  This is the "base controller class". All other controllers extend this class.
 */
    class Controller
    {

        /**
         *  Load the model with the given name.
         *
         *  @param   string $model_name      The name of the model
         *  @param   string $param           Pass the model information.
         *  @return  object model
         */
            public function loadModel($model_name, $param = null) {

                // Require model file.
                require_once 'application/models/' . strtolower($model_name) . '.php';

                return new $model_name($param);
            }

        /**
         *  Render layout and view files.
         *
         *  @param $layout       the layout to render.
         *  @param $view         the view to render.
         *  @param $data_array   data to be passed to view() and layout().
         */
            public function render($layout, $view, $data = array()) {

                // Returns view HTML.
                $prepare_view = $this->view($view, $data);

                // Store view HTML inside along with rest of $data.
                $data['view_content'] = $prepare_view;

                // Don't need it anymore.
                unset($prepare_view);

                // Returns layout HTML.
                $prepare_layout = $this->layout($layout, $data);

                echo $prepare_layout;
            }

        /**
         *  Prepare view files.
         *
         *  @param $view         the view to render.
         *  @param $data_array   data to be passed to the view.
         */
            public function view($view, $data = array()) {

                extract($data);

                // Start buffer.
                ob_start();

                // Build full path to view file.
                $path = PATH_VIEWS . $view . PATH_VIEW_FILE_TYPE;

                include $path;

                // Render view file.
                $html = ob_get_clean();

                return $html;
            }

        /**
         *  Render Layout.
         *
         *  @param $layout       the layout to render.
         *  @param $data_array   data to be passed to the layout.
         */
            public function layout($layout, $data = array()) {

                extract($data);

                // Start buffer.
                ob_start();

                // Build full path to layout file.
                $path = LAYOUT_VIEWS . $layout . LAYOUT_VIEW_FILE_TYPE;

                include $path;

                // Render layout file.
                $html = ob_get_clean();

                return $html;
            }
    }

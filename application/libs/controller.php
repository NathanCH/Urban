<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller
{

    /**
     *  Load the model with the given name.
     *  loadModel("SongModel") would include models/songmodel.php and create the object in the controller, like this:
     *  $songs_model = $this->loadModel('SongsModel');
     *  Note that the model class name is written in "CamelCase", the model's filename is the same in lowercase letters
     *
     *  @param   string $model_name      The name of the model
     *  @param   string $param           Pass the model information.
     *  @return  object model
     */
        public function loadModel($model_name, $param = null) {
            require_once 'application/models/' . strtolower($model_name) . '.php';
            return new $model_name($param);
        }

    /**
     *  Render view files.
     *
     *  @param $view         the page to render.
     *  @param $data_array   data to be passed to the view.
     */
        public function render($view, $data = array()) {

            extract($data);

            // Start buffer.
            ob_start();

            // Build full path to view file.
            $path = PATH_VIEWS . $view . PATH_VIEW_FILE_TYPE;

            include $path;

            // Render view file.
            $render_view = ob_get_clean();

            echo $render_view;
        }
}

<?php
namespace Urbnio\Helper;

use \Exception as Exception;

/**
 *  Upload Helper.
 */

    class Upload {

            private $_root,
                    $_directory,
                    $_errors = array(),
                    $_file,
                    $_tmp_name,
                    $_filename,
                    $_callback_object,
                    $_callback_method = array();

        /**
         *  File's data that gets returned.
         */
            public  $data = array();

        /**
         *  Return upload object.
         */
            public static function start($directory) {

                return new Upload($directory);
            }

        /**
         *  Set and create directory path.
         */
            public function __construct($directory) {

                // Set local route.
                $this->_root = ROOT;

                // Set server route.
                // $this->_root = URL;

                if(!$this->set_directory($directory)) {

                    throw new Exception('There was a problem setting the directory.');
                }
            }

        /**
         *  Set directory path.
         */
            public function set_directory($directory) {

                $this->_directory = $directory;

                // Check that the directory exist.
                return is_writable($this->_directory);
            }

        /**
         *  Set file for upload.
         *
         *  @todo  change $_file to array to allow for multiple file uploads.
         */
            public function set_file($file) {

                // Check that file is valid.
                if(!$this->is_valid_file($file)) {

                    $this->add_error('Select a valid file.');
                }

                // Set file.
                $this->_file = $file;

                // Set temp file name.
                $this->_tmp_name = $file['tmp_name'];
            }

        /**
         *  Ensure file is valid.
         */
            private function is_valid_file($file) {

                return !empty($file['name'])
                    && !empty($file['type'])
                    && !empty($file['tmp_name'])
                    && !empty($file['size']);
            }

        /**
         *  Save file.
         */
            public function upload() {

                if($this->check()){

                    return $this->save();
                }

                // Return state of upload.
                return $this->data;
            }

        /**
         *  Check file status.
         *
         *  Check that no errors have accumulated.
         *  And set status.
         */
            private function check() {

                // Set file data.
                $this->set_file_data();

                // Execute Callbacks.
                $this->callback($this->_callback_method, $this->_callback_object);

                // Get errors.
                $errors = $this->errors();

                $this->data['errors'] = $errors;
                $this->data['status'] = empty($errors);

                return $this->data['status'];
            }

        /**
         *  Callback to validation class.
         */
            private function callback($callbacks, $object) {

                // Loop through array of callbacks.
                foreach ($callbacks as $method => $rules) {

                    // And executre class action, passing
                    // this object as an argument.
                    // Also pass in rules for validation.
                    $object->$method($this, $rules);
                }
            }

        /**
         *  Save file to server.
         */
            public function save() {

                // Set filename.
                if(empty($this->_filename)) {

                    $this->set_file_name();
                }

                // Assign file name.
                $this->data['filename'] = $this->_filename;

                // Get full path.
                $this->data['full_path'] = $this->_root . $this->_directory . $this->_filename;

                // Move file to directory.
                $status = move_uploaded_file($this->_tmp_name, $this->data['full_path']);

                return $this->data;
            }

        /**
         *  Set file data.
         *
         *  Add additional data to post.
         */
            private function set_file_data() {

                $file_size = filesize($this->_tmp_name);

                $this->data = array(
                    'status'    => false, // Must pass validation.
                    'directory' => $this->_directory,
                    'original_filename' => $this->_file['name'],
                    'mime' => $this->_file['type'],
                    'file_size' => $file_size,
                    'file_size_kb' => $this->bytes_to_kb($file_size),
                    'post_data' => $this->_file
                );
            }

        /**
         *  Set filename.
         *
         *  Generated a unique filename.
         */
            private function set_file_name() {
                $filename = sha1(mt_rand(1, 9999) . $this->_directory . uniqid()) . time();

                $this->_filename = $filename;
            }

        /**
         *  Set callback.
         *
         *  @param object $object pass the object and its data.
         *  @param array  $method access object with a method name and any data to that methd.
         */
            public function set_callback($object, $method) {

                if(empty($object)) {

                    throw new Exception('Object can\'t be empty.');
                }

                if(!is_array($method)) {

                    throw new Exception('Method must be an array.');
                }

                $this->_callback_object = $object;
                $this->_callback_method = $method;
            }

            public function add_error($error) {
                $this->_errors[] = $error;
            }

            public function errors() {
                return $this->_errors;
            }

            public function get_file() {
                return $this->_file;
            }

            public function bytes_to_kb($bytes) {
                return round(($bytes / 1024), 2);
            }
    }

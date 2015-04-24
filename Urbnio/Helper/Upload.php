<?php
namespace Urbnio\Helper;
use \Exception as Exception;

class Upload {

    private $_root,
            $_directory,
            $_errors = array(),
            $_file,
            $_tmp_name,
            $_filename,
            $_callback_object,
            $_callback_method = array();

    public  $data = array();

    public static function start($directory) {
        return new Upload($directory);
    }

    public function __construct($directory) {

        $this->_root = ROOT;
        // $this->_root = URL;

        if(!$this->set_directory($directory)) {
            throw new Exception('There was a problem setting the directory.');
        }
    }

    public function set_directory($directory) {
        $this->_directory = $directory;

        return is_writable($this->_directory);
    }

    /**
     * @todo change $_file to array to allow for multiple file uploads.
     */
    public function set_file($file) {
        if(!$this->is_valid_file($file)) {
            $this->add_error('Select a valid file.');
        }

        $this->_file = $file;
        $this->_tmp_name = $file['tmp_name'];
    }

    private function is_valid_file($file) {
        return !empty($file['name'])
            && !empty($file['type'])
            && !empty($file['tmp_name'])
            && !empty($file['size']);
    }

    public function upload() {
        if($this->check()){
            return $this->save();
        }

        return $this->data;
    }

    /**
     * Check file status.
     */
    private function check() {
        $this->set_file_data();
        $this->callback($this->_callback_method, $this->_callback_object);

        $errors = $this->errors();
        $this->data['errors'] = $errors;
        $this->data['status'] = empty($errors);

        return $this->data['status'];
    }

    /**
     * Callback to allow uploaded file data to be validated.
     */
    private function callback($callbacks, $object) {
        foreach ($callbacks as $method => $rules) {
            $object->$method($this, $rules);
        }
    }

    public function save() {
        if(empty($this->_filename)) {
            $this->set_file_name();
        }

        $this->data['filename'] = $this->_filename;
        $this->data['full_path'] = $this->_root . $this->_directory . $this->_filename;

        // Move file to directory.
        $status = move_uploaded_file($this->_tmp_name, $this->data['full_path']);

        return $this->data;
    }

    /**
     * Set file data.
     * Add additional data to post.
     */
    private function set_file_data() {
        $file_size = filesize($this->_tmp_name);
        $this->data = array(
            'status'    => false, // Must be true to pass validation.
            'directory' => $this->_directory,
            'original_filename' => $this->_file['name'],
            'mime' => $this->_file['type'],
            'file_size' => $file_size,
            'file_size_kb' => $this->bytes_to_kb($file_size),
            'post_data' => $this->_file
        );
    }

    private function set_file_name() {
        $filename = sha1(mt_rand(1, 9999) . $this->_directory . uniqid()) . time();
        $this->_filename = $filename;
    }

    /**
     * @param object $object pass the object and its data.
     * @param array  $method access object with a method name and any data to that methd.
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
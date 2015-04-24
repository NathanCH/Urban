<?php
namespace Urbnio\Helper;
class Validate {

    private $_passed = false,
            $_errors = array(),
            $_db = null;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    /**
     * @param $data    array   $_POST or $_GET to validate.
     * @param $items   array   The form element(s).
     * @param $rules   array   All the rules associated with an element.
     * @param $value   $_POST  the user's form input.
     * @todo  create regex for email and phone numbers.
     */
    public function check($data, $items = array()) {

        // Seperate each item and its rules.
        foreach ($items as $item => $rules) {

            // Seperate each rule and its answers.
            foreach($rules as $rule => $answer){

                $value = trim($data[$item]);

                if($rule === 'required' && $answer && empty($value)) {
                    $this->_addError($item, $rule, $answer);
                }

                // If the field isn't empty, complete validation.
                else if(!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if(strlen($value) < $answer) {
                                $this->_addError($item, $rule, $answer);
                            }
                        break;
                        case 'max':
                            if(strlen($value) > $answer) {
                                $this->_addError($item, $rule, $answer);
                            }
                        break;
                        // Check if field matches another.
                        case 'matches':
                            if($value != $data[$answer]) {
                                $this->_addError($item, $rule, $answer);
                            }
                        break;
                        // Check if user value is unique.
                        case 'unique':
                            $check = $this->_db->query("SELECT * FROM users WHERE {$item} = '{$value}'");
                            if($check->count()) {
                                $this->_addError($item, $rule, $answer);
                            }
                        break;
                        // Check if user's current password matches input.
                        case 'check_password':
                            if(!Hash::is_correct_password($value, $answer)) {
                                $this->_addError($item, $rule, $answer);
                            }
                        break;
                        // Number is greater than zero and not a decimal.
                        case 'positive_integer':
                            if(!preg_match('/^\d+$/', $value)) {
                                $this->_addError($item, $rule, $answer);
                            }
                        break;
                    }
                }
            }
        }

        $this->_passed = empty($this->_errors);
        return $this;
    }

    /**
     * Check file against validation rules.
     * @param $object  array   File upload object gives access to data.
     * @param $items   array   The form element(s).
     */
    public function check_file($object, $items = array()) {

        // Seperate each item and its rules.
        foreach ($items as $item => $rules) {

            // Get rule and answer.
            foreach ($rules as $rule => $answer) {

                $file_data = $object->data;

                // Check that the file has been uploaded.
                // Error type 4: No file was uploaded.
                if($rule === 'required' && $answer && $file_data['post_data']['error'] == 4){
                    $this->_addError('file', $rule, $answer);

                }

                else if(!empty($file_data)) {
                    switch ($rule) {
                        case 'max_file_size':
                            if($file_data['file_size_kb'] > $answer) {
                                $this->_addError('file', $rule, $answer);
                            }
                        break;
                        case 'file_type';
                            if($file_data['mime'] !== '' && !$this->check_file_type($file_data['mime'], $answer)){
                                $this->_addError('file', $rule, $answer);
                            }
                        break;
                    }
                }
            }
        }

        $this->_passed = empty($this->_errors);
        return $this;
    }

    /**
     * Check file type.
     * @param $file_type  string  The file's mime type.
     * @param $category   string  Category of file types to check against.
     */
    private function check_file_type($file_type, $category) {
        switch ($category) {
            case 'image':
                $allowed_files = array(
                    'image/jpeg',
                    'image/png',
                    'image/gif'
                );
            break;
        }

        return in_array($file_type, $allowed_files);
    }

    /**
     * Method to add errors to an associative array.
     * @param $field         the field/input name.
     * @param $error_type   the type of error (ie. required).
     */
    private function _addError($field, $error_type, $value) {
        return $this->_errors[$field] = i18n::validation_lang($error_type, $field, $value);
    }

    public function passed() {
        return $this->_passed;
    }

    public function errors() {
        return $this->_errors;
    }
}
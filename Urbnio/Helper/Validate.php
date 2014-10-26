<?php
namespace Urbnio\Helper;

/**
 *  Validate Helper
 */

    class Validate {

        /**
         *  Reset private variables when class is initiated.
         */
            private $_passed = false,
                    $_errors = array(),
                    $_db = null;

        /**
         *  Create instance of database.
         */
            public function __construct() {
                $this->_db = DB::getInstance();
            }


        /**
         *  Method to check input against validation rules.
         *
         *  @param $data    array   $_POST or $_GET to validate.
         *  @param $items   array   The form element.
         *  @param $rules   array   All the rules associated with an element.
         *  @param $value   $_POST  the user's form input.
         *
         *  @todo  create regex for email and phone numbers.
         */
            public function check($data, $items = array()) {

                // Seperate each item and its rules.
                foreach ($items as $item => $rules) {

                    // Seperate each rule and its answers.
                    foreach($rules as $rule => $answer){

                        // Get $_POST text and trim white space.
                        $value = trim($data[$item]);

                        // Check that required fields are not empty.
                        if($rule === 'required' && $answer && empty($value)) {
                            $this->_addError($item, $rule, $answer);
                        }

                        // If the field isn't empty, complete validation.
                        else if(!empty($value)) {
                            switch ($rule) {
                                // Minimum string length.
                                case 'min':
                                    if(strlen($value) < $answer) {
                                        $this->_addError($item, $rule, $answer);
                                    }
                                break;
                                // Maximum string length.
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
                            }
                        }

                    }
                }

                // If there are no errors...
                if(empty($this->_errors)) {
                    $this->_passed = true;
                }

                return $this;
            }

        /**
         *  Check file against validation rules.
         */
            public function check_file($object, $rules = array()) {

                // Get rule and answer.
                foreach ($rules as $rule => $answer) {

                    $file_data = $object->data;

                    // Check that the file has been uploaded.
                    if($rule === 'required' && $answer && empty($file_data)){
                        $object->add_error('Field is required.');
                    }

                    else if(!empty($file_data)) {
                        switch ($rule) {

                            // Check max file size.
                            case 'max_file_size':
                                if($file_data['file_size'] > $answer) {
                                    $object->add_error(i18n::validation_lang($rule, 'file', $answer));
                                }
                            break;

                            // Check file type.
                            case 'file_type';

                                // Allowed files.
                                if($answer = 'images') {
                                    $allowed_files = array(
                                        'image/jpeg',
                                        'image/png'
                                    );
                                }

                                if(!in_array($file_data['mime'], $allowed_files)){
                                    $object->add_error(i18n::validation_lang($rule, 'file', $answer));
                                }
                            break;
                        }
                    }
                }
            }

        /**
         *  Method to hold any validation errors.
         */
            public function errors() {
                return $this->_errors;
            }

        /**
         * Method to add errors to an associative array.
         *
         * @param $field         the field/input name.
         * @param $error_type   the type of error (ie. required).
         */
            private function _addError($field, $error_type, $value) {
                return $this->_errors[$field] = i18n::validation_lang($error_type, $field, $value);
            }

        /**
         *  Method to check if validation passed.
         */
            public function passed() {
                return $this->_passed;
            }

    }
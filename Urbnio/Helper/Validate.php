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
         *  @param $items   array   Each item and its rules.
         *  @param $rules   array   All the rules associated with an item.
         *  @param $value   $_POST  user form input
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
                            $this->_addError($item, $rule);
                        }

                        // If the field isn't empty, complete validation.
                        else if(!empty($value)) {
                            switch ($rule) {
                                case 'min':
                                    if(strlen($value) < $answer) {
                                        // Add the field and the error to error array.
                                        $this->_addError($item, $rule);
                                    }
                                break;
                                case 'max':
                                    if(strlen($value) > $answer) {
                                        $this->_addError($item, $rule);
                                    }
                                break;
                                case 'matches':
                                    if($value != $data[$answer]) {
                                        $this->_addError($item, $rule);
                                    }
                                break;
                                case 'unique':
                                    $check = $this->_db->query("SELECT * FROM users WHERE {$item} = '{$value}'");
                                    if($check->count()) {
                                        $this->_addError($item, $rule);
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
         *  Method to hold any validation errors.
         *
         *  @todo create method that adds errors to _errors.
         */
            public function errors() {
                return $this->_errors;
            }

        /**
         * Method to add errors to an associative array.
         *
         * @param $item         the field/input name.
         * @param $error_type   the type of error (ie. required).
         */
            private function _addError($item, $error_type) {
                return $this->_errors[$item] = $error_type;
            }

        /**
         *  Method to check if validation passed.
         */
            public function passed() {
                return $this->_passed;
            }

    }
<?php

/**
 *  Validate Class
 *
 *  @author nathancharrois@gmail.com
 */

    class Validate {

        /**
         *  Reset private variables when class is initiated.
         *
         *  @todo create null $_db and __construct a database connection.
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
         *  @param $items   array   The each item and its rules.
         *  @todo  create min and max character rule check.
         *  @todo  create email matching rule check.
         *  @todo  create if email is unique in DB.
         */
            public function check($data, $items = array()) {

                // Seperate each item and its rules.
                foreach ($items as $item => $rules) {
                    // Seperate each rule and its answers.
                    foreach($rules as $rule => $answer){

                        // Get $_POST text and trim white space.
                        $value = trim($data[$item]);

                        // Sanatize $_POST data.
                        $value = Input::escape($value);

                        // Check that required fields are not empty.
                        if($rule === 'required' && $answer && empty($value)) {
                            $output = "{$item} is required!";
                            $this->_addError($item, $output);
                        }

                        // If the field isn't empty, complete validation.
                        else if(!empty($value)) {
                            switch ($rule) {
                                case 'min':
                                    if(strlen($value) < $answer) {
                                        $output = "{$item} must be a minimum of {$answer} characters.";
                                        $this->_addError($item, $output);
                                    }
                                break;
                                case 'max':
                                    if(strlen($value) > $answer) {
                                        $output = "{$item} must be a maximum of {$answer} characters.";
                                        $this->_addError($item, $output);
                                    }
                                break;
                                case 'matches':
                                    if($value != $data[$answer]) {
                                        $output = "passwords do not match.";
                                        $this->_addError($item, $output);
                                    }
                                break;
                                case 'unique':
                                    $check = $this->_db->query("SELECT * FROM users WHERE email = '{$value}'");
                                    if($check->count()) {
                                        $output = "{$item} already exists.";
                                        $this->_addError($item, $output);
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
         * @param $item    the field/input name.
         * @param $output  message to show user.
         */
            private function _addError($item, $output) {
                return $this->_errors[$item] = $output;
            }

        /**
         *  Method to check if validation passed.
         */
            public function passed() {
                return $this->_passed;
            }

    }
<?php

/**
 * Validate Class
 */

    class Validate {

        /**
         *  Reset private variables when class is initiated.
         *  @todo create null $_db and __construct a database connection.
         */
            private $_passed = false,
                    $_errors = array();


        /**
         *  Method to check input against validation rules.
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
                        // echo "{$item} is {$rule} must be {$answer} <br />";

                        // Get $_POST text and trim white space.
                        $value = trim($data[$item]);

                        // Sanatize $_POST data.
                        $value = Input::escape($value);

                        // Check that required fields are not empty.
                        if($rule === 'required' && $answer && empty($value)) {
                           $this->_errors[] = "{$item} is required.";
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
         *  @todo create method that adds errors to _errors.
         */
            public function errors() {
                return $this->_errors;
            }

        /**
         *  Method to check if validation passed.
         */
            public function passed() {
                return $this->_passed;
            }

    }
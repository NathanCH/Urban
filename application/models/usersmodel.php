<?php

/**
 *  Users Model
 */
    class UsersModel{

        /**
         *  @var private $_db   instance of database.
         */
            private $_db = null;

        /**
         *  Create instance of database.
         */
            function __construct($params) {
                $this->_db = DB::getInstance();
            }

        /**
         *  Add user to database.
         *
         *  @param array  $fields   the fields to add.
         */
            public function register_user($fields = array()) {
                // Insert user into database, else throw an error.
                if(!$this->_db->insert('users', $fields)) {
                    throw new Exception('There was a problem creating this account.');
                }
            }
    }
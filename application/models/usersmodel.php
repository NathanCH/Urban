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
            function __construct() {
                $this->_db = DB::getInstance();
            }

        /**
         *  Add user to database.
         *
         *  @param $email       $_POST
         *  @param $password    $_POST
         *
         *  @todo create proper santatize function.
         */
            public function add_user($email, $password) {
                $email     = Input::sanitize($email);
                $password  = Input::sanitize($password);
            }
    }
<?php

/**
 *  Users Model
 */
    class UsersModel{

        /**
         *  @var private $_db   instance of database.
         */
            private $_db = null,
                    $_data;

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

        /**
         *  Find a user.
         *
         *  @param  string/int   find by email or id.
         *
         *  @todo  replace query() method with get() method.
         *  @todo  since find() searches by ID or email, users can login with their user ID.
         *         create new validation rule to ensure email field is a proper email.
         */
            public function find($user = null){
                if($user) {
                    // If $user if an integer, search by id.
                    $field = (is_numeric($user)) ? 'id' : 'email';

                    // Search in the database.
                    $data = $this->_db->query("SELECT * FROM users WHERE $field = ?", array($user));

                    // If the user does exist...
                    if($data->count()) {
                        // Set the user's data.
                        $this->_data = $data->first();

                        return true;
                    }

                    return false;
                }
            }


        /**
         *  Login User.
         *
         *  @param string  $username
         *  @param string  $password
         *
         *  @todo  abstract the session name 'user' into a global config file.
         */
            public function login($username = null, $password = null) {
                // Check that fields are passed.
                $user = $this->find($username);

                // If we found a user.
                if($user) {
                    // Create new hash and check if it matches their password.
                    if($this->data()->password === Hash::make($password, $this->data()->salt)) {
                        // Create a session with this user's id.
                        Session::put('user', $this->data()->id);

                        return true;
                    }
                }

                return false;
            }

        /**
         *  Get the user's data.
         */
            private function data() {
                return $this->_data;
            }
    }
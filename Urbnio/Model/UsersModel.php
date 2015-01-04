<?php
namespace Urbnio\Model;
use Urbnio\Helper\DB;
use Urbnio\Helper\Session;
use Urbnio\Helper\Hash;
use Urbnio\Helper\Cookie;
use Urbnio\Helper\Validate;
use \Exception as Exception;

class UsersModel{

    private $_db = null,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn = false;

/**
 *  Create instance of database and check if the logged in user exists.
 *
 *  @param string   $user   retreive a specific user's data.
 *  @todo  create logic to delete expired sessions.
 */
    function __construct($user = null) {
        $this->_db = DB::getInstance();
        $this->_sessionName = SESSION_NAME;
        $this->_cookieName = COOKIE_NAME;

        if(!$user) {

            if(Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);

                // Check if the user exists.
                if($this->find($user)) {
                    $this->_isLoggedIn = true;
                }

                else{
                    $this->_isLoggedIn = false;
                    $this->logout();
                }
            }
        }

        // If the user has been defined.
        else{
            $this->find($user);
        }
    }

/**
 *  Register user to database.
 *  @param array  $fields   the fields to add.
 */
    public function register_user($fields = array()) {
        if(!$this->_db->insert('users', $fields)) {
            throw new Exception('There was a problem creating this user.');
        }
    }

/**
 *  Update user data.
 *
 *  @param array   $fields  the fields to updated.
 *  @param int     $id      to specify a user.
 */
    public function update_user($fields = array(), $id = null) {

        // If no user id is specified, get this user's id.
        if(!$id && $this->is_logged_in()) {
            $id = $this->data()->id;
        }

        // Update user in the database, else throw an error.
        if(!$this->_db->update('users', $id, $fields)) {
            throw new Exception('There was a problem updating this user.');
        }
    }

/**
 *  Upload user file.
 *
 *  @param array   $file   file data to be saved.
 *  @param int     $id     to specify a user.
 */
    public function upload_user_file($file) {

        // Add user file.
        if(!$this->_db->insert('users_file', $file)) {
            throw new Exception('There was a problem adding this file.');
        }
    }

/**
 *  Get file data.
 *
 *  @todo  move this to database helper.
 */
    public function get($table, $data = null) {
        if($data) {

            $field = 'user_id';
            $data = $this->_db->query("SELECT * FROM $table WHERE $field = ?", array($data));

            if($data->count()) {

                // Get latest profile photo.
                $this->_data = $data->last();
                return $this->data();
            }

            return false;
        }
    }


/**
 *  Change user password.
 *
 *  @param string   $password   password to update.
 *  @param int      $id         to specify a user.
 */
    public function change_password($password, $id = null) {

        // If no user id is specified, get this user's id.
        if(!$id && $this->is_logged_in()) {
            $id = $this->data()->id;
        }

        // Update user password.
        if(!$this->_db->update('users', $id, $password)) {
            throw new Exception('There was a problem updateing the password.');
        }
    }

/**
 *  Find a user.
 *
 *  @param  string/int   find by email or id.
 *
 *  @todo  since find() searches by ID or email, users can login with their user ID.
 *         create new validation rule to ensure email field is a proper email.
 *         howover, keep this functionality because it's user to search via user ID.
 */
    public function find($user = null){
        if($user) {

            // If $user if an integer, search by id.
            $field = (is_numeric($user)) ? 'id' : 'email';

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
 *  @todo  abstract the session name 'user' into a global config file.
 */
    public function login($username = null, $password = null, $remember = false) {

        // When username or password haven't been defined, but the current user exists.
        if(!$username && !$password && $this->exists()) {

            // Create a session for a user that has a valid cookie.
            Session::put($this->_sessionName, $this->data()->id);
        }

        else{

            // Check that fields are passed.
            $user = $this->find($username);

            if($user) {

                // Create new hash and check if it matches their password.
                if(Hash::is_correct_password($password, $this->data()->password)) {

                    // Create a session with this user's id.
                    Session::put($this->_sessionName, $this->data()->id);

                    // Also create cookies to remember user.
                    if($remember){

                        // Generate a hash and check that it doesn't exist.
                        $hash = Hash::make_session_hash();
                        $hashCheck = $this->_db->query("SELECT * FROM users_session WHERE user_id = ?", array($this->data()->id));

                        // If the hash doesn't exist.
                        if(!$hashCheck->count()) {

                            // Insert one into DB.
                            $this->_db->insert('users_session', array(
                                'user_id' => $this->data()->id,
                                'hash' => $hash
                            ));
                        }

                        else {
                            $hash = $hashCheck->first()->hash;
                        }

                        // Create the cookie.
                        Cookie::create($this->_cookieName, $hash, COOKIE_EXPIRY);
                    }

                    return true;
                }
            }
        }

        return false;
    }

/**
 *  Logout user.
 */
    public function logout(){
        if($this->_isLoggedIn){
            $this->_db->query("DELETE FROM users_session WHERE user_id = ?", array($this->data()->id));
            Session::delete($this->_sessionName);
            Cookie::delete($this->_cookieName);
        }
    }

/**
 *  Check if the current user is logged in.
 */
    public function is_logged_in() {
        return $this->_isLoggedIn;
    }

/**
 *  Check if user has the correct permission levels.
 *
 *  @param  $level  permission level.
 */
    public function has_permission($level) {

        // Get the user's current group.
        $group = $this->_db->query("SELECT * FROM groups WHERE id = ?", array($this->data()->group));

        if($group->count()) {

            // Extract the permissions.
            $permissions = $group->first()->permissions;

            // Decode permissions JSON object into array.
            $permissions = json_decode($permissions, true);

            // Match permission level.
            return !empty($permissions[$level]);
        }

        return false;
    }

    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function data() {
        return $this->_data;
    }
}
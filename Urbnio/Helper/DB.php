<?php
namespace Urbnio\Helper;
use \PDOException as PDOException;

class DB {
    /**
     * Get instance of the database when initiated so we don't
     * have to keep reconnecting.
     */
    private static $_instance = null;

    private $_pdo,
            $_query,
            $_errors = false,
            $_results,
            $_count = 0;


    public function __construct() {
        try{
            $this->_pdo = new \PDO('mysql:host='.DB_HOST.';dbname='. DB_NAME, DB_USER, DB_PASS);
        }

        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        // Singleton
        if(!isset(self::$_instance)) {
            self::$_instance = new DB();
        }

        return self::$_instance;
    }

    /**
     * @param string   $sql        the query to be executed.
     * @param array    $params     ...
     */
    public function query($sql, array $params = array()) {

        // Reset erros when query is run.
        $this->_error = false;

        // Prepare $_query.
        if($this->_query = $this->_pdo->prepare($sql)) {
            // Keep track of where we are.
            $i = 1;

            //Check if there are parameters.
            if(count($params)) {
                // Cycle through them.
                foreach ($params as $param) {
                    // Bind value to paremeter.
                    $this->_query->bindValue($i, $param);
                    $i++;
                }
            }

            // Execute $_query and store results.
            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(\PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }

            else{
                $this->_error = true;
            }
        }

        return $this;
    }

    /**
     * @param string   $table      the table we want to insert data into.
     * @param array    $fields     the fields to update.
     *
     * $user = DB::getInstance()->insert('users', array(
     *     'username' => 'Nathan',
     *     'password' => 'password'
     * ));
     */
    public function insert($table, $fields = array()) {
        // If there is data in $fields.
        if(count($fields)) {
            // Get just the keys of the array.
            $keys = array_keys($fields);
            // Keep track of the contents to be inserted.
            $values = null;
            $x = 1;

            // Prepare the values.
            // e.g. VALUES (?, ?, ?);
            foreach ($fields as $field) {
                // Seperate with questionmarks which will later be binded via PDO.
                $values .= '?';

                // If not the last value...
                if($x < count($fields)) {
                    // Add comma.
                    $values .= ', ';
                }

                $x++;
            }

            // Seperate the keys of the array and seperate them with `, `
            // $sql = "INSERT INTO users (`email`, `password`) VALUES ...";
            $sql = "INSERT INTO $table (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

            // If there aren't any errors with the query.
            if(!$this->query($sql, $fields)->error()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string   $table      the table we want to update data in.
     * @param integer  $id         the id to update.
     * @param array    $fields     the fields to update.
     *
     * $user = DB::getInstance()->update('users', 6, array(
     *     'name' => 'Richard'
     * ));
     */
    public function update($table, $id, $fields = array()) {

        $set = '';
        $x = 1;

        // Build contents for mysql set values.
        foreach ($fields as $name => $value) {
            $set .= "{$name} =?";
            // If its the last one..
            if($x < count($fields)) {
                $set .= ', ';
            }
            $x ++;
        }

        // Build query.
        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        // Run the query.
        if(!$this->query($sql, $fields)->error()){
            return true;
        }

        return false;
    }

    public function results() {
        return $this->_results;
    }

    public function first() {
        return $this->results()[0];
    }

    public function last() {
        $results = $this->results();
        return end($results);
    }

    public function count() {
        return $this->_count;
    }

    public function error() {
        return $this->_error;
    }
}
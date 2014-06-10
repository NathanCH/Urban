<?php

/**
 *  Database Class.
 *
 *  @author nathancharrois@gmail.com
 */

    class DB {

        /**
         *  Get instance of the database when initiated so we don't
         *  have to keep reconnecting.
         */
            private static $_instance = null;


        /**
         *  Reset private variables when database is initiated.
         */
            private $_pdo,
                    $_query,
                    $_errors = false,
                    $_results,
                    $_count = 0;

        /**
         *  Connect to database via PDO.
         */
            public function __construct() {
                // Assign database connection to _pdo.
                try{
                    $this->_pdo = new PDO('mysql:host='.DB_HOST.';dbname='. DB_NAME, DB_USER, DB_PASS);
                }

                // Show error.
                catch(PDOException $e) {
                    die($e->getMessage());
                }
            }

        /**
         *  Get instance of database.
         */
            public static function getInstance() {
                // Connect to the Database if we haven't already.
                if(!isset(self::$_instance)) {
                    self::$_instance = new DB();
                }

                // Return instance of DB so we can access functionality.
                return self::$_instance;
            }

        /**
         *  Query Database
         *
         *  @param string   $sql        the query to be executed.
         *  @param array    $params     ...
         */
            public function query($sql, $params = array()) {
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
                    if($this->_query->execute()){
                        $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                        $this->_count = $this->_query->rowCount();
                    }

                    // If execution fails, set $_error to true.
                    else{
                        $this->_error = true;
                    }
                }

                return $this;
            }

        /**
         *  Access query results.
         */
            public function results(){
                return $this->_results;
            }

        /**
         *  Access row count.
         */
            public function count(){
                return $this->_count;
            }

    }
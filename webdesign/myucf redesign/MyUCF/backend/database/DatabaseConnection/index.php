<?php
    include_once __DIR__."/../config.php";

    class DatabaseConnection {
        public $connection;
        
        private $established;
        private $host;
        private $username;
        private $password;
        private $database;

        function __construct() {
            global $__host, $__username, $__password, $__database;

            $this -> connection = null;
            $this -> established = false;

            $this -> host = $__host;
            $this -> username = $__username;
            $this -> password = $__password;
            $this -> database = $__database;
        }

        function connect() {
            if ($this -> established) return;

            mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR);

            try {
                $this -> connection = mysqli_connect($this -> host, $this -> username, $this -> password, $this -> database);
                $this -> established = true;
            } catch (mysqli_sql_exception $err) {
                $this -> established = false;
            }
        }

        function disconnect() {
            if (!$this -> established) return;
            
            $this -> connection -> close();
            $this -> established = false;
        }

        function isEstablished() {
            return $this -> established;
        }
    }

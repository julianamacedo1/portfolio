<?php 
    class PageState{
        public const STATUS_NO_CONNECTION = "no-connection";
        public const STATUS_GENERIC = "error";
        public const STATUS_INVALID = "invalid";
        public const STATUS_BLANK_VALUE = "blank";
        public const STATUS_DEFAULT = "default";

        private $pageName;
        private $state;
        private $data;
        private $status;

        function __construct($pageName, $params = []) {
            $this -> pageName = $pageName;
            $this -> state = isset($params["state"]) ? $params["state"] : [];
            $this -> data = isset($params["data"]) ? $params["data"] : [];
            $this -> status = isset($params["status"]) ? $params["status"] : "none";
        }

        function getPageName() {
            return $this -> pageName;
        }

        function getStateValue($key) {
            return isset($this -> state[$key]) ? $this -> state[$key] : null;
        }

        function setStateValue($key, $value) {
            $this -> state[$key] = $value;
        }

        function getDataValue($key) {
            return isset($this -> data[$key]) ? $this -> data[$key] : null;
        }

        function setDataValue($key, $value) {
            $this -> data[$key] = $value;
        }

        function setStatus($value) {
            $this -> status = $value;
        }

        function getStatus() {
            return $this -> status;
        }

        function createFromJSON($json) {
            $this -> pageName = $json["pageName"];
            $this -> state = $json["state"];
            $this -> data = $json["data"];
            $this -> status = $json["status"];
        }

        function getJSONEncode() {
            return json_encode([
                "pageName" => $this -> pageName,
                "state" => $this -> state,
                "data" => $this -> data,
                "status" => $this -> status,
            ]);
        }

        // -------------------------------

        static function create($pageName, $params = []) {
            if (session_status() != PHP_SESSION_ACTIVE) session_start();

            $state = new PageState($pageName, $params);
            $activeState = isset($_SESSION["_activePageState"]) ? json_decode($_SESSION["_activePageState"], true) : null;

            if ($activeState) {
                if ($activeState["pageName"] != $pageName) 
                    unset($_SESSION["_activePageState"]);
                else {
                    $state -> createFromJSON($activeState);
                    unset($_SESSION["_activePageState"]);
                }
            }

            return $state;
        }

        static function send($url, $state = null) {
            if (session_status() != PHP_SESSION_ACTIVE) session_start();

            if ($state) $_SESSION["_activePageState"] = $state -> getJSONEncode();
            header("Location: " . $url);
        }

        static function dump($state) {
            header("Content-type: application/json");

            if (!$state) {
                echo null;
                return;
            }
                
            echo $state -> getJSONEncode();
        }

        static function reset() {
            if (session_status() != PHP_SESSION_ACTIVE) session_start();

            unset($_SESSION["_activePageState"]);
        }

        static function exists($pageName) {
            if (session_status() != PHP_SESSION_ACTIVE) session_start();

            return isset($_SESSION["_activePageState"]) && $_SESSION["_activePageState"]["pageName"] == $pageName;
        }
    }
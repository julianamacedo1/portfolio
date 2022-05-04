<?php
    include_once __DIR__."/../TableInterface/index.php";

    class SessionsTable extends TableInterface {
        protected static $tableId = "sessions";

        static function addSession($connection, $token, $ucfid) {
            if (self::sessionIsActiveByUCFId($connection, $ucfid)) {
                self::endSessionByUCFId($connection, $ucfid);
            }

            $data = [
                "token" => $token,
                "ucfid" => $ucfid,
            ];

            return self::insertRow($connection, $data);
        }

        static function getSessionUCFId($connection, $token) {
            $data = self::getRowByColumn($connection, "token", $token);
            if (!$data) return null;

            return $data["ucfid"];
        }

        static function sessionIsActive($connection, $token) {
            return self::columnValueExists($connection, "token", $token);
        }

        static function sessionIsActiveByUCFId($connection, $ucfid) {
            return self::columnValueExists($connection, "ucfid", $ucfid);
        }

        static function endSession($connection, $token) {
            if (!self::sessionIsActive($connection, $token)) return false;

            return self::removeRow($connection, "token", $token);
        }

        static function endSessionByUCFId($connection, $ucfid) {
            if (!self::sessionIsActiveByUCFId($connection, $ucfid)) return false;

            return self::removeRow($connection, "ucfid", $ucfid);
        }
    }
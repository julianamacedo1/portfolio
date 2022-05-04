<?php
    include_once __DIR__."/../TableInterface/index.php";

    class StudentInfoTable extends TableInterface {
        protected static $tableId = "student_info";

        static function getPersonalInformation($connection, $ucfid) {
            $data = self::getRowByColumn($connection, "ucfid", $ucfid);
            if (!$data) return null;

            return $data;
        }

        static function getUCFIdByLoginCredentials($connection, $nid, $password) {
            $studentInfo = self::getRowByColumn($connection, "nid", $nid);

            if (!$studentInfo || !password_verify($password, $studentInfo["password"]))
                return null;

            return $studentInfo["ucfid"];
        }
    }
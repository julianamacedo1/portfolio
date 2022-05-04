<?php
    include_once __DIR__."/../TableInterface/index.php";

    class StudentFinancesTable extends TableInterface {
        protected static $tableId = "student_finances";

        static function getFinancesInformation($connection, $ucfid) {
            $data = self::getRowByColumn($connection, "ucfid", $ucfid);
            if (!$data) return null;

            $data["current_charges"] = json_decode($data["current_charges"], true);
            $data["past_charges"] = json_decode($data["past_charges"], true);

            return $data;
        }
    }
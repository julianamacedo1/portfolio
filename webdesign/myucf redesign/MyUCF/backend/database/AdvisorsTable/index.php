<?php
    include_once __DIR__."/../TableInterface/index.php";

    class AdvisorsTable extends TableInterface {
        protected static $tableId = "advisors";

        static function getAdvisorInformation($connection, $id) {
            $data = self::getRowByColumn($connection, "id", $id);
            if (!$data) return null;

            return $data;
        }
    }
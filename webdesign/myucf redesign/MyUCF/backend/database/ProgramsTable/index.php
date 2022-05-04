<?php
    include_once __DIR__."/../TableInterface/index.php";

    class ProgramsTable extends TableInterface {
        protected static $tableId = "programs";

        static function getProgramInformation($connection, $id) {
            $data = self::getRowByColumn($connection, "id", $id);
            if (!$data) return null;

            return $data;
        }
    }
<?php
    include_once __DIR__."/../TableInterface/index.php";

    class CoursesTable extends TableInterface {
        protected static $tableId = "courses";

        static function getCourseInformation($connection, $courseCode, $courseSection) {
            $data = self::getRowByColumns($connection, [
                "code" => $courseCode,
                "section" => $courseSection,
            ]);
            if (!$data) return null;

            return $data;
        }
    }
<?php
    include_once __DIR__."/../TableInterface/index.php";
    include_once __DIR__."/../ProgramsTable/index.php";
    include_once __DIR__."/../CoursesTable/index.php";
    include_once __DIR__."/../AdvisorsTable/index.php";

    class StudentEnrollmentTable extends TableInterface {
        protected static $tableId = "student_enrollment";

        static function getEnrolledCourses($connection, $ucfid) {
            $data = self::getRowByColumn($connection, "ucfid", $ucfid);
            if (!$data) return null;

            $courses = json_decode($data["courses"], true);

            return self::getFormattedCourses($connection, $courses);
        }

        static function getEnrollmentInformation($connection, $ucfid) {
            $data = self::getRawEnrollmentInformation($connection, $ucfid);
            if (!$data) return null;

            $major = $data["major"];
            $minor = $data["minor"];
            $advisor = $data["advisor"];

            if ($major) $data["major"] = ProgramsTable::getProgramInformation($connection, $major);
            if ($minor) $data["minor"] = ProgramsTable::getProgramInformation($connection, $minor);
            if ($advisor) $data["advisor"] = AdvisorsTable::getAdvisorInformation($connection, $advisor);

            $courses = json_decode($data["courses"], true);
            $formattedCourses = self::getFormattedCourses($connection, $courses);

            $data["courses"] = $formattedCourses;

            return $data;
        }

        private static function getRawEnrollmentInformation($connection, $ucfid) {
            $data = self::getRowByColumn($connection, "ucfid", $ucfid);
            if (!$data) return null;

            return $data;
        }

        private static function getFormattedCourses($connection, $courses, $group = false) {
            $result = $group ? ["group" => []] : [];

            foreach ($courses as $course) {
                $formattedCourse = isset($course["group"]) ? self::getFormattedCourses($connection, $course["group"], true) : CoursesTable::getCourseInformation($connection, $course["code"], $course["section"]);

                if ($group)
                    array_push($result["group"], $formattedCourse);
                else    
                    array_push($result, $formattedCourse);
            }

            return $result;
        }
    }
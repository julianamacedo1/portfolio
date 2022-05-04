<?php
    include_once __DIR__."/../config.php";
    include_once __DIR__."/../PageDirectory/index.php";
    include_once __DIR__."/../database/DatabaseConnection/index.php";
    include_once __DIR__."/../database/StudentInfoTable/index.php";
    include_once __DIR__."/../database/StudentFinancesTable/index.php";
    include_once __DIR__."/../database/StudentEnrollmentTable/index.php";
    include_once __DIR__."/../database/CoursesTable/index.php";
    include_once __DIR__."/../database/SessionsTable/index.php";

    class Utility {
        static private $sessionDuration = "NOW+15DAYS";
        static private $defaultPreferences = [
            "appearance" => "default",
            "font" => "default",
        ];

        static function getSanitizedValues($keys, $input) {
            $output = [];

            foreach ($keys as $key) {
                $output[$key] = isset($input[$key]) && !empty($input[$key]) ? self::sanitize($input[$key]) : "";
            }

            return $output;
        }
    
        static function canonicalizePhoneNumber($data) {
            return preg_replace('/[^0-9]/', '', $data);
        }
    
        static function decanonicalizePhoneNumber($data) {
            $areacode = substr($data, 0, 3);
            $prefix = substr($data, 3, 3);
            $linenum = substr($data, 6, 4);
    
            return "(" . $areacode . ")" . " " . $prefix . "-" . $linenum;
        }

        static function decanonicalizeUCFCardId($data) {
            $result = [];

            for ($i = 0, $length = strlen($data); $i < $length; $i++) {
                array_push($result, $data[$i]);
                if (($i + 1) % 4 == 0 && ($i + 1) < $length) array_push($result, "-");
            }

            return implode($result);
        }
    
        static function redirectToLogin() {
            self::endLoginSession();
            header("Location: " . PageDirectory::getPathOfPage("login"));
        }
    
        static function redirectToHome() {
            header("Location: " . PageDirectory::getPathOfPage("home"));
        }
    
        static function isLoggedin() {
            $token = isset($_COOKIE["_usr_tkn"]) ? $_COOKIE["_usr_tkn"] : null;

            if (!$token) return false;

            $connection = new DatabaseConnection();
            $connection -> connect();

            if (!$connection -> isEstablished()) return false;

            $loggedin = SessionsTable::sessionIsActive($connection, $token);
            $connection -> disconnect();

            return $loggedin;
        }

        static function requestSessionUCFId() {
            $token = isset($_COOKIE["_usr_tkn"]) ? $_COOKIE["_usr_tkn"] : null;

            if (!$token) return null;

            $connection = new DatabaseConnection();
            $connection -> connect();

            $ucfid = null;

            if (!$connection -> isEstablished()) goto end;

            $ucfid = SessionsTable::getSessionUCFId($connection, $token);

            if (!$ucfid) goto end;

            end:
            $connection -> disconnect();
            return $ucfid;
        }

        static function getStudentEnrollmentInformation() {
            $ucfid = self::requestSessionUCFId();

            if (!$ucfid) return null;

            $connection = new DatabaseConnection();
            $connection -> connect();

            if (!$connection -> isEstablished()) return null;

            $data = StudentEnrollmentTable::getEnrollmentInformation($connection, $ucfid);

            $connection -> disconnect();

            return $data;
        }

        static function getStudentFinancesInformation() {
            $ucfid = self::requestSessionUCFId();

            if (!$ucfid) return null;

            $connection = new DatabaseConnection();
            $connection -> connect();

            if (!$connection -> isEstablished()) return null;

            $data = StudentFinancesTable::getFinancesInformation($connection, $ucfid);

            $connection -> disconnect();

            return $data;
        }

        static function getStudentPersonalInformation() {
            $ucfid = self::requestSessionUCFId();

            if (!$ucfid) return null;

            $connection = new DatabaseConnection();
            $connection -> connect();

            if (!$connection -> isEstablished()) return null;

            $data = StudentInfoTable::getPersonalInformation($connection, $ucfid);
            $connection -> disconnect();

            return $data;
        }

        static function endLoginSession() {
            $token = isset($_COOKIE["_usr_tkn"]) ? $_COOKIE["_usr_tkn"] : null;
            if (!$token) return false;

            $connection = new DatabaseConnection();
            $connection -> connect();

            if (!$connection -> isEstablished()) return false;

            SessionsTable::endSession($connection, $token);
            $connection -> disconnect();

            unset($_COOKIE["_usr_tkn"]); 
            setcookie("_usr_tkn", null, -1, "/"); 

            return true;
        }

        
        static function startLoginSession($connection, $ucfid) {
            $token = self::generateSecureToken();
            $duration = strtotime(static::$sessionDuration);
            $sessionStarted = SessionsTable::addSession($connection, $token, $ucfid);

            if (!$sessionStarted) return false;

            setcookie("_usr_tkn", $token, $duration, "/");

            return true;
        }

        static function getAppearance() {
            $rawPreferences = isset($_COOKIE["_usr_pref"]) ? $_COOKIE["_usr_pref"] : [];
            $appearance = !empty($rawPreferences) ? json_decode($rawPreferences, true)["appearance"] : self::$defaultPreferences["appearance"];

            return $appearance;
        }

        static function getPreferences() {
            $defaultPreferences = self::$defaultPreferences;

            $rawPreferences = isset($_COOKIE["_usr_pref"]) ? $_COOKIE["_usr_pref"] : null;
            $preferences = $rawPreferences ? json_decode($rawPreferences, true) : [];

            foreach ($defaultPreferences as $preferenceId => $preferenceValue) {
                if (!isset($preferences[$preferenceId])) $preferences[$preferenceId] = $preferenceValue;
            }

            return $preferences;
        }

        #-----------------------------------------------------

        private static function generateSecureToken() {
            return bin2hex(openssl_random_pseudo_bytes(16));
        }

        private static function sanitize($data, $connection = null) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            if ($connection) $data = mysqli_real_escape_string($connection, $data);
            
            return $data;
        }
    }
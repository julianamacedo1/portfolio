<?php
    abstract class TableInterface {
        protected static $tableId = null;
        
        protected static function tableExists($connection) {
            if (!$connection -> isEstablished()) return null;

            $sql = "SHOW TABLES LIKE '" . self::$tableId . "'";

            try {
                $result = mysqli_query($connection -> connection, $sql);
                return mysqli_num_rows($result) > 0;
            } catch (mysqli_sql_exception $err) {
                return null;
            }
        }

        protected static function insertRow($connection, $data) {
            if (!$connection -> isEstablished()) return null;

            $columnNames = array_keys($data);
            $values = "";
            $columns = "";

            for ($i = 0; $i < sizeof($data); $i++) {
                $values .= "'" . $data[$columnNames[$i]] . "'" . ($i < (sizeof($data) - 1) ? ", " : ""); 
            }

            for ($i = 0; $i < sizeof($columnNames); $i++) {
                $columns .= "`" . $columnNames[$i] . "`" . ($i < (sizeof($columnNames) - 1) ? ", " : ""); 
            }

            $values = "(" . $values . ")";
            $columns = "(" . $columns . ")";

            $sql = "INSERT INTO `" . static::$tableId . "` " . $columns . " VALUES " . $values;

            try {
                mysqli_query($connection -> connection, $sql);
                return true;
            } catch (mysqli_sql_exception $err) {
                return null;
            }
        }

        protected static function removeRow($connection, $key, $value) {
            if (!$connection -> isEstablished()) return false;

            $sql = "DELETE FROM `" . static::$tableId . "` WHERE `" . $key . "` = '" . $value . "'";
            
            try {
                mysqli_query($connection -> connection, $sql);
                return true;
            } catch (mysqli_sql_exception $err) {
                return null;
            }
        }

        protected static function getRowByColumn($connection, $column, $value) {
            if (!$connection -> isEstablished()) return false;
            if (!self::columnValueExists($connection, $column, $value)) return false;

            $sql = "SELECT * from`" . static::$tableId . "` WHERE `" . $column . "` = '" .$value . "'";
            
            try {
                $result = mysqli_query($connection -> connection, $sql);
                return mysqli_fetch_assoc($result);
            } catch (mysqli_sql_exception $err) {
                return null;
            }
        }

        protected static function getRowByColumns($connection, $query) {
            if (!$connection -> isEstablished()) return false;

            $i = 0;
            $length = sizeof($query);
            $sql = "SELECT * from`" . static::$tableId . "` WHERE ";
            foreach ($query as $column => $value) {
                $sql = $sql . "`" . $column . "` = '" .$value . "'";
                if ($i + 1 < $length) $sql = $sql . " AND ";

                $i++;
            }
            
            try {
                $result = mysqli_query($connection -> connection, $sql);
                return mysqli_fetch_assoc($result);
            } catch (mysqli_sql_exception $err) {
                return null;
            }
        }

        protected static function updateColumnsForRow($connection, $key, $value, $data) {
            if (!$connection -> isEstablished()) return null;

            $updateQuery = "";
            $i = 0;

            foreach ($data as $column => $columnValue) {
                $updateQuery .= "`" . $column . "`" . "='" . $columnValue . "'" . ($i < (sizeof($data) - 1) ? ", " : "");
                $i++;
            }

            $sql = "UPDATE `" . static::$tableId . "` SET " . $updateQuery . " WHERE `" . $key . "` = '" . $value . "'";

            try {
                $result = mysqli_query($connection -> connection, $sql);
                return $result;
            }  catch (mysqli_sql_exception $err) {
                return null;
            }
        }

        protected static function updateColumnForRow($connection, $key, $value, $column, $columnValue) {
            if (!$connection -> isEstablished()) return null;

            $sql = "UPDATE `" . static::$tableId . "` SET `" . $column . "` = '" . $columnValue . "' WHERE `" . $key . "` = '" . $value . "'";  
            
            try {
                mysqli_query($connection -> connection, $sql);
                return true;
            } catch (mysqli_sql_exception $err) {
                return null;
            }
        }

        protected static function columnValueExists($connection, $column, $value) {
            if (!$connection -> isEstablished()) return null;

            $sql = "SELECT 1 FROM `" . static::$tableId .  "` WHERE `" . $column . "` = '" . $value . "'";

            try {
                $result = mysqli_query($connection -> connection, $sql);
                return mysqli_num_rows($result) > 0;
            } catch (mysqli_sql_exception $err) {
                return null;
            }
        }
    }
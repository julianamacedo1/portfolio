<?php   
    function getAppData($key = null) {
        $rawData = $_COOKIE["data"] ? $_COOKIE["data"] : null;
        $data = $rawData ? json_decode($rawData, true) : [];

        return $key ? $data[$key] : $data;
    }

    function setAppData($key, $value) {
        $data = getAppData();
        $data[$key] = $value;

        setcookie("data", json_encode($data), time() + (3600 * 24), "/");
    }
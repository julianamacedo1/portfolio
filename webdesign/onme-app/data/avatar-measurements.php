<?php
    $avatarMeasurementData = [
        "Height" => [
            "range" => [4.5, 6.5],
        ],
        "Shoulders" => [
            "range" => [17, 26],
            "increment" => 0.5,
        ],
        "Bust" => [
            "range" => [32, 46],
            "increment" => 0.5,
        ],
        "Waist" => [
            "range" => [25, 39],
            "increment" => 0.5,
        ],
        "Hips" => [
            "range" => [35, 49],
            "increment" => 0.5,
        ],
    ];

    function getActualMeasurementValue($measurement, $value) {
        global $avatarMeasurementData;

        $rangeMin = $avatarMeasurementData[$measurement]["range"][0];
        $range = $avatarMeasurementData[$measurement]["range"][1] - $rangeMin;
        $ratio = (floatval($value)) / 100.0;
        $actualValue = $rangeMin + ($range * $ratio);

        return round($actualValue * 10) / 10;
    }
<?php 
    $data = [
        "favorites" => [],
        "avatar" => [],
    ];

    setcookie("data", json_encode($data), time() + 86400, "/");
    header("Location: landing.php");
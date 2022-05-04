<?php
    session_start();

    include_once __DIR__."/../database/DatabaseConnection/index.php";
    include_once __DIR__."/../database/StudentInfoTable/index.php";
    include_once __DIR__."/../PageState/index.php";
    include_once __DIR__."/../Utility/index.php";

    $pageName = "login";
    $redirectURL = PageDirectory::getPathOfPage($pageName);

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        PageState::send($redirectURL);
        exit();
    }

    $state = new PageState($pageName);

    $fields = ["nid", "password"];
    $data = Utility::getSanitizedValues($fields, $_POST);

    $connection = new DatabaseConnection();
    $connection -> connect();

    // Unable to connect to database
    if (!$connection -> isEstablished()) {
        $state -> setStatus(PageState::STATUS_NO_CONNECTION);
        goto end;
    }

    $ucfid = StudentInfoTable::getUCFIdByLoginCredentials($connection, strtolower($data["nid"]), $data["password"]);

    if ($ucfid) {
        $sessionStarted = Utility::startLoginSession($connection, $ucfid);
        $connection -> disconnect();

        // Unable to start session
        if (!$sessionStarted) {
            $state -> setStatus(PageState::STATUS_DEFAULT);
            goto end;
        }

        Utility::redirectToHome();
        exit();
    }

    // Couldn't get UCF Id
    $state -> setStatus(PageState::STATUS_GENERIC);
    $state -> setDataValue("nid", $data["nid"]);

    end:
    if (isset($connection)) $connection -> disconnect();
    PageState::send($redirectURL, $state);
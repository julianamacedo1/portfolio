<?php
    include_once dirname(__FILE__)."/./Utility/index.php";

    if (!Utility::isLoggedin()) Utility::redirectToLogin();

    Utility::endLoginSession();
    Utility::redirectToLogin();
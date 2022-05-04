<?php
    session_start();

    include_once __DIR__."/./backend/PageDirectory/index.php";
    include_once __DIR__."/./backend/PageState/index.php";
    include_once __DIR__."/./backend/Utility/index.php";
    include_once __DIR__."/./components/FormFeedbackMessage/index.php";

    if (Utility::isLoggedin()) {
        Utility::redirectToHome();
        exit();
    }

    $pageName = "login";
    $state = PageState::create($pageName);

    $formFeedbackMessageParams = [
        "feedbackMessages" => [
            "error" => "Your NID or password was incorrect.",
            "no-connection" => "There was a problem connecting to the database. Please wait a few minutes and try again.",
            "default" => "There was a problem logging in. Please wait a few minutes and try again.",
        ],
        "feedbackState" => $state -> getStatus(),
    ];

    $preferences = Utility::getPreferences();
?>

<!DOCTYPE html>
<html lang="en" appearance="<?= $preferences["appearance"]; ?>" font="<?= $preferences["font"]; ?>">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="css/main.css">
        <link rel="shortcut icon" href="favicon.ico">
        <script type="module" src="js/index.js"></script>
        <title>Log In - myUCF</title>
    </head>
    <body>
        <div class="no-nav" id="app">
            <main class="no-header" id="app-content">
                <div class="page-content-container full-height">
                    <div class="card" id="form-card">
                        <div class="card-body">
                            <form class="form" action="<?= PageDirectory::getPathOfPage("login") . "backend/handlers/login-form.php"; ?>" method="POST">
                                <div class="myucf-logo"></div>
                                <?php FormFeedbackMessage::render($formFeedbackMessageParams); ?>
                                <input class="input" required name="nid" type="text" placeholder="NID" value="<?= $state -> getDataValue("nid") ? $state -> getDataValue("nid"): ""; ?>">
                                <input class="input" required name="password" type="password" placeholder="Password">
                                <button class="button prominent full-width font-size-text-normal" type="submit">Log In</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a class="link stylized" target="_blank" href="https://mynid.ucf.edu/pages/NidCheck.aspx">Reset your password</a>
                            <a class="link stylized" target="_blank" href="https://it.ucf.edu">Having trouble logging in?</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
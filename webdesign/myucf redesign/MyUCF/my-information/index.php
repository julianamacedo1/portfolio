<?php
    include_once __DIR__."/../components/NavigationMenu/index.php";
    include_once __DIR__."/../components/SegmentedControl/index.php";
    include_once __DIR__."/../backend/Utility/index.php";

    include_once __DIR__."/./components/PersonalInformationView/index.php";
    include_once __DIR__."/./components/UniversityInformationView/index.php";

    if (!Utility::isLoggedin()) {
        Utility::redirectToLogin();
        exit();
    }

    $studentInfo = Utility::getStudentPersonalInformation();
    $preferences = Utility::getPreferences();

    $segmentedControlParams = [
        "componentId" => "student-information-selector",
        "selectedTab" => "personal",
        "tabs" => [
            "personal" => [
                "title" => "Personal",
                "view" => "personal",
            ],
            "university" => [
                "title" => "University",
                "view" => "university",
            ],
        ],
    ];
?>

<!DOCTYPE html>
<html lang="en" appearance="<?= $preferences["appearance"]; ?>" font="<?= $preferences["font"]; ?>">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="shortcut icon" href="../favicon.ico">
        <script type="module" src="js/index.js"></script>
        <title>My Information - myUCF</title>
    </head>
    <body>
        <div id="app">
            <?php NavigationMenu::render("info"); ?>
            <main id="app-content">
                <header class="page-header-container">
                    <div class="page-header-content">
                        <h1 class="heading stylized page-header-title">My Information</h1>
                        <?php SegmentedControl::render($segmentedControlParams); ?>
                    </div>
                </header>
                <?php 
                    PersonalInformationView::render($studentInfo); 
                    UniversityInformationView::render($studentInfo);
                ?>
            </main>
        </div>
    </body>
</html>
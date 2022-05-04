<?php
    include_once __DIR__."/../components/NavigationMenu/index.php";
    include_once __DIR__."/../backend/Utility/index.php";

    include_once __DIR__."/./components/ClassesCard/index.php";
    include_once __DIR__."/./components/AdvisingCard/index.php";
    include_once __DIR__."/./components/AcademicProgramCard/index.php";

    if (!Utility::isLoggedin()) {
        Utility::redirectToLogin();
        exit();
    }

    $studentEnrollment = Utility::getStudentEnrollmentInformation();
    $preferences = Utility::getPreferences();
?>

<!DOCTYPE html>
<html lang="en" appearance="<?= $preferences["appearance"]; ?>" font="<?= $preferences["font"]; ?>">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="shortcut icon" href="../favicon.ico">
        <script type="module" src="js/index.js"></script>
        <title>Academics - myUCF</title>
    </head>
    <body>
        <div id="app">
            <?php NavigationMenu::render("academics"); ?>
            <main id="app-content">
                <header class="page-header-container">
                    <div class="page-header-content">
                        <h1 class="heading stylized page-header-title">Academics</h1>
                    </div>
                </header>
                <div class="page-content-container" viewid="overview">
                    <div class="grid two-column left-large desktop">
                        <div class="grid">
                            <?php ClassesCard::render($studentEnrollment["courses"]); ?>
                            <?php AdvisingCard::render($studentEnrollment["advisor"]); ?>
                        </div>
                        <?php AcademicProgramCard::render($studentEnrollment); ?>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
<?php
    include_once __DIR__."/../components/NavigationMenu/index.php";
    include_once __DIR__."/../components/SegmentedControl/index.php";
    include_once __DIR__."/../backend/Utility/index.php";

    include_once __DIR__."/./components/DueChargesCard/index.php";
    include_once __DIR__."/./components/PastChargesCard/index.php";

    if (!Utility::isLoggedin()) {
        Utility::redirectToLogin();
        exit();
    }

    $studentFinances = Utility::getStudentFinancesInformation();
    $preferences = Utility::getPreferences();
?>

<!DOCTYPE html>
<html lang="en" appearance="<?= $preferences["appearance"]; ?>" font="<?= $preferences["font"]; ?>">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="shortcut icon" href="../favicon.ico">
        <script type="module" src="js/index.js"></script>
        <title>Finances - myUCF</title>
    </head>
    <body>
        <div id="app">
            <?php NavigationMenu::render("finances"); ?>
            <main id="app-content">
                <header class="page-header-container">
                    <div class="page-header-content">
                        <h1 class="heading stylized page-header-title">Finances</h1>
                    </div>
                </header>
                <div class="page-content-container">
                    <?php 
                        DueChargesCard::render($studentFinances); 
                        PastChargesCard::render($studentFinances["past_charges"]);
                    ?>
                </div>
            </main>
        </div>
    </body>
</html>
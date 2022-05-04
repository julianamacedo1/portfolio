<?php
    include_once __DIR__."/../components/NavigationMenu/index.php";
    include_once __DIR__."/../backend/Utility/index.php";

    $ucfid = Utility::requestSessionUCFId();

    if (!$ucfid) {
        Utility::redirectToLogin();
        exit();
    }

    $preferences = Utility::getPreferences();
?>

<!DOCTYPE html>
<html lang="en" appearance="<?= $preferences["appearance"]; ?>" font="<?= $preferences["font"]; ?>">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="shortcut icon" href="../favicon.ico">
        <script type="module" src="js/index.js"></script>
        <title>Tasks - myUCF</title>
    </head>
    <body>
        <div id="app">
            <?php NavigationMenu::render("tasks"); ?>
            <main id="app-content">
                <header class="page-header-container">
                    <div class="page-header-content">
                        <h1 class="heading stylized page-header-title">Tasks</h1>
                    </div>
                </header>
                <div class="page-content-container">
                    <div class="grid two-column desktop">
                        <!--<div class="card wide split-early">
                            <div class="card-body">
                                <div class="icon-text-container">
                                    <div class="icon" icon="alert"></div>
                                    <p class="text">There are 1 or more unresolved task items.</p>
                                </div>
                            </div>
                        </div>-->  
                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading">To-Do's</h2>
                            </div>
                            <div class="card-body">
                                <div class="icon-text-container">
                                    <div class="icon" icon="checkmark"></div>
                                    <p class="text">You have no to-do items at this time.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading">Holds</h2>
                            </div>
                            <div class="card-body">
                                <div class="icon-text-container">
                                    <div class="icon" icon="checkmark"></div>
                                    <p class="text">You have no holds at this time.</p>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
            </main>
        </div>
    </body>
</html>
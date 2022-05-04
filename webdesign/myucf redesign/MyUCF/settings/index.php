<?php
    include_once __DIR__."/../components/NavigationMenu/index.php";
    include_once __DIR__."/../components/SingleSelectControl/index.php";
    include_once __DIR__."/../components/ToggleSwitch/index.php";
    include_once __DIR__."/../backend/Utility/index.php";

    if (!Utility::isLoggedin()) {
        Utility::redirectToLogin();
        exit();
    }

    $preferences = Utility::getPreferences();

    $singleSelectControlParams = [
        "componentId" => "visual-appearance-selection-control",
        "selectedOption" => $preferences["appearance"],
        "options" => [
            [
                "id" => "default",
                "title" => "OS Default",
            ],
            [
                "id" => "light",
                "title" => "Light",
            ],
            [
                "id" => "dark",
                "title" => "Dark",
            ],
        ],
    ];
    $toggleSwitchParams = [
        "componentId" => "dyslexia-font-switch",
        "on" => $preferences["font"] == "dyslexic",
    ];
?>

<!DOCTYPE html>
<html lang="en" appearance="<?= $preferences["appearance"]; ?>" font="<?= $preferences["font"]; ?>">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="shortcut icon" href="../favicon.ico">
        <script type="module" src="js/index.js"></script>
        <title>Settings - myUCF</title>
    </head>
    <body>
        <div id="app">
            <?php NavigationMenu::render("settings"); ?>
            <main id="app-content">
                <header class="page-header-container">
                    <div class="page-header-content">
                        <h1 class="heading stylized page-header-title">Settings</h1>
                    </div>
                </header>
                <div class="page-content-container">
                    <div class="card">
                        <div class="card-header split">
                            <h3 class="heading">Visual Appearance</h3>
                            <?php SingleSelectControl::render($singleSelectControlParams); ?>
                        </div>
                        <div class="card-footer">
                            <div class="icon-text-container">
                                <div class="icon" icon="info"></div>
                                <p class="text">"OS Default" automatically changes the visual appearance to match that of your device.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="heading">Dyslexia-Friendly Typeface</h3>
                            <?php ToggleSwitch::render($toggleSwitchParams); ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
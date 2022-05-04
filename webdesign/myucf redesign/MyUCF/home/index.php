<?php
    include_once __DIR__."/../components/NavigationMenu/index.php";
    include_once __DIR__."/../backend/Utility/index.php";
    include_once __DIR__."/../academics/components/AdvisingCard/index.php";
    include_once __DIR__."/../academics/components/ClassesCard/index.php";
    include_once __DIR__."/../finances/components/DueChargesCard/index.php";

    if (!Utility::isLoggedin()) {
        Utility::redirectToLogin();
        exit();
    }

    $studentInfo = Utility::getStudentPersonalInformation();
    $studentEnrollment = Utility::getStudentEnrollmentInformation();
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
        <title>Home - myUCF</title>
    </head>
    <body>
        <div id="app">
            <?php NavigationMenu::render("home"); ?>
            <main id="app-content">
                <header class="page-header-container decorative-background"></header>
                <div class="page-content-container">
                    <div class="user-profile-container">
                        <img class="user-profile-picture" src="../assets/images/student-headshots/<?= $studentInfo["ucfid"]; ?>.jpg" alt="Student profile picture">
                        <div class="user-profile-content">
                            <div class="user-profile-decoration-container">
                                <div class="user-profile-content">
                                    <div class="user-profile-info-container">
                                        <h1 class="heading">
                                            <?= ($studentInfo["preferred_name"] ? $studentInfo["preferred_name"] : $studentInfo["first_name"]) . " " . $studentInfo["last_name"]; ?>&nbsp;<sup style="font-weight: normal; font-size: 0.8rem;"><?= $studentInfo["pronouns"] ? "(" . $studentInfo["pronouns"] . ")" : ""; ?></sup>
                                        </h1>
                                        <div class="user-profile-academic-discipline-container">
                                            <p class="text">
                                                <?= $studentEnrollment["major"]["abbreviation"] . " " . $studentEnrollment["major"]["name"] . ($studentEnrollment["major"]["track"] ? (", " . $studentEnrollment["major"]["track"] ) : "") ; ?>
                                            </p>
                                            <?php if ($studentEnrollment["minor"]) { ?>
                                                <p class="text">Minor in <?= $studentEnrollment["minor"]["name"]; ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="user-profile-actions-container">
                                <a class="button prominent" target="_blank" href="https://my.ucf.edu">Schedule Advising Appointment</a>
                                <a class="button outlined" target="_blank" href="https://my.ucf.edu">Search for Classes</a>
                            </div>
                        </div>
                    </div>
                    <div class="grid two-column desktop">
                        <div class="grid">
                            <?php 
                                ClassesCard::render($studentEnrollment["courses"], true);
                                AdvisingCard::render($studentEnrollment["advisor"]); 
                            ?>
                        </div>
                        <div class="grid content-height">
                            <?php if ($studentFinances["balance"] > 0) DueChargesCard::render($studentFinances); ?>
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
                </div>
            </main>
        </div>
    </body>
</html>
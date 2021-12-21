<?php   
    include "components/nav.php";
    include "utilities/avatar-customization.php"
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">
        <title>Create Your Avatar - Onme</title>
        <script defer src="js/viewport.js"></script>
        <script defer src="js/cookies.js"></script>
        <script defer src="js/navigation.js"></script>
        <script defer src="js/avatar-measurements.js"></script>
        <script defer src="js/components/avatar.js"></script>
        <script defer src="js/components/avatar-measurement-slider.js"></script>
        <script defer src="js/views/avatar-skin-tone.js"></script>
        <script defer src="js/views/avatar-measurements.js"></script>
        <script defer src="js/views/avatar-features.js"></script>
        <script defer src="js/views/avatar-somatotype.js"></script>
    </head>
    <body>  
        <div class="simulated-device">
            <div class="view-container" id="master">
                <div class="view no-bottom-nav" view-id="root">
                    <?php renderTopNav([
                            "title" => "Shape", 
                            "animationStyle" => "slide",
                        ]); ?>
                    <?php renderAvatarSomatotypeView(); ?>
                </div>
            </div>
        </div>

        <div class="hidden" id="view-templates">
            <?php renderAvatarFeaturesView(); ?>
            <?php renderAvatarMeasurementsView(); ?>
            <?php renderAvatarSkinToneView(); ?>
        </div>
    </body>
</html>
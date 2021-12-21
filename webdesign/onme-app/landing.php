<?php   
    include "components/landing-page.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">
        <title>Onme</title>
        <script defer src="js/viewport.js"></script>
    </head>
    <body>  
        <div class="simulated-device">
            <div class="view-container" id="master">
                <div class="view no-bottom-nav" view-id="root">
                    <?php renderLandingPageView(); ?>
                </div>
            </div>
        </div>
    </body>
</html>
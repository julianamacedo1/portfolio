<?php 
    include "components/nav.php"; 
    include "components/account.php"; 
    include "components/clothing-details.php"; 
    include "components/clothing-list-favorites.php";
    include "utilities/avatar-customization.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">
        <title>Favorites - Onme</title>
        <script defer src="js/viewport.js"></script>
        <script defer src="js/cookies.js"></script>
        <script defer src="js/navigation.js"></script>
        <script defer src="js/avatar-measurements.js"></script>
        <script defer src="js/components/nav.js"></script>
        <script defer src="js/components/avatar.js"></script>
        <script defer src="js/components/avatar-measurement-slider.js"></script>
        <script defer src="js/components/favorite-button.js"></script>
        <script defer src="js/components/clothing-fit-scale.js"></script>
        <script defer src="js/views/account.js"></script>
        <script defer src="js/views/clothing-details.js"></script>
        <script defer src="js/views/clothing-list.js"></script>
        <script defer src="js/views/avatar-skin-tone.js"></script>
        <script defer src="js/views/avatar-measurements.js"></script>
        <script defer src="js/views/avatar-features.js"></script>
        <script defer src="js/views/avatar-somatotype.js"></script>
    </head>
    <body>  
        <div class="simulated-device">
            <div class="view-container" id="master">
                <div class="view" view-id="root">
                    <?php 
                        renderTopNav([
                            "title" => "Favorites", 
                            "actions" => [
                                "primary" => [
                                    "category" => "icon",
                                    "type" => "account",
                                    "id" => "account-open-button",
                                ],
                            ]
                        ]); 
                    ?>
                    <?php renderClothingListFavoritesView(); ?>
                    <?php renderBottomNav("favorites"); ?>
                </div>
            </div>
        </div>

        <div class="hidden" id="view-templates">
            <?php renderAccountView(); ?>
            <?php renderClothingDetailsView(); ?>
            <?php renderAvatarCustomizationViews(); ?>
        </div>
    </body>
</html>
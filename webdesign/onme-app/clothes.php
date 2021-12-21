<?php 
    include "components/nav.php"; 
    include "components/account.php"; 
    include "components/clothing-details.php";
    include "components/clothing-list-filter.php"; 
    include "components/clothing-list.php"; 
    include "utilities/avatar-customization.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">
        <title>Clothes - Onme</title>
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
        <script defer src="js/views/avatar-skin-tone.js"></script>
        <script defer src="js/views/avatar-measurements.js"></script>
        <script defer src="js/views/avatar-features.js"></script>
        <script defer src="js/views/avatar-somatotype.js"></script>
        <script defer src="js/views/clothing-details.js"></script>
        <script defer src="js/views/clothing-list-filter.js"></script>
        <script defer src="js/views/clothing-list.js"></script>
    </head>
    <body>  
        <div class="simulated-device">
            <div class="view-container" id="master">
                <div class="view" view-id="root">
                    <?php 
                        renderTopNav([
                            "title" => "Clothes", 
                            "actions" => [
                                "primary" => [
                                    "category" => "icon",
                                    "type" => "account",
                                    "id" => "account-open-button",
                                ],
                                "secondary" => [
                                    "category" => "text",
                                    "title" => "Filter",
                                    "id" => "clothing-list-filter-button",
                                ]
                            ]
                        ]); 
                    ?>
                    <?php renderClothingListView(); ?>
                    <?php renderBottomNav("clothes"); ?>
                </div>
            </div>
        </div>

        <div class="hidden" id="view-templates">
            <?php renderAccountView(); ?>
            <?php renderClothingDetailsView(); ?>
            <?php renderClothingListFilterView(); ?>
            <?php renderAvatarCustomizationViews(); ?>
        </div>
    </body>
</html>
<?php
    include_once "utilities/cookies.php";
    include_once "data/clothing-articles-data-structures.php";

    function renderClothingListFavoritesView() { 
        global $structuredClothingData;

        $favoritedArticles = getAppData("favorites"); 
        $favoritedClothingData = [];

        if (sizeof($favoritedArticles) > 0) {
            for ($i = 0, $length = sizeof($structuredClothingData); $i < $length; $i++) {
                $tempCategory = null;
                $tempArticles = [];

                for ($j = 0, $length2 = sizeof($structuredClothingData[$i] -> articles); $j < $length2; $j++)
                    if (in_array($structuredClothingData[$i] -> articles[$j] -> id, $favoritedArticles))
                        array_push($tempArticles, $structuredClothingData[$i] -> articles[$j]);

                if (sizeof($tempArticles) > 0) {
                    $tempCategory = new ClothingCategory();
                    $tempCategory -> name = $structuredClothingData[$i] -> name;
                    $tempCategory -> articles = $tempArticles;

                    array_push($favoritedClothingData, $tempCategory);
                }
            }
        } ?>

        <div class="safe-area-view" view-id="clothes" view-title="Favorites" active="true">
            <?php 
                if (sizeof($favoritedArticles) == 0) { ?>
                    <div class="layout-container full-size center-contents">
                        <div class="layout-container extra-small-gap">
                            <h1 class="header secondary understated text-centered">No Favorites</h1>
                            <p class="text understated text-size-small text-centered">Tap on the heart icon to favorite an article of clothing.</p>
                        </div>
                    </div>
            <?php } else { ?>
                <div class="clothing-category-container">
                    <?php for ($i = 0, $length = sizeof($favoritedClothingData); $i < $length; $i++) { ?>
                        <div class="clothing-category-content">
                            <div class="clothing-category-name-container">
                                <p class="text clothing-category-name"><?= ucfirst($favoritedClothingData[$i] -> name); ?></p>
                            </div>  
                            <div class="clothing-article-container table">
                                <?php 
                                    for ($j = 0, $length2 = sizeof($favoritedClothingData[$i] -> articles); $j < $length2; $j++) { ?>
                                        <div class="clothing-article" component-id="clothing-article"
                                        <?php 
                                            $attrData = [
                                                "clothing-id" => $favoritedClothingData[$i] -> articles[$j] -> id,
                                                "clothing-category" => $favoritedClothingData[$i] -> articles[$j] -> category,
                                                "clothing-gender" => $favoritedClothingData[$i] -> articles[$j] -> gender,
                                                "clothing-name" => $favoritedClothingData[$i] -> articles[$j] -> name,
                                                "clothing-brand" => $favoritedClothingData[$i] -> articles[$j] -> brand,
                                                "clothing-price" => $favoritedClothingData[$i] -> articles[$j] -> price,
                                                "clothing-fit" => $favoritedClothingData[$i] -> articles[$j] -> fit,
                                                "clothing-description" => $favoritedClothingData[$i] -> articles[$j] -> description,
                                                "clothing-fit-offset" => $favoritedClothingData[$i] -> articles[$j] -> fitOffset,
                                                "clothing-hyperlink" => $favoritedClothingData[$i] -> articles[$j] -> hyperlink,
                                                "clothing-image-path" => $favoritedClothingData[$i] -> articles[$j] -> imagePath,
                                            ];
                                            foreach ($attrData as $attrName => $attrValue) { ?>
                                                <?= $attrName; ?>="<?= $attrValue; ?>" 
                                            <?php } ?>
                                        >
                                            <div class="clothing-article-image-container">
                                                <img class="image clothing-article-image" src="assets/images/clothing/<?= $favoritedClothingData[$i] -> articles[$j] -> imagePath; ?>">
                                            </div>
                                            <div class="clothing-article-information-container">
                                                <p class="text clothing-article-brand"><?= $favoritedClothingData[$i] -> articles[$j] -> brand; ?></p>
                                                <div class="clothing-article-name-action-container">
                                                    <div class="layout-container tiny-gap">
                                                        <p class="text clothing-article-name"><?= $favoritedClothingData[$i] -> articles[$j] -> name; ?></p>
                                                        <p class="text clothing-article-fit understated"><?= $favoritedClothingData[$i] -> articles[$j] -> fit; ?></p>
                                                    </div>
                                                    <button class="button icon-button icon-only heart clothing-favorite filled" component-id="favorite-button" for-clothing="<?= $favoritedClothingData[$i] -> articles[$j] -> id; ?>"></button>
                                                </div>
                                            </div>
                                        </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php }
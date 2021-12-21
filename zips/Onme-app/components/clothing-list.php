<?php
    include_once "utilities/cookies.php";
    include_once "data/clothing-articles-data-structures.php";

    function renderClothingListView() { 
        global $structuredClothingData;

        $favoritedArticles = getAppData("favorites"); ?>

        <div class="safe-area-view" view-id="clothes" view-title="Clothes" active="true">
            <div class="clothing-category-container">
                <?php for ($i = 0, $length = sizeof($structuredClothingData); $i < $length; $i++) { ?>
                    <div class="clothing-category-content" clothing-category="<?= ucfirst($structuredClothingData[$i] -> name); ?>"> 
                        <div class="clothing-category-name-container">
                            <p class="text clothing-category-name"><?= ucfirst($structuredClothingData[$i] -> name); ?></p>
                        </div>  
                        <div class="clothing-article-container">
                            <?php 
                                for ($j = 0, $length2 = sizeof($structuredClothingData[$i] -> articles); $j < $length2; $j++) { 
                                    $isFavorited = in_array($structuredClothingData[$i] -> articles[$j] -> id, $favoritedArticles); ?>
                                    <div class="clothing-article" component-id="clothing-article"
                                    <?php 
                                        $attrData = [
                                            "clothing-id" => $structuredClothingData[$i] -> articles[$j] -> id,
                                            "clothing-category" => $structuredClothingData[$i] -> articles[$j] -> category,
                                            "clothing-gender" => $structuredClothingData[$i] -> articles[$j] -> gender,
                                            "clothing-name" => $structuredClothingData[$i] -> articles[$j] -> name,
                                            "clothing-brand" => $structuredClothingData[$i] -> articles[$j] -> brand,
                                            "clothing-price" => $structuredClothingData[$i] -> articles[$j] -> price,
                                            "clothing-fit" => $structuredClothingData[$i] -> articles[$j] -> fit,
                                            "clothing-description" => $structuredClothingData[$i] -> articles[$j] -> description,
                                            "clothing-fit-offset" => $structuredClothingData[$i] -> articles[$j] -> fitOffset,
                                            "clothing-hyperlink" => $structuredClothingData[$i] -> articles[$j] -> hyperlink,
                                            "clothing-image-path" => $structuredClothingData[$i] -> articles[$j] -> imagePath,
                                        ];
                                        foreach($attrData as $attrName => $attrValue) { ?>
                                            <?= $attrName; ?>="<?= $attrValue; ?>" 
                                        <?php } ?>
                                    >
                                        <div class="clothing-article-image-container">
                                            <img class="image clothing-article-image" src="assets/images/clothing/<?= $structuredClothingData[$i] -> articles[$j] -> imagePath; ?>">
                                        </div>
                                        <div class="clothing-article-information-container">
                                            <p class="text clothing-article-brand"><?= $structuredClothingData[$i] -> articles[$j] -> brand; ?></p>
                                            <div class="clothing-article-name-action-container">
                                                <div class="layout-container tiny-gap">
                                                    <p class="text clothing-article-name"><?= $structuredClothingData[$i] -> articles[$j] -> name; ?></p>
                                                    <p class="text clothing-article-fit understated"><?= $structuredClothingData[$i] -> articles[$j] -> fit; ?></p>
                                                </div>
                                                <button class="button icon-button icon-only heart clothing-favorite <?= $isFavorited ? "filled" : ""; ?>" component-id="favorite-button" for-clothing="<?= $structuredClothingData[$i] -> articles[$j] -> id; ?>"></button>
                                            </div>
                                        </div>
                                    </div>
                            <?php }?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        
    <?php }
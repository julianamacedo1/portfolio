<?php 
    include_once "data/clothing-filters.php";

    function renderClothingListFilterView() { 
        global $clothingFilters; ?>
        <div class="safe-area-view" view-id="clothing-list-filter" view-title="Filter" active="true">
            <div class="layout-container large-gap">
                <?php   
                    foreach ($clothingFilters as $category => $topics) { ?>
                        <div class="layout-container">
                            <h1 class="header secondary"><?= $category; ?></h1>
                            <div class="layout-container two-column small-gap">
                                <?php 
                                    for ($i = 0, $length = sizeof($topics); $i < $length; $i++) { ?>
                                        <button class="button filter-topic" filter-category="<?= $category; ?>" filter-topic="<?= $topics[$i]; ?>"><?= $topics[$i]; ?></button>
                                <?php } ?>
                            </div>
                        </div>
                <?php } ?>
            </div>
        </div>
<?php }
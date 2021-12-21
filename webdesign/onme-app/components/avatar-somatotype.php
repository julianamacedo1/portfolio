<?php
    include_once "data/somatotypes.php";
    include_once "components/segmented-control.php";

    function renderAvatarSomatotypeView() { 
        global $somatotypeData; ?>
        <div class="safe-area-view" view-id="avatar-somatotype" view-title="Shape" active="true">
            <div class="layout-container large-gap full-size somatotype-view-container">
                <div class="layout-container content-height center-contents">
                    <p class="text text-centered text-size-small">Select your avatar's body shape to begin.</p>
                </div>
                <div class="layout-container content-height">
                    <?php renderSegmentedControl([
                        "activeTab" => 1,
                        "tabs" => ["Masculine", "Feminine"],
                    ]); ?>
                </div>
                <div class="somatotype-collection-container">
                    <?php
                        foreach ($somatotypeData as $build => $description) {?>
                            <div class="somatotype-container" somatotype="<?= lcfirst($build); ?>">
                                <div class="somatotype-image-container">
                                    <div class="avatar-full-body masculine <?= lcfirst($build); ?>"></div>
                                </div>
                                <div class="somatotype-text-container">
                                    <p class="text somatotype-name"><?= $build; ?></p>
                                    <p class="text somatotype-description"><?= $description; ?></p>
                                </div>
                            </div>
                    <?php } ?>
                </div>
            </div>
        </div>
<?php }
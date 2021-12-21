<?php
    include_once "components/avatar.php";
    include_once "data/avatar-measurements.php";

    function renderAvatarMeasurementsView() { 
        global $avatarMeasurementData; ?>
        <div class="safe-area-view" view-id="avatar-measurements" view-title="Sizes" active="true">
            <div class="layout-container sticky-overlay large-gap extra-margin-bottom-large">
                <div class="layout-container content-height center-contents">
                    <p class="text text-centered text-size-small">Tailor your avatar's body measurements.</p>
                </div>
                <?php renderAvatar(); ?>
            </div>
            <div class="layout-container large-gap">
                <?php 
                    foreach ($avatarMeasurementData as $measurement => $data) { ?>
                        <div class="layout-container" component-id="avatar-measurement-slider-container">
                            <div class="layout-container two-column">
                                <label for="<?= $measurement; ?>-slider" class="avatar-measurement-slider-label"><?= $measurement; ?></label>
                                <p class="text avatar-measurement-slider-value <?= $measurement == "Height" ? "height" : ""; ?>" for-measurement="<?= $measurement; ?>">0.00</p>
                            </div>
                            <input name="<?= $measurement; ?>-slider" measurement-id="<?= $measurement; ?>" class="avatar-measurement-slider" type="range" slider-min="<?= $data["range"][0]; ?>" slider-max="<?= $data["range"][1]; ?>">
                        </div>
                <?php } ?>
            </div>
            <hr class="separator large-gap">
            <div class="layout-container">
                <button class="button" component-id="continue-button">Continue</button>
            </div>
        </div>
<?php }
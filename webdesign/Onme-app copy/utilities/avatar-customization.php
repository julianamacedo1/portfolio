<?php
    include_once "components/avatar-somatotype.php";
    include_once "components/avatar-features.php";
    include_once "components/avatar-measurements.php";
    include_once "components/avatar-skin-tone.php";

    function renderAvatarCustomizationViews() {
        renderAvatarSomatotypeView();
        renderAvatarFeaturesView();
        renderAvatarMeasurementsView();
        renderAvatarSkinToneView();
    }
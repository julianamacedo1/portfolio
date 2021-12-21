<?php
    include_once "components/avatar.php";

    function renderAvatarFeaturesView() { ?>
        <div class="safe-area-view" view-id="avatar-features" view-title="Features" active="true">
            <div class="layout-container center-contents extra-margin-bottom-large">
                <p class="text text-centered text-size-small">Adjust your avatar's body features.</p>
            </div>
            <div class="avatar-features-layout-container">
                <?php renderAvatar([
                    "customizable" => true
                ]); ?>
                <button class="button" component-id="continue-button">Continue</button>
            </div>
        </div>
<?php }
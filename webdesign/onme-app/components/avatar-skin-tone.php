<?php   
    include_once "components/avatar.php";

    function renderAvatarSkinToneView() { ?>
        <div class="safe-area-view" view-id="avatar-skin-tone" view-title="Skin Tone" active="true">
            <div class="layout-container extra-large-gap avatar-skin-tone-view-master-container">
                <div class="layout-container center-contents">
                    <p class="text text-centered text-size-small">Finally, choose your avatar's skin tone.</p>
                </div>
                <div class="layout-container avatar-skin-tone-view-container">
                    <?php renderAvatar(); ?>
                    <div class="avatar-skin-tone-button-container">
                        <?php   
                            for ($i = 0; $i < 5; $i++) { ?>
                                <button class="button round" component-id="avatar-skin-tone-button" skin-tone=<?= $i + 1; ?>></button>
                        <?php } ?>
                    </div>
                </div>
                <div class="layout-container">
                    <button class="button" component-id="done-button">Done</button>
                </div>
            </div>
        </div>
<?php }
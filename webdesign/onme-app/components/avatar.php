<?php   
    include_once "utilities/cookies.php";

    function renderAvatar($params = []) { ?>
        <div class="avatar-body-container <?= isset($params["customizable"]) && $params["customizable"] ? "customizable" : ""; ?>
            <?php
                if (isset($params["usePreferences"]) && $params["usePreferences"]) {
                    $preferences = getAppData("avatar")["preferences"];
                    for ($i = 0, $length = sizeof($preferences); $i < $length; $i++)
                        echo " ".$preferences[$i];
                }
            ?>
            " skin-tone="<?= isset($params["usePreferences"]) && $params["usePreferences"] ? getAppData("avatar")["skinTone"] : 0; ?>">
            <div class="avatar-body torso"></div>
            <div class="avatar-body leg right <?= isset($params["disabledBodyParts"]["rightLeg"]) && $params["disabledBodyParts"]["rightLeg"] ? "disabled" : "";?>" body-part-id="right-leg"></div>
            <div class="avatar-body leg left <?= isset($params["disabledBodyParts"]["leftLeg"]) && $params["disabledBodyParts"]["leftLeg"] ? "disabled" : "";?>" body-part-id="left-leg"></div>
            <div class="avatar-body arm right <?= isset($params["disabledBodyParts"]["rightArm"]) && $params["disabledBodyParts"]["rightArm"] ? "disabled" : "";?>" body-part-id="right-arm"></div>
            <div class="avatar-body arm left <?= isset($params["disabledBodyParts"]["leftArm"]) && $params["disabledBodyParts"]["leftArm"] ? "disabled" : "";?>" body-part-id="left-arm"></div>
            <?php   
                if (isset($params["fittingRoom"]) && $params["fittingRoom"]) { ?>
                    <div class="avatar-clothing top"></div>
                    <div class="avatar-clothing bottom"></div>
            <?php } ?>
        </div>
<?php } 
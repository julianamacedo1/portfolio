<?php
    include_once "components/avatar.php";

    function renderFittingRoomView() { ?>
        <div class="safe-area-view" view-id="fittingroom" view-title="Fitting Room" active="true">
            <?php renderAvatar([
                "fittingRoom" => true,
                "usePreferences" => true,
                "disabledBodyParts" => getAppData("avatar")["disabledBodyParts"],
            ]); ?>
            <div class="fittingroom-drawer-container">
                <div class="fittingroom-drawer-top-text-container">
                    <p class="text text-size-small understated">All Clothing</p>
                    <button class="fittingroom-drawer-expand-toggle"></button>
                </div>
                <div class="fittingroom-drawer-clothing-article-container">
                    <?php   
                        $demoClothing = [
                            [
                                "id" => 15642,
                                "gender" => "masculine",
                                "category" => "top",
                                "name" => "shirt",
                            ],
                            [
                                "id" => 81785,
                                "gender" => "masculine",
                                "category" => "bottom",
                                "name" => "shorts",
                            ],
                            [
                                "id" => 84465,
                                "gender" => "feminine",
                                "category" => "top",
                                "name" => "dress",
                            ],
                        ];

                        for ($i = 0, $length = sizeof($demoClothing); $i < $length; $i++) { ?>
                            <div class="fittingroom-drawer-clothing-article"
                                <?php 
                                    foreach ($demoClothing[$i] as $key => $value) {
                                        echo "clothing-".$key."=".'"'.$value.'"';
                                    } ?>
                            >
                                <img class="fittingroom-drawer-clothing-article-image" src="assets/images/clothing/<?= $demoClothing[$i]["gender"]; ?>/<?= $demoClothing[$i]["id"]; ?>.png">
                            </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php }
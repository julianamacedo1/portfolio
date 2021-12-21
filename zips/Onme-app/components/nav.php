<?php
    function renderTopNavAction($params = [], $secondary = false) { ?>
        <div class="top-nav-action-container <?= $secondary ? "secondary" : "primary"; ?>">
            <?php 
                if (!empty($params)) {
                    switch ($params["category"]) {
                        case "text": ?>
                            <button class="button text-button top-nav-action" component-id="<?= $params["id"]; ?>"><?= $params["title"]; ?></button>
                        <?php 
                            break;
                        default: ?>
                        <button class="button icon-button monochrome round top-nav-action <?= $params["type"]; ?>" component-id="<?= $params["id"]; ?>"></button>
                <?php }
                } ?>
        </div>
    <?php }

    function renderTopNav($params = []) { ?>
        <nav class="top-nav">
            <div class="top-nav-content">
                <div class="top-nav-section left">
                    <?php renderTopNavAction(isset($params["actions"]["secondary"]) ? $params["actions"]["secondary"] : [], true); ?>
                    <div class="top-nav-back-container at-root" animation-style="<?= isset($params["animationStyle"]) ? $params["animationStyle"] : "stack"; ?>">
                        <button class="button text-button top-nav-back-page-title"></button>
                        <p class="text top-nav-back-page-title aux"></p>
                    </div>
                </div>
                <div class="top-nav-section center">
                    <p class="text top-nav-page-title"><?= isset($params["title"]) ? $params["title"] : "Section"; ?></p>
                </div>
                <div class="top-nav-section right">
                    <?php renderTopNavAction(isset($params["actions"]["primary"]) ? $params["actions"]["primary"] : [], true); ?> 
                </div>
            </div>
        </nav>
    <?php }

    function renderBottomNav($activeTab = "") { 
        $tabs = [
            "clothes" => ["Clothes", "tag"], 
            "fittingroom" => ["Fitting Room", "shirt"], 
            "favorites" => ["Favorites", "heart"]
        ];
        ?>
        <nav class="bottom-nav">
            <div class="bottom-nav-content">
                <?php   
                    foreach ($tabs as $tabKey => $tabData) { ?>
                        <a class="bottom-nav-tab <?= $tabKey == $activeTab ? "active" : ""; ?>" href="<?= $tabKey?>.php">
                            <div class="icon bottom-nav-icon <?= $tabData[1]; ?>"></div>
                            <p class="bottom-nav-tab-name"><?= $tabData[0]; ?></p>
                        </a>
                    <?php } ?>
            </div>
        </nav>
    <?php }
<?php   
    class SegmentedControl {
        static function render($params = []) { 
            $componentId = $params["componentId"];
            $selectedTab = $params["selectedTab"];
            $tabs = $params["tabs"];
            ?>
            <div class="segmented-control-container" componentid="<?= $componentId; ?>">
                <?php foreach ($tabs as $tabId => $tabDetails) { ?>
                    <button class="segmented-control-tab" <?= $selectedTab == $tabId ? "selected" : ""; ?> forview="<?= $tabDetails["view"]; ?>"><?= $tabDetails["title"]; ?></button>
                <?php } ?>
            </div>
        <?php }
    }
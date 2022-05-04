<?php
    class ToggleSwitch {
        static function render($params = []) {
            $componentId = $params["componentId"];
            $on = $params["on"];
            ?>
            <button class="toggle-switch" componentid="<?= $componentId; ?>" <?= $on ? "on" : ""; ?>></button>
        <?php }
    }
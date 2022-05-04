<?php
    class SingleSelectControl {
        static function render($params = []) {
            $componentId = $params["componentId"];
            $selectedOption = $params["selectedOption"];
            $options = $params["options"];
            ?>
            <div class="single-select-control-container" componentid="<?= $componentId; ?>">
                <?php foreach ($options as $option) { ?>
                    <button class="single-select-control-option" optionid="<?= $option["id"]; ?>" <?= $selectedOption == $option["id"] ? "selected" : ""; ?>><?= $option["title"]; ?></button>
                <?php } ?>
            </div>
        <?php }
    }
<?php
    class DropdownMenu {
        static function render($params = []) {
            $componentId = isset($params["componentId"]) ? $params["componentId"] : null;
            $selectedOption = isset($params["selectedOption"]) ? $params["selectedOption"] : null;
            $options = isset($params["options"]) ? $params["options"] : [];

            if (!$componentId || empty($options)) return;
            ?>
            <div class="dropdown-menu-container" componentid="<?= $componentId; ?>">
                <div class="dropdown-menu-value"><?= $options[$selectedOption]; ?></div>
                <div class="dropdown-menu-options-container">
                    <?php foreach ($options as $optionId => $optionValue) { ?>
                        <div class="dropdown-menu-option" <?= $optionId == $selectedOption ? "selected" : ""; ?> forview="<?= $optionId; ?>">
                            <?= $optionValue; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php }
    }
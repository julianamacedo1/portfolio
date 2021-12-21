<?php   
    function renderSegmentedControl($params = []) { ?>
        <div class="segmented-control-container" active-tab="<?= $params["activeTab"]; ?>">
            <div class="segmented-control-tab-highlight"></div>
            <?php 
                for ($i = 0, $length = sizeof($params["tabs"]); $i < $length; $i++) { ?>
                    <p class="text segmented-control-tab-title" tab-name="<?= lcfirst($params["tabs"][$i]); ?>">
                        <?= $params["tabs"][$i]; ?>
                    </p>
            <?php } ?>
        </div>
<?php }
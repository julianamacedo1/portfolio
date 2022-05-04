<?php 
    class PastChargesCard {
        static function render($charges = null) { ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="heading">Past Charges</h3>
                </div>
                <div class="card-body <?= $charges ? "no-padding" : ""; ?>">
                    <?php if (!$charges) { ?> 
                        <div class="icon-text-container vertical center-self">
                            <div class="icon extra-large" icon="alert"></div>
                            <p class="text center-aligned">Unable to load past charges.</p>
                        </div>
                    <?php } else { ?>
                        <div class="table-container">
                            <?php foreach ($charges as $charge) { ?>
                                <div class="table-item">
                                    <div class="grid two-column center-contents-vertical">
                                        <div class="label-text-container">
                                            <p class="text label uppercase"><?= $charge["category"]; ?></p>
                                            <p class="text title"><?= $charge["name"]; ?></p>
                                        </div>
                                        <p class="text financial text-right-aligned-desktop-only"><?= number_format($charge["amount"], 2); ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php }
    }
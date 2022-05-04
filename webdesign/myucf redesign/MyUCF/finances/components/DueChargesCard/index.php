<?php
    class DueChargesCard {
        static function render($data = null) { 
            $hasDues = $data["balance"] > 0;
            ?>
            <div class="card">
                <?php if (!$data) { ?>
                    <div class="card-body">
                        <div class="icon-text-container vertical center-self">
                            <div class="icon extra-large" icon="alert"></div>
                            <p class="text center-aligned">Unable to load current balance.</p>
                        </div>
                    </div>
                <?php } else if ($hasDues) { ?>
                    <div class="card-header no-right-align">
                        <div class="grid small-gap center-contents-vertical">
                            <p class="text large">Due on <?= $data["due_date"]; ?></p>
                            <h1 class="heading large financial" style="font-weight: 600;"><?= number_format($data["balance"], 2); ?></h1>
                        </div>
                    </div>
                    <div class="card-body no-padding">
                        <div class="table-container">
                            <?php foreach ($data["current_charges"] as $charge) { ?>
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
                    </div>
                    <div class="card-footer">
                        <a class="button outlined" target="_blank" href="https://my.ucf.edu">Make a Payment</a>
                    </div>
                <?php } else { ?>
                    <div class="card-body">
                        <div class="icon-text-container">
                            <div class="icon" icon="checkmark"></div>
                            <p class="text">You have no payments due at this time.</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php }
    }
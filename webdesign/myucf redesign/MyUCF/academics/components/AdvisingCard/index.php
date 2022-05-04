<?php
    class AdvisingCard {
        static function render($data = null) { ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="heading">Advising</h3>
                </div>
                <div class="card-body <?= $data ? "no-padding" : ""; ?>">
                    <?php if (!$data) { ?>
                        <div class="icon-text-container vertical center-self">
                            <div class="icon extra-large" icon="alert"></div>
                            <p class="text center-aligned">Unable to load advising information.</p>
                        </div>
                    <?php } else { ?>
                        <div class="table-container two-column">
                            <div class="table-item">
                                <div class="label-text-container">
                                    <p class="text label">Advising Office</p>
                                    <p class="text title"><?= $data["advising_office"]; ?></p>
                                </div>
                            </div>
                            <div class="table-item">
                                <div class="label-text-container">
                                    <p class="text label">Email Address</p>
                                    <p class="text title"><?= $data["email_address"]; ?></p>
                                </div>
                            </div>
                            <div class="table-item wide">
                                <div class="label-text-container">
                                    <p class="text label">Advisor</p>
                                    <p class="text title"><?= $data["name"]; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php if ($data) { ?>
                    <div class="card-footer">
                        <a class="button outlined" target="_blank" href="https://my.ucf.edu">Schedule Advising Appointment</a>
                    </div>
                <?php } ?>
            </div> 
        <?php }
    }
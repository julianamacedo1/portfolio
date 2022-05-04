<?php
    class AcademicProgramCard {
        static function render($data = null) {
            ?>
            <div class="card tall" style="height: max-content;">
                <div class="card-header">
                    <h3 class="heading">Academic Program</h3>
                </div>
                <?php if (!$data) { ?>
                    <div class="card-body">
                        <div class="icon-text-container vertical center-self">
                            <div class="icon extra-large" icon="alert"></div>
                            <p class="text center-aligned">Unable to load academic program information.</p>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="card-body no-padding">
                        <div class="table-container">
                            <div class="table-item">
                                <div class="label-text-container">
                                    <p class="text label">Career</p>
                                    <p class="text title">Undergraduate</p>
                                </div>
                            </div>
                            <div class="table-item">
                                <div class="label-text-container">
                                    <p class="text label">College</p>
                                    <p class="text title"><?= $data["major"]["college"]; ?></p>
                                </div>
                            </div>
                            <div class="table-item">
                                <div class="label-text-container">
                                    <p class="text label">Department</p>
                                    <p class="text title"><?= $data["major"]["department"]; ?></p>
                                </div>
                            </div>
                            <div class="table-item">
                                <div class="label-text-container">
                                    <p class="text label">Major</p>
                                    <p class="text title"><?= $data["major"]["type"] . " of " . $data["major"]["subject"] . " in " . $data["major"]["name"]; ?></p>
                                </div>
                            </div>
                            <?php if (isset($data["major"]["track"])) { ?>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Track</p>
                                        <p class="text title"><?= $data["major"]["track"]; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if (isset($data["minor"])) { ?>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Minor</p>
                                        <p class="text title"><?= $data["minor"]["name"]; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="button outlined" target="_blank" href="https://my.ucf.edu">View myKnightsAudit</a>
                    </div>
                <?php } ?>
            </div>
        <?php }
    }
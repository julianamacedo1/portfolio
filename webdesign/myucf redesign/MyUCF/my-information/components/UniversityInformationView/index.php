<?php
    class UniversityInformationView {
        static function render($data = null) { ?>
            <div class="page-content-container hidden" viewid="university">
                <?php if (!$data || empty($data)) { ?>
                    <div class="icon-text-container vertical center-self">
                        <div class="icon extra-large" icon="alert"></div>
                        <p class="text center-aligned">Unable to load university information.</p>
                    </div>
                <?php } else { ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="heading">UCF Identification</h3>
                        </div>
                        <div class="card-body no-padding">
                            <div class="table-container two-column">
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">UCF ID</p>
                                        <p class="text title"><?= $data["ucfid"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Network ID (NID)</p>
                                        <p class="text title"><?= $data["nid"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item wide">
                                    <div class="label-text-container">
                                        <p class="text label">UCF Card ID</p>
                                        <p class="text title"><?= Utility::decanonicalizeUCFCardId($data["cardid"]); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="heading">Publications</h3>
                        </div>
                        <div class="card-body">
                            <p class="text">Your publications will appear here.</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="heading">Honors and Awards</h3>
                        </div>
                        <div class="card-body">
                            <p class="text">Any honors or awards received will appear here.</p>
                        </div>
                    </div>    
                <?php } ?>        
            </div>
        <?php }
    }
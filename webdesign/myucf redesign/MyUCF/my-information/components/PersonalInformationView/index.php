<?php
    class PersonalInformationView {
        static function render($data = null) { ?>
            <div class="page-content-container" viewid="personal">
                <?php if (!$data || empty($data)) { ?>
                    <div class="icon-text-container vertical center-self">
                        <div class="icon extra-large" icon="alert"></div>
                        <p class="text center-aligned">Unable to load personal information.</p>
                    </div>
                <?php } else { ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="heading">Names and Pronouns</h3>
                        </div>
                        <div class="card-body no-padding">
                            <div class="table-container two-column">
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Name</p>
                                        <p class="text title"><?= $data["first_name"] . " " . $data["last_name"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Preferred Name</p>
                                        <p class="text title"><?= is_null($data["preferred_name"]) ? "-" : $data["preferred_name"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item wide">
                                    <div class="label-text-container">
                                        <p class="text label">Pronouns</p>
                                        <p class="text title"><?= is_null($data["pronouns"]) ? "-" : $data["pronouns"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <div class="card">
                        <div class="card-header">
                            <h3 class="heading">Contact</h3>
                        </div>
                        <div class="card-body no-padding">
                            <div class="table-container two-column">
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Phone Number</p>
                                        <p class="text title"><?= Utility::decanonicalizePhoneNumber($data["phone_number"]); ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Email Address</p>
                                        <p class="text title"><?= $data["email_address"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Permanent Address</p>
                                        <p class="text title"><?= $data["permanent_address_street"]; ?></p>
                                        <p class="text title"><?= $data["permanent_address_location"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Mailing Address</p>
                                        <p class="text title"><?= $data["mailing_address_street"]; ?></p>
                                        <p class="text title"><?= $data["mailing_address_location"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="card">
                        <div class="card-header">
                            <h3 class="heading">Demographic</h3>
                        </div>
                        <div class="card-body no-padding">
                            <div class="table-container two-column">
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Gender</p>
                                        <p class="text title"><?= $data["gender"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Date of Birth</p>
                                        <p class="text title"><?= $data["date_of_birth"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Country of Birth</p>
                                        <p class="text title"><?= $data["country_of_birth"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">State of Birth</p>
                                        <p class="text title"><?= is_null($data["state_of_birth"]) ? "-" : $data["state_of_birth"];; ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Marital Status</p>
                                        <p class="text title"><?= $data["marital_status"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Military Status</p>
                                        <p class="text title"><?= $data["military_status"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Citizenship Status</p>
                                        <p class="text title"><?= $data["citizenship_status"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Country of Citizenship</p>
                                        <p class="text title"><?= is_null($data["country_of_citizenship"]) ? "-" : $data["country_of_citizenship"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <div class="card">
                        <div class="card-header">
                            <h3 class="heading">Ethnicity</h3>
                        </div>
                        <div class="card-body no-padding">
                            <div class="table-container two-column">
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Hispanic or Latino</p>
                                        <p class="text title"><?= $data["hispanic_or_latino"]; ?></p>
                                    </div>
                                </div>
                                <div class="table-item">
                                    <div class="label-text-container">
                                        <p class="text label">Race</p>
                                        <p class="text title"><?= $data["race"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="card">
                        <div class="card-body">
                            <div class="icon-text-container">
                                <div class="icon" icon="info"></div>
                                <p class="text">Need to update your information? <a class="link stylized" href="https://registrar.ucf.edu/contact/" target="_blank">Contact the Registrar's Office</a></p>
                            </div>
                        </div>
                    </div>    
                <?php } ?>        
            </div>
        <?php }
    }
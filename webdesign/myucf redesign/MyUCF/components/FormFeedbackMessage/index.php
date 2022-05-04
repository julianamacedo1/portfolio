<?php 
    class FormFeedbackMessage {
        static function render($params) { 
            $feedbackMessages = isset($params["feedbackMessages"]) ? $params["feedbackMessages"] : [];
            $feedbackState = isset($params["feedbackState"]) ? $params["feedbackState"] : "none";
            $feedbackStateExists = in_array($feedbackState, array_keys($feedbackMessages));
            ?>
            <div class="form-feedback-container feedback-main <?= $feedbackState == "none" ? "hidden" : ""; ?>">
                <div class="icon" icon="alert"></div>
                <p class="text form-feedback-text"> 
                    <?php
                        foreach ($feedbackMessages as $feedbackId => $feedbackText) { ?>
                            <span feedbackid="<?= $feedbackId; ?>" class="<?= $feedbackId == $feedbackState || ($feedbackId == "default" && !$feedbackStateExists) ? "" : "hidden"; ?>"><?= $feedbackText; ?></span>
                    <?php } ?>
                </p>
            </div>
        <?php } 
    }
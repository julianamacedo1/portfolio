<?php
    class ClassesCard {
        static function render($classes = null, $condensed = false) { ?>
            <div class="card tall" <?= !$condensed ? 'style="height: max-content;"' : ""; ?>>
                <div class="card-header">
                    <h3 class="heading">Classes</h3>
                </div>
                <div class="card-body <?= $classes ? "no-padding" : ""; ?>">
                    <?php if (!$classes) { ?>
                        <div class="icon-text-container vertical center-self">
                            <div class="icon extra-large" icon="alert"></div>
                            <p class="text center-aligned">Unable to load class information.</p>
                        </div>
                    <?php } else { ?>
                        <div class="table-container bulleted-list">
                            <?php self::renderClasses($classes, false, $condensed); ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="card-footer">
                    <div class="icon-text-container">
                        <div class="icon" icon="info"></div>
                        <p class="text">Classes next to a gold dot are not on the main campus.</p>
                    </div>
                </div>
            </div> 
        <?php }

        private static function renderClasses($classes, $linked = false, $condensed = false) {
            $i = 0;
            foreach ($classes as $class) { 
                if (isset($class["group"])) {
                    self::renderClasses($class["group"], true, $condensed);
                } else {
                    self::renderClass($class, $linked ? $i : null, $condensed);
                }
                $i++;
            }
        }

        private static function renderClass($class, $linkPosition = null, $condensed) { ?>
            <div class="table-item">
                <li class="bulleted-list-item <?= $class["on_satellite_campus"] ? "gold" : ""; ?><?= !is_null($linkPosition) ? (" linked " . ($linkPosition == 0 ? "first" : "last")) : ""; ?>">     
                    <div class="grid two-column center-contents-vertical">
                        <div class="label-text-container">
                            <p class="text label"><?php if (!$condensed) { ?><?= strtoupper($class["code"]); ?> &bull; <?= strtoupper($class["section"]); ?> &bull; <?php } ?><?= $class["component"]; ?></p>
                            <p class="text title"><?= $class["name"]; ?></p>
                        </div>
                        <div class="label-text-container font-size-text-small text-right-aligned-desktop-only">
                            <?php if (in_array(null, [$class["days"], $class["times"], $class["location"]])) { ?>
                                <p class="text">Asynchronous Online</p>
                            <?php } else { ?>
                                <p class="text"><?= $class["days"]; ?></p>
                                <p class="text"><?= $class["times"]; ?></p>
                                <p class="text"><?= $class["location"]; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </li>
            </div>
        <?php }
    }
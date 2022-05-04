<?php
    include_once __DIR__."/../../backend/PageDirectory/index.php";

    class NavigationMenu {
        static private $tabData = [
            [
                "home" => [
                    "title" => "Home",
                ],
                "info" => [
                    "title" => "My Information",
                ],
                "academics" => [
                    "title" => "Academics",
                ],
                "finances" => [
                    "title" => "Finances",
                ],
                "tasks" => [
                    "title" => "Tasks",
                ],
                "settings" => [
                    "title" => "Settings",
                ]
            ],
            [
                "webcourses" => [
                    "title" => "Webcourses",
                    "path" => "https://webcourses.ucf.edu",
                    "newTab" => true, 
                ],
                "email" => [
                    "title" => "Knights Email",
                    "path" => "https://knightsemail.ucf.edu",
                    "newTab" => true, 
                ],
            ]
        ];

        static function render($activeTab = "") { ?>
            <nav class="tab-nav-container">
                <div class="nav-logo-container">
                    <a class="link wrapper" href="<?= PageDirectory::getPathOfPage("home"); ?>"><div class="nav-logo"></div></a>
                </div>
                <button class="tab-nav-mobile-toggle"></button>
                <div class="tab-nav-content">
                    <ul class="tab-nav-list-container">
                        <?php 
                            for ($i = 0, $length = sizeof(self::$tabData); $i < $length; $i++) {
                                foreach (self::$tabData[$i] as $tabId => $tabDetails) { ?>
                                    <li class="tab-item-container">
                                        <a class="tab-item" href="<?= isset($tabDetails["path"]) ? $tabDetails["path"] : PageDirectory::getPathOfPage($tabId); ?>" icon="<?= isset($tabDetails["icon"]) ? $tabDetails["icon"] : $tabId; ?>" <?= $activeTab == $tabId ? "active" : ""; ?> <?= isset($tabDetails["newTab"]) && $tabDetails["newTab"] ? "target='_blank'" : ""; ?>>
                                            <?= $tabDetails["title"]; ?>
                                        </a>
                                    </li>
                            <?php }
                                if ($i + 1 < $length) { ?>
                                    <hr class="tab-separator">
                            <?php }
                            }
                        ?>
                    </ul>
                    <ul class="tab-nav-list-container bottom-aligned">
                        <li class="tab-item-container">
                            <a class="tab-item" href="<?= PageDirectory::getPathOfPage("login") . "backend/logout.php"; ?>" icon="logout">
                                Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
    <?php }
    }
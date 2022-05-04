<?php 
    include_once __DIR__."/../config.php";

    class PageDirectory {
        static private $data = [
            "login" => [
                "name" => "Home", 
                "path" => "",
            ],
            "home" => [
                "name" => "Home", 
                "path" => "home",
            ],
            "info" => [
                "name" => "My Information", 
                "path" => "my-information",
            ],
            "academics" => [
                "name" => "Academics", 
                "path" => "academics",
            ],
            "finances" => [
                "name" => "Finances", 
                "path" => "finances",
            ],
            "tasks" => [
                "name" => "Tasks", 
                "path" => "tasks",
            ],
            "settings" => [
                "name" => "Settings", 
                "path" => "settings",
            ],
        ];

        static function getPathOfPage($pageName) {
            global $_ROOTPATH;
            $path = self::$data[$pageName]["path"];

            return $_ROOTPATH . $path;
        }
    }
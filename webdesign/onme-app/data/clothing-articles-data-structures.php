<?php 
    include "clothing-articles.php";

    class ClothingCategory {
        public $name;
        public $articles;
    }

    class ClothingArticle {
        public $id;
        public $category;
        public $gender;
        public $brand;
        public $name;
        public $fit;
        public $description;
        public $price;
        public $fitOffset;
        public $hyperlink;
        public $imagePath;
    }

    $structuredClothingData = [];

    function generateStructuredClothingData() {
        global $clothingData;
        global $structuredClothingData;

        foreach ($clothingData as $clothingCategory => $clothingCategoryData) {
            $tempCategory = new ClothingCategory();

            $tempCategory -> name = $clothingCategory;
            $tempCategory -> articles = [];

            foreach ($clothingCategoryData as $gender => $articlesForGender) {
                for ($article = 0, $numArticles = sizeof($articlesForGender); $article < $numArticles; $article++) {
                    $tempArticle = new ClothingArticle();
    
                    $tempArticle -> id = strval($articlesForGender[$article]["id"]);
                    $tempArticle -> category = ucfirst($clothingCategory);
                    $tempArticle -> gender = ucfirst($gender);
                    $tempArticle -> brand = $articlesForGender[$article]["brand"];
                    $tempArticle -> name = $articlesForGender[$article]["name"];
                    $tempArticle -> fit = $articlesForGender[$article]["fit"];
                    $tempArticle -> description = $articlesForGender[$article]["description"];
                    $tempArticle -> price = $articlesForGender[$article]["price"];
                    $tempArticle -> fitOffset = $articlesForGender[$article]["fitOffset"];
                    $tempArticle -> hyperlink = $articlesForGender[$article]["hyperlink"];

                    $imagePath = $gender."/".$tempArticle -> id.".png";
                    $tempArticle -> imagePath = file_exists("assets/images/clothing/".$imagePath) ? $imagePath : "placeholder.png";
    
                    array_push($tempCategory -> articles, $tempArticle);
                }
            }
        
            array_push($structuredClothingData, $tempCategory);
        }
    }

    generateStructuredClothingData();
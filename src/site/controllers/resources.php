<?php

    class Resources extends Route {

        private static function getCategory() {

            $path = preg_split(('/\/(resources)/'), REQUEST);
            $category = rtrim($path[1], "/");

            return $category;

        }

        public static function file_pattern_1() {

            $file_rel = self::getCategory() . ".html.twig";

            $file_abs = SITE_ROOT . DIR['content'] . "resources/categories" . $file_rel;

            return $file_abs;

        }

        public static function file_pattern_2() {

            $file_rel = self::getCategory() . "/index.html.twig";

            $file_abs = SITE_ROOT . DIR['content'] . "resources/categories" . $file_rel;

            return $file_abs;

        }

    }

    Route::execute('resources.php');

    switch (REQUEST) {

        case "/resources/":
        case "/resources/index/":
            
            new Site\Views\Layouts\ResourcesIndex();
            break;

        case str_starts_with(REQUEST, "/resources/") && file_exists(Resources::file_pattern_1()):

            new Site\Views\Layouts\ResourcesSubpage();
            break;

        case str_starts_with(REQUEST, "/resources/") && file_exists(Resources::file_pattern_2()):

            new Site\Views\Layouts\ResourcesSubpage();
            break;

        default:

            Route::NotFound();

    }

?>
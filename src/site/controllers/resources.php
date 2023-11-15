<?php

    class Resources extends Route {

        private static function getCategory() {

            $path = preg_split(('/\/(resources)/'), REQUEST);
            $category = rtrim($path[1], "/");

            return $category;

        }

        public static function matchIndexPattern($use_index = false) {

            if ($use_index == true) {

                $file_rel = self::getCategory() . "/index.html.twig";

            } else {

                $file_rel = self::getCategory() . ".html.twig";

            }

            $file_abs = SITE_ROOT . DIR['content'] . "resources/categories" . $file_rel;

            return $file_abs;

        }

    }

    Route::loadLayoutClasses('resources.php');

    switch (REQUEST) {

        case "/resources/":
        case "/resources/index/":
            
            new Site\Views\Layouts\ResourcesIndex();
            break;

        case str_starts_with(REQUEST, "/resources/") && file_exists(Resources::matchIndexPattern(false)):

            new Site\Views\Layouts\ResourcesSubpage();
            break;

        case str_starts_with(REQUEST, "/resources/") && file_exists(Resources::matchIndexPattern(true)):

            new Site\Views\Layouts\ResourcesSubpage();
            break;

        default:

            Route::NotFound();

    }

?>
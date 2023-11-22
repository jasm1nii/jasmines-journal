<?php

    use JasminesJournal\Core\Route as Route;
    use JasminesJournal\Site\Views\Layouts as Layouts;


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

    switch (REQUEST) {

        case "/resources":
        case "/resources/index":
            
            new Layouts\ResourcesIndex();
            break;

        case str_starts_with(REQUEST, "/resources"):
            
            switch (REQUEST) {
                
                case file_exists(Resources::matchIndexPattern(false)):
                case file_exists(Resources::matchIndexPattern(true)):

                    new Layouts\ResourcesSubpage();
                    break;

                default: 

                    Route::NotFound();

            }

            break;

        default:

            Route::NotFound();

    }

?>
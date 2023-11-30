<?php

    namespace JasminesJournal\Site\FileRouter;

    use JasminesJournal\Core\Route as Route;

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

?>
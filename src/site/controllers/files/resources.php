<?php

    namespace JasminesJournal\Site\FileRouter;

    use JasminesJournal\Core\Route;

    final class Resources extends Route {

        final public static function getCategory(): ?string {

            $path = preg_split(('/\/(resources)/'), REQUEST);
            
            return rtrim($path[1], "/");

        }

        final public static function getParentURL(): ?string {

            $url = preg_split('/\//', REQUEST);

            if (!empty($url[3])) {

                return '/' . $url[1] . '/' . $url[2];

            } else {
                    
                return null;
            }

        }

        final public static function matchIndexPattern(bool $use_index = false): ?string {

            if ($use_index == true) {

                $file_rel = self::getCategory() . "/index.html.twig";

            } else {

                $file_rel = self::getCategory() . ".html.twig";

            }

            return SITE_ROOT . DIR['content'] . "resources/categories" . $file_rel;

        }

    }

?>
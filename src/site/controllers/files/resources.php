<?php

    namespace JasminesJournal\Site\FileRouter;

    use JasminesJournal\Core\Controller\Route;

    final class Resources extends Route {

        final public static function getCategory(): ?string {

            $path = preg_split(('/\/(resources)/'), REQUEST);
            
            return rtrim($path[1], "/");

        }

        final public static function getParentURL(): ?string {

            $url = preg_split('/\//', REQUEST);

            array_pop($url);

            return implode("/", $url);

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
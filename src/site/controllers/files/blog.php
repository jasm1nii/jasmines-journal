<?php

    namespace JasminesJournal\Site\FileRouter;

    use JasminesJournal\Core\Route;

    class BlogEntry extends Route {

        public static function matchQuery() {

            $query = '/(blog)\/((articles)|(notes))\/(\d){4}\/(\d+)\/(\d){2}\/(entry)/';
            
            return parent::matchURL($query);

        }

        public static function file($use_root = true) {

            $path = DIR['content'] . self::matchQuery() . ".html.twig";

            if ($use_root == true) {

                return SITE_ROOT . $path;

            } else {

                return $path;

            }

        }

        public static function mapMedia() {

            return '/_assets/media' . rtrim(parent::useCleanSlug(), '/entry') . '/';

        }

    }

?>
<?php

    namespace JasminesJournal\Site\FileRouter;

    use JasminesJournal\Core\Route as Route;

    class BlogEntry extends Route {

        public static function matchQuery() {

            $query = '/(blog)\/((articles)|(notes))\/(\d){4}\/(\d+)\/(\d){2}\/(entry)/';
            
            return parent::matchURL($query);

        }

        public static function file() {

            $file = SITE_ROOT . DIR['content'] . self::matchQuery() . ".html.twig";

            return $file;

        }

    }

?>
<?php

    namespace JasminesJournal\Site\FileRouter;

    use JasminesJournal\Core\Route as Route;

    class ChangelogSubpage extends Route {

        public static function matchQuery() {

            $query = '/(changelog)\/(\d\d\d\d)\/(\d+)/';

            return parent::matchURL($query);

        }

        public static function file() {

            $file = SITE_ROOT . DIR['content'] . self::matchQuery() . ".html.twig";
            
            return $file;

        }

    }

?>
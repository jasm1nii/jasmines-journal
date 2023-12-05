<?php

    namespace JasminesJournal\Site\FileRouter;

    use JasminesJournal\Core\Route;

    class ChangelogSubpage extends Route {

        public static function matchQuery(): ?string {

            $query = '/(changelog)\/(\d\d\d\d)\/(\d+)/';

            return parent::matchURL($query);

        }

        public static function file(): ?string {

            return SITE_ROOT . DIR['content'] . self::matchQuery() . ".html.twig";

        }

    }

?>
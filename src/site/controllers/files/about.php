<?php

    namespace JasminesJournal\Site\FileRouter;

    use JasminesJournal\Core\Route;

    final class ChangelogSubpage extends Route {

        final public static function matchQuery(): ?string {

            $query = '/(changelog)\/(\d\d\d\d)\/(\d+)/';

            return parent::matchURL($query);

        }

        final public static function file(): ?string {

            return SITE_ROOT . DIR['content'] . self::matchQuery() . ".html.twig";

        }

    }

?>
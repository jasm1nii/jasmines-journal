<?php

    namespace JasminesJournal\Site\FileRouter;

    use JasminesJournal\Core\Route;

    class BlogEntry extends Route {

        public static function matchQuery(): ?string {

            $query = '/(blog)\/((articles)|(notes))\/(\d){4}\/(\d+)\/(\d){2}\/(entry)/';
            
            return parent::matchURL($query);

        }

        public static function file(bool $use_root = true): ?string {

            $path = DIR['content'] . self::matchQuery() . ".html.twig";

            if ($use_root == true) {

                return SITE_ROOT . $path;

            } else {

                return $path;

            }

        }

        public static function getFiles(string $source): ?array {

            $files = glob($source . "/*/{12,11,10,9,8,7,6,5,4,3,2,1}/{3,2,1,0}{9,8,7,6,5,4,3,2,1,0}/entry.html.twig", GLOB_BRACE);

            rsort($files, SORT_NATURAL);

            return $files;

        }

        public static function mapMedia(): ?string {

            return '/_assets/media' . rtrim(parent::useCleanSlug(), '/entry') . '/';

        }

    }

?>
<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Controller\Route;
    use JasminesJournal\Site\FileRouter;
    use JasminesJournal\Site\Views\Layouts;

    final class Resources extends Route {

        private static function matchCategoryPage(): void {

            match (true) {

                file_exists(FileRouter\Resources::matchIndexPattern(false)),
                file_exists(FileRouter\Resources::matchIndexPattern(true))

                    => new Layouts\ResourcesSubpage(),

                default
                
                    => parent::notFound()

            };

        }

        final public static function dispatch(): void {

            match (true) {

                REQUEST == "/resources",
                REQUEST == "/resources/index"

                    => new Layouts\ResourcesIndex(),

                
                REQUEST == "/resources/webdev/code-templates-tools"

                    => parent::redirect("/resources/webdev/libraries"),


                REQUEST == "/resources/webdev/site-comments"

                    => parent::redirect("/resources/webdev/libraries/site-comments"),


                str_starts_with(REQUEST, "/resources")

                    => self::matchCategoryPage(),


                default

                    => parent::notFound()

            };

        }

    }
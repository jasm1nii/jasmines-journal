<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Site\FileRouter;
    use JasminesJournal\Site\Views\Layouts;

    class Resources {

        private static function matchSubpage() {

            match (true) {

                file_exists(FileRouter\Resources::matchIndexPattern(false)),
                file_exists(FileRouter\Resources::matchIndexPattern(true))

                    => new Layouts\ResourcesSubpage(),


                default
                
                    => Route::notFound()

            };

        }

        public static function dispatch() {

            match (true) {

                REQUEST == "/resources",
                REQUEST == "/resources/index"

                    => new Layouts\ResourcesIndex(),


                str_starts_with(REQUEST, "/resources")

                    => self::matchSubpage(),


                default

                    => Route::notFound()

            };

        }

    }

?>
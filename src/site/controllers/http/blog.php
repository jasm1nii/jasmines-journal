<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Site\FileRouter\BlogEntry;
    use JasminesJournal\Site\Views\Layouts;

    class Blog {

        private static function subpage() {

            return Route::matchSubpage(2);

        }

        public static function dispatch() {

            match (true) {

                REQUEST == "/blog",
                REQUEST == "/blog/index",

                    => new Layouts\BlogIndex(),


                str_ends_with(REQUEST, self::subpage()),
                str_ends_with(REQUEST, self::subpage() . "/index"),

                    => new Layouts\BlogSubpageIndex(self::subpage()),


                str_contains(REQUEST, self::subpage()) && file_exists(BlogEntry::file())

                    => new Layouts\BlogEntry(self::subpage()),


                str_ends_with(REQUEST, ".xml")

                    => Route::redirect("/" . self::subpage() . ".xml"),


                default
                
                    => Route::notFound()

            };

        }

    }

?>
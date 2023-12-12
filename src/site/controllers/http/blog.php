<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Site\FileRouter\BlogEntry;
    use JasminesJournal\Site\Views\Layouts;

    final class Blog extends Route {

        private static function subpage(): ?string {

            return parent::matchSubpage(2);

        }

        final public static function dispatch(): void {

            match (true) {

                REQUEST == "/blog",
                REQUEST == "/blog/index"

                    => new Layouts\BlogIndex,


                str_ends_with(REQUEST, self::subpage()),
                str_ends_with(REQUEST, self::subpage() . "/index"),
                str_contains(REQUEST, "/notes/page")

                    => new Layouts\BlogSubpageIndex(self::subpage()),


                str_contains(REQUEST, self::subpage()) && file_exists(BlogEntry::matchURLToFile())

                    => new Layouts\BlogEntry(self::subpage()),


                str_ends_with(REQUEST, ".xml")

                    => parent::redirect("/" . self::subpage() . ".xml"),


                default
                
                    => parent::notFound()

            };

        }

    }

?>
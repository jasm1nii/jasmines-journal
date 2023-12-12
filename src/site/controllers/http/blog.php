<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Site\FileRouter\BlogEntry;
    use JasminesJournal\Site\Views\Layouts;

    final class Blog extends Route {

        private static function subpage(): ?string {

            return parent::matchSubpage(2);

        }

        private static function getCurrentPage(): int {

            preg_match('/[0-9]+/', REQUEST, $page_num);
            return $page_num ? $page_num[0] : 1;

        }

        final public static function dispatch(): void {

            match (true) {

                REQUEST == "/blog",
                REQUEST == "/blog/index"

                    => new Layouts\BlogIndex,


                str_ends_with(REQUEST, self::subpage()),
                str_ends_with(REQUEST, self::subpage() . "/index"),
                str_contains(REQUEST, self::subpage() . "/page")

                    => new Layouts\BlogSubpageIndex(
                        type: self::subpage(),
                        current_page: self::getCurrentPage()
                    ),


                str_contains(REQUEST, self::subpage()) && file_exists(BlogEntry::matchURLToFile())

                    => new Layouts\BlogEntry(self::subpage()),


                str_ends_with(REQUEST, ".xml")

                    => parent::redirect("/" . self::subpage() . ".xml"),


                default
                
                    => parent::notFound()

            };

        }

    }
<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Controller\Route;
    use JasminesJournal\Site\Views\Layouts;
    use JasminesJournal\Site\FileRouter\BlogEntry;

    final class Blog extends Route {

        private static function subpage(): ?string {

            return parent::matchSubpage(2);

        }

        private static function getCurrentPage(): int {

            try {

                $page = @preg_split('/\/(page)\//', REQUEST)[1];
                @preg_match('/[0-9]+/', $page, $page_num);
                return $page_num ? $page_num[0] : 1;
            
            } catch (\Exception) {

                return 1;
            
            }

        }

        private static function routeSubpageIndex(
            ?string $sort_tag = null
        ): void {

            new Layouts\BlogSubpageIndex(
                type: self::subpage(),
                current_page: self::getCurrentPage(),
                sort_tag: $sort_tag
            );

        }

        final public static function dispatch(): void {

            match (true) {

                // because URLs for feeds have changed multiple times lol
                
                str_ends_with(REQUEST, "blog.atom")

                    => parent::redirect("/blog.xml"),


                str_ends_with(REQUEST, ".xml")

                    => parent::redirect("/" . self::subpage() . ".xml"),


                REQUEST == "/blog",
                REQUEST == "/blog/index"

                    => new Layouts\BlogIndex,


                str_ends_with(REQUEST, self::subpage()),
                str_ends_with(REQUEST, self::subpage() . "/index"),
                str_contains(REQUEST, self::subpage() . "/page")

                    => self::routeSubpageIndex(),


                str_contains(REQUEST, self::subpage() . "/tag")
                && !empty(parent::matchSubpage(4))

                    => self::routeSubpageIndex(
                        sort_tag: parent::matchSubpage(4)
                    ),


                str_contains(REQUEST, self::subpage())
                && file_exists(BlogEntry::matchURLToFile())

                    => new Layouts\BlogEntry(self::subpage()),


                default
                
                    => parent::notFound()

            };

        }

    }
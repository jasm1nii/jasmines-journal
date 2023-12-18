<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;

    use JasminesJournal\Site\Views\Layouts;
    use JasminesJournal\Site\FileRouter\BlogEntry;

    use JasminesJournal\Site\Models\ArticlesDatabase;
    use JasminesJournal\Site\Models\NotesDatabase;

    final class Blog extends Route {

        private static function subpage(): ?string {

            return parent::matchSubpage(2);

        }

        private static function getCurrentPage(): int {

            preg_match('/[0-9]+/', REQUEST, $page_num);
            return $page_num ? $page_num[0] : 1;

        }

        private static function routeSubpageIndex(
            bool $validate_db = false,
            ?string $sort_tag = null
        ): void {

            if ($validate_db) {

                $db = match (self::subpage()) {
                    'articles'  => new ArticlesDatabase,
                    'notes'     => new NotesDatabase
                };
                
                $db->validateNewestEntry();

            }

            new Layouts\BlogSubpageIndex(
                type: self::subpage(),
                current_page: self::getCurrentPage(),
                sort_tag: $sort_tag
            );

        }

        final public static function dispatch(): void {

            match (true) {

                REQUEST == "/blog",
                REQUEST == "/blog/index"

                    => new Layouts\BlogIndex,


                str_ends_with(REQUEST, self::subpage()),
                str_ends_with(REQUEST, self::subpage() . "/index")

                    => self::routeSubpageIndex(
                        validate_db: true
                    ),


                str_contains(REQUEST, self::subpage() . "/page")

                    => self::routeSubpageIndex(
                        validate_db: false
                    ),


                str_contains(REQUEST, self::subpage() . "/tag")
                && !empty(parent::matchSubpage(4))

                    => self::routeSubpageIndex(
                        validate_db: false,
                        sort_tag: parent::matchSubpage(4)
                    ),


                str_contains(REQUEST, self::subpage())
                && file_exists(BlogEntry::matchURLToFile())

                    => new Layouts\BlogEntry(self::subpage()),


                str_ends_with(REQUEST, ".xml")

                    => parent::redirect("/" . self::subpage() . ".xml"),


                default
                
                    => parent::notFound()

            };

        }

    }
<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Site\FileRouter\ChangelogSubpage;
    use JasminesJournal\Site\Views\Layouts;

    final class About extends Route {

        final public static function dispatch(): void {

            match (true) {

                REQUEST == "/about",
                REQUEST == "/about/index"

                    => new Layouts\AboutIndex(),


                str_ends_with(REQUEST, "/changelog"),
                str_ends_with(REQUEST, "/changelog/index")

                    => new Layouts\ChangelogIndex(),


                str_contains(REQUEST, ChangelogSubpage::matchQuery()) && file_exists(ChangelogSubpage::file())

                    => new Layouts\ChangelogSubpage(),
                

                default
                
                    => parent::notFound()

            };

        }

    }

?>
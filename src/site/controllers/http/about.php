<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Site\FileRouter\ChangelogSubpage;
    use JasminesJournal\Site\Views\Layouts;

    class About {

        public static function dispatch() {

            switch (REQUEST) {

                case "/about":
                case "/about/":
                case "/about/index":
        
                    new Layouts\AboutIndex();
                    break;
        
                case "/about/changelog":
                case "/about/changelog/":
                case "/about/changelog/index":
        
                    new Layouts\ChangelogIndex();
                    break;
        
                case str_contains(REQUEST, ChangelogSubpage::matchQuery()) && file_exists(ChangelogSubpage::file()):
        
                    new Layouts\ChangelogSubpage();
                    break;
                        
                default:
        
                    Route::notFound();
                    
            }

        }

    }

?>
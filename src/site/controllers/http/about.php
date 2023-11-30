<?php

    namespace JasminesJournal\Site\Request;

    use JasminesJournal\Core\Route as Route;
    use JasminesJournal\Site\FileRouter\ChangelogSubpage as ChangelogSubpage;
    use JasminesJournal\Site\Views\Layouts as Layouts;

    trait About {

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
        
                    Route::NotFound();
                    
            }

        }

    }

?>
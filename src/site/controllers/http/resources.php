<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Site\FileRouter;
    use JasminesJournal\Site\Views\Layouts;

    class Resources {

        public static function dispatch() {

            switch (REQUEST) {

                case "/resources":
                case "/resources/index":
                    
                    new Layouts\ResourcesIndex();
                    break;
        
                case str_starts_with(REQUEST, "/resources"):
                    
                    switch (true) {
                        
                        case file_exists(FileRouter\Resources::matchIndexPattern(false)):
                        case file_exists(FileRouter\Resources::matchIndexPattern(true)):
        
                            new Layouts\ResourcesSubpage();
                            break;
        
                        default: 
        
                            Route::notFound();
        
                    }
        
                    break;
        
                default:
        
                    Route::notFound();
        
            }

        }

    }

?>
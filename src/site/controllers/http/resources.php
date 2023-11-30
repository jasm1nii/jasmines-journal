<?php

    namespace JasminesJournal\Site\Request;

    use JasminesJournal\Core\Route as Route;
    use JasminesJournal\Site\FileRouter as FileRouter;
    use JasminesJournal\Site\Views\Layouts as Layouts;

    trait Resources {

        public static function dispatch() {

            switch (REQUEST) {

                case "/resources":
                case "/resources/index":
                    
                    new Layouts\ResourcesIndex();
                    break;
        
                case str_starts_with(REQUEST, "/resources"):
                    
                    switch (REQUEST) {
                        
                        case file_exists(FileRouter\Resources::matchIndexPattern(false)):
                        case file_exists(FileRouter\Resources::matchIndexPattern(true)):
        
                            new Layouts\ResourcesSubpage();
                            break;
        
                        default: 
        
                            Route::NotFound();
        
                    }
        
                    break;
        
                default:
        
                    Route::NotFound();
        
            }

        }

    }

?>
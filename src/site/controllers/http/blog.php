<?php

    namespace JasminesJournal\Site\Request;

    use JasminesJournal\Core\Route as Route;
    use JasminesJournal\Site\FileRouter\BlogEntry as BlogEntry;
    use JasminesJournal\Site\Views\Layouts as Layouts;

    trait Blog {

        public static function dispatch() {

            switch (REQUEST) {

                case "/blog":
                case "/blog/":
                case "/blog/index/":
                    
                    new Layouts\BlogIndex();
                    break;
        
                case str_contains(REQUEST, "articles"):
        
                    switch (REQUEST) {
        
                        case "/blog/articles":
                        case "/blog/articles/":
                        case "/blog/articles/index":
        
                            new Layouts\ArticlesIndex();
        
                            break;
        
        
                        case str_contains(REQUEST, BlogEntry::matchQuery()) && file_exists(BlogEntry::file()):
        
                            new Layouts\BlogEntry('article');
        
                            break;
        
        
                        case "/blog/articles/articles.xml":
        
                            http_response_code(301);
                            header('Location: /articles.xml');
        
                            break;
        
        
                        default:
        
                            Route::NotFound();
        
                    }
        
                    break;
        
                case str_contains(REQUEST, "notes"):
        
                    switch (REQUEST) {
        
                        case "/blog/notes":
                        case "/blog/notes/":
                        case "/blog/notes/index":
        
                            new Layouts\NotesIndex();
        
                            break;
        
        
                        case str_contains(REQUEST, BlogEntry::matchQuery()) && file_exists(BlogEntry::file()):
        
                            new Layouts\BlogEntry('note');
        
                            break;
        
        
                        case "/blog/notes/notes.xml":
        
                            http_response_code(301);
                            header('Location: /notes.xml');
        
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
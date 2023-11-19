<?php

    use JasminesJournal\Core\Route as Route;
    use JasminesJournal\Site\Views\Layouts as Layouts;
    

    class BlogEntry extends Route {

        public static function matchQuery() {

            $query = '/(blog)\/((articles)|(notes))\/(\d){4}\/(\d+)\/(\d){2}\/(entry)/';
            
            return parent::matchURL($query);

        }

        public static function file() {

            $file = SITE_ROOT . DIR['content'] . self::matchQuery() . ".html.twig";

            return $file;

        }

    }
    
    switch (REQUEST) {

        case "/blog/":
        case "/blog/index/":
            
            new Layouts\BlogIndex();
            break;

        

        case str_contains(REQUEST, "/articles/"):

            switch (REQUEST) {

                case "/blog/articles/":
                case "/blog/articles/index/":

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

        case str_contains(REQUEST, "/notes/"):

            switch (REQUEST) {

                case "/blog/notes/":
                case "/blog/notes/index/":

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

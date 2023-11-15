<?php

    Route::loadLayoutClasses('blog/blog.php');

    class BlogEntry extends Route {

        public static function matchURL() {

            $query = '/(blog)\/((articles)|(notes))\/(\d){4}\/(\d+)\/(\d){2}\/(entry)/';
            
            preg_match($query, REQUEST, $matches);

            if (!isset($matches[0])) {

                $matches[0] = 0;

            }

            return $matches[0];

        }

        public static function file() {

            $file = SITE_ROOT . DIR['content'] . self::matchURL() . ".html.twig";

            return $file;

        }

    }
    
    switch (REQUEST) {

        case "/blog/":
        case "/blog/index/":
            
            new Site\Views\Layouts\BlogIndex();
            break;

        case str_contains(REQUEST, "/articles/"):

            switch (REQUEST) {

                case "/blog/articles/":
                case "/blog/articles/index/":

                    new Site\Views\Layouts\ArticlesIndex();
                    break;

                case str_contains(REQUEST, BlogEntry::matchURL()) && file_exists(BlogEntry::file()):

                    new Site\Views\Layouts\BlogEntry('article');
                    break;

                case str_ends_with(REQUEST, ".xml"):

                    require $_SERVER['DOCUMENT_ROOT'] . "/articles.xml";
                    break;

                default:

                    Route::NotFound();

            }

            break;

        case str_contains(REQUEST, "/notes/"):

            switch (REQUEST) {

                case "/blog/notes/":
                case "/blog/notes/index/":

                    new Site\Views\Layouts\NotesIndex();
                    break;

                case str_contains(REQUEST, BlogEntry::matchURL()) && file_exists(BlogEntry::file()):

                    new Site\Views\Layouts\BlogEntry('note');
                    break;

                case str_ends_with(REQUEST, ".xml"):

                    require $_SERVER['DOCUMENT_ROOT'] . "/notes.xml";
                    break;

                default:

                    Route::NotFound();

            }

            break;

        default:

            Route::NotFound();

}

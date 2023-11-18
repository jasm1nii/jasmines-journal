<?php

    Route::loadLayoutClasses('blog/blog.php');

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
            
            new JasminesJournal\Site\Views\Layouts\BlogIndex();
            break;

        case str_contains(REQUEST, "/articles/"):

            switch (REQUEST) {

                case "/blog/articles/":
                case "/blog/articles/index/":

                    new JasminesJournal\Site\Views\Layouts\ArticlesIndex();
                    break;

                case str_contains(REQUEST, BlogEntry::matchQuery()) && file_exists(BlogEntry::file()):

                    new JasminesJournal\Site\Views\Layouts\BlogEntry('article');
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

                    new JasminesJournal\Site\Views\Layouts\NotesIndex();
                    break;

                case str_contains(REQUEST, BlogEntry::matchQuery()) && file_exists(BlogEntry::file()):

                    new JasminesJournal\Site\Views\Layouts\BlogEntry('note');
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

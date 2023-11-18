<?php

    use JasminesJournal\Core\Route as Route;
    use JasminesJournal\Site\Views\Layouts as Layouts;

    Route::loadLayoutClasses('about/about.php');

    switch (REQUEST) {

        case "/about/":
        case "/about/index/":

            new Layouts\AboutIndex();

            break;

        case str_contains(REQUEST, "/changelog/"):

            class ChangelogSubpage extends Route {

                public static function matchQuery() {

                    $query = '/(changelog)\/(\d\d\d\d)\/(\d+)/';

                    return parent::matchURL($query);

                }

                public static function file() {

                    $file = SITE_ROOT . DIR['content'] . self::matchQuery() . ".html.twig";

                    return $file;

                }

            }

            switch (REQUEST) {

                case "/about/changelog/":
                case "/about/changelog/index/":

                    new Layouts\ChangelogIndex();
                    break;


                case str_contains(REQUEST, ChangelogSubpage::matchQuery()) && file_exists(ChangelogSubpage::file()):

                    new Layouts\ChangelogSubpage();
                    break;
                    
                    
                default:

                    Route::NotFound();

            }

            break;

        default:

            Route::NotFound();
            
    }

?>
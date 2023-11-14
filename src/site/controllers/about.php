<?php

    switch (REQUEST) {

        case "/about/":
        case "/about/index/":

            Route::execute('about.php');

            new Site\Views\Layouts\AboutIndex();

            break;

        case str_contains(REQUEST, "/changelog/"):

            class ChangelogSubpage extends Route {

                public static function matchURL() {

                    preg_match('/(changelog)\/(\d\d\d\d)\/(\d+)/', REQUEST, $matches);

                    return $matches[0];

                }

                public static function file() {

                    $file = SITE_ROOT . DIR['content'] . self::matchURL() . ".html.twig";

                    return $file;

                }

            }

            switch (REQUEST) {

                case "/about/changelog/":
                case "/about/changelog/index/":

                    Route::execute('about.php');

                    new Site\Views\Layouts\ChangelogIndex();

                    break;

                case str_contains(REQUEST, ChangelogSubpage::matchURL()) && file_exists(ChangelogSubpage::file()):

                    Route::execute('about.php');

                    new Site\Views\Layouts\ChangelogSubpage();

                    break;
                    
                default:

                    Route::NotFound();

            }

            break;

        default:

            Route::NotFound();
            
    }

?>
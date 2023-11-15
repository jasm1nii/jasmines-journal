<?php

    Route::loadLayoutClasses('about.php');

    switch (REQUEST) {

        case "/about/":
        case "/about/index/":

            new Site\Views\Layouts\AboutIndex();

            break;

        case str_contains(REQUEST, "/changelog/"):

            class ChangelogSubpage extends Route {

                public static function matchURL() {

                    $query = '/(changelog)\/(\d\d\d\d)\/(\d+)/';

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

                case "/about/changelog/":
                case "/about/changelog/index/":

                    new Site\Views\Layouts\ChangelogIndex();

                    break;

                case str_contains(REQUEST, ChangelogSubpage::matchURL()) && file_exists(ChangelogSubpage::file()):

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
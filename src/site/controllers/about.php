<?php

    switch (REQUEST) {

        case "/about/":
        case "/about/index/":

            new AboutIndex();

            break;

        case str_starts_with(REQUEST, "/about/changelog/"):

            Route::execute('changelog/changelog.php');

            break;
    
    }

?>
<?php

    Route::loadLayoutClasses('feeds.php');

    switch (REQUEST) {

        case "/feeds/":
        case "/feeds/index/":

            new Site\Views\Layouts\FeedsIndex();

            break;


        case str_contains(REQUEST, "success"):

            new Site\Views\Layouts\FeedsPOST('success');

            break;


        case str_contains(REQUEST, "error"):

            new Site\Views\Layouts\FeedsPOST('error');

            break;
            

        default:

            Route::NotFound();

    }

?>
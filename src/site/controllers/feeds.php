<?php

    Route::loadLayoutClasses('feeds.php');

    switch (REQUEST) {

        case isset($_SERVER['HTTP_REFERER']):

            switch (REQUEST) {

                case str_contains(REQUEST, "success"):

                    new Site\Views\Layouts\FeedsPOST('success');
                    break;


                case str_contains(REQUEST, "error"):

                    new Site\Views\Layouts\FeedsPOST('error');
                    break;
                    
            }

            break;

        case !isset($_SERVER['HTTP_REFERER']):

            switch (REQUEST) {

                case REQUEST !== "/feeds/":

                    header('Location: /feeds');
                    new Site\Views\Layouts\FeedsIndex();
                    break;

            }


        default:

            new Site\Views\Layouts\FeedsIndex();
            

    }

?>
<?php

    Route::loadLayoutClasses('feeds.php');

    switch (REQUEST) {

        case isset($_SERVER['HTTP_REFERER']):

            switch (REQUEST) {

                case str_contains(REQUEST, "success"):

                    new JasminesJournal\Site\Views\Layouts\FeedsPOST('success');
                    break;


                case str_contains(REQUEST, "error"):

                    new JasminesJournal\Site\Views\Layouts\FeedsPOST('error');
                    break;
                    

                default:

                    new JasminesJournal\Site\Views\Layouts\FeedsIndex();
                    
            }

            break;

        case !isset($_SERVER['HTTP_REFERER']) && REQUEST !== "/feeds/":

            header('Location: /feeds');
            new JasminesJournal\Site\Views\Layouts\FeedsIndex();
            break;


        default:

            new JasminesJournal\Site\Views\Layouts\FeedsIndex();
            

    }

?>
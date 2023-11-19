<?php

    use JasminesJournal\Core\Route as Route;
    use JasminesJournal\Site\Views\Layouts as Layouts;


    switch (REQUEST) {

        case isset($_SERVER['HTTP_REFERER']):

            switch (REQUEST) {

                case str_contains(REQUEST, "success"):

                    new Layouts\FeedsPOST('success');
                    break;


                case str_contains(REQUEST, "error"):

                    new Layouts\FeedsPOST('error');
                    break;
                    

                default:

                    new Layouts\FeedsIndex();
                    
            }

            break;

        case !isset($_SERVER['HTTP_REFERER']) && REQUEST !== "/feeds/":

            header('Location: /feeds');
            new Layouts\FeedsIndex();
            break;


        default:

            new Layouts\FeedsIndex();
            

    }

?>
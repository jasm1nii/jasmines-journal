<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Site\Views\Layouts;

    class Feeds {

        public static function dispatch() {

            switch (true) {

                case isset($_SERVER['HTTP_REFERER']):

                    match (true) {

                        str_contains(REQUEST, "success")
                            => new Layouts\FeedsPOST('success'),

                        str_contains(REQUEST, "error")
                            => new Layouts\FeedsPOST('error'),

                        default
                            => new Layouts\FeedsIndex()

                    };
        
                    break;
        
                case !isset($_SERVER['HTTP_REFERER']) && REQUEST !== "/feeds":
        
                    header('Location: /feeds');
                    new Layouts\FeedsIndex();
                    
                    break;
        
        
                default:
        
                    new Layouts\FeedsIndex();
        
            }

        }

    }

?>
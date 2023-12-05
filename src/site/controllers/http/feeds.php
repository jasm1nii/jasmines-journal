<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Site\Views\Layouts;

    class Feeds {

        private static function redirectPOST(): void {

            match (true) {

                str_contains(REQUEST, "success")

                    => new Layouts\FeedsPOST('success'),

                str_contains(REQUEST, "error")

                    => new Layouts\FeedsPOST('error')

            };

        }

        private static function redirectGET(): void {
            
            new Layouts\FeedsIndex();

        }

        public static function dispatch(): void {

            match (true) {

                REQUEST == "/feeds"

                    => new Layouts\FeedsIndex(),


                isset($_SERVER['HTTP_REFERER'])

                    => self::redirectPOST(),


                !isset($_SERVER['HTTP_REFERER']) && REQUEST !== "/feeds"

                    => header('Location: /feeds'),


                default

                    => header('Location: /feeds')


            };

        }

    }

?>
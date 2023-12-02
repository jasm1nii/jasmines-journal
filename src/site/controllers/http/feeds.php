<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Site\Views\Layouts;

    class Feeds {

        private static function redirectPOST() {

            match (true) {

                str_contains(REQUEST, "success")

                    => new Layouts\FeedsPOST('success'),

                str_contains(REQUEST, "error")

                    => new Layouts\FeedsPOST('error'),

                default

                    => new Layouts\FeedsIndex()

            };

        }

        private static function redirectGET() {

            header('Location: /feeds');
            
            new Layouts\FeedsIndex();

        }

        public static function dispatch() {

            match (true) {

                isset($_SERVER['HTTP_REFERER'])

                    => self::redirectPOST(),

                !isset($_SERVER['HTTP_REFERER']) && REQUEST !== "/feeds"

                    => self::redirectGET(),

                default
                    => new Layouts\FeedsIndex()

            };

        }

    }

?>
<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Site\Views\Layouts;
    use JasminesJournal\Site\Models;

    trait GuestbookGET {

        public static function setPageNumber(): int {

            if (str_starts_with(REQUEST, "/guestbook/page")) {

                return preg_split('/guestbook\/page\//', REQUEST)[1];

            } else {

                return 1;

            }

        }

        public static function buildPage(bool $show_dialog): void {

            $_SESSION['page'] = self::setPageNumber();
            
            new Layouts\Guestbook($show_dialog, self::setPageNumber());

        }

    }

    trait GuestbookPOST {

        public static function timeOffset(): int {

            return $_SERVER['REQUEST_TIME'] - $_POST['timestamp'];

        }

        public static function validateContent(): void {

            if (
                $_POST['message'] == strip_tags($_POST['message'])
                && $_POST['name'] == strip_tags($_POST['name'])
            ) {
                    
                new Models\GuestbookPOST;
                
            } else {

                self::sendHeader('has_html');
    
            }

        }

        public static function sendHeader(string $status): void {

            $url = [
                'status'    => $status,
            ];

            $query = http_build_query($url);
            
            header("Location: /guestbook/{$query}");

        }

    }
    

    class Guestbook extends Route {

        use GuestbookGET, GuestbookPOST;

        private static function routeGET(): void {
            
            match (true) {

                str_ends_with(REQUEST, "/page"),
                str_ends_with(REQUEST, "/comment")

                    => header('Location: /guestbook'),


                str_contains(REQUEST, 'status')

                    => self::buildPage($show_dialog = true),


                REQUEST == "/guestbook",
                str_contains(REQUEST, "/page"),
                str_contains(REQUEST, "/comment"),

                    => self::buildPage($show_dialog = false),

                default

                    => header('Location: /guestbook')

            };
            
        }

        private static function routePOST(): void {

            $_SESSION['guestbook'] = $_SERVER['REQUEST_TIME'];

            self::timeOffset() > 3
                ? self::validateContent()
                : self::sendHeader('time_too_short');

        }

        public static function dispatch(): void {

            session_start();
            
            match ($_SERVER["REQUEST_METHOD"]) {

                "POST"  => self::routePOST(),
                "GET"   => self::routeGET(),
                default => parent::notFound()

            };

        }

    }

?>
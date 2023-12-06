<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Site\Views\Layouts;
    use JasminesJournal\Site\Models;

    abstract class GuestbookGET extends Route {

        private static function setPageNumber(): int {

            if (str_starts_with(REQUEST, "/guestbook/page")) {

                preg_match('/\d+/', REQUEST, $matches);

                return $matches[0];

            } else {

                return 1;

            }

        }

        protected static function buildPage(bool $show_dialog): void {

            $_SESSION['page'] = self::setPageNumber();
            
            new Layouts\Guestbook($show_dialog, self::setPageNumber());

        }

    }

    abstract class GuestbookPOST extends GuestbookGET {

        protected static function timeOffset(): int {

            return $_SERVER['REQUEST_TIME'] - $_POST['timestamp'];

        }

        protected static function validateContent(): void {

            if (
                $_POST['message'] == strip_tags($_POST['message'])
                && $_POST['name'] == strip_tags($_POST['name'])
            ) {
                    
                $post = new Models\GuestbookPOST;
                $post->processInput();
                
            } else {

                self::sendHeader('has_html');
    
            }

        }

        public static function sendHeader(string $status): void {

            $url = [
                'status' => $status,
            ];

            $query = http_build_query($url);
            
            header("Location: /guestbook/{$query}");

        }

    }

    final class Guestbook extends GuestbookPOST {

        private static function routeGET(): void {
            
            match (true) {

                str_ends_with(REQUEST, "/page"),
                str_ends_with(REQUEST, "/comment")

                    => header('Location: /guestbook'),


                str_contains(REQUEST, 'status')

                    => parent::buildPage(show_dialog: true),


                REQUEST == "/guestbook",
                str_contains(REQUEST, "/page"),
                str_contains(REQUEST, "/comment"),

                    => parent::buildPage(show_dialog: false),

                default

                    => header('Location: /guestbook')

            };
            
        }

        private static function routePOST(): void {

            $_SESSION['guestbook'] = $_SERVER['REQUEST_TIME'];

            parent::timeOffset() > 3
                ? parent::validateContent()
                : parent::sendHeader('time_too_short');

        }

        final public static function dispatch(): void {

            session_start();
            
            match ($_SERVER["REQUEST_METHOD"]) {

                "POST"  => self::routePOST(),
                "GET"   => self::routeGET(),
                default => parent::notFound()

            };

        }

    }

?>
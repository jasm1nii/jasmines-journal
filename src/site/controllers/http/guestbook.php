<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Site\Views\Layouts;
    use JasminesJournal\Site\Models;
    

    class Guestbook {

        private static function setPageNumber(): int {

            if (str_starts_with(REQUEST, "/guestbook/page")) {

                $page = preg_split('/guestbook\/page\//', REQUEST)[1];

                return $page;

            } else {

                return 1;

            }

        }

        private static function setPageSession(): void {

            $page = self::setPageNumber();

            $_SESSION['page'] = $page;
    
        }

        private static function buildPage(): void {

            self::setPageSession();
            
            new Layouts\Guestbook(self::setPageNumber());

        }

        private static function routeGET(): void {

            parse_str(REQUEST, $params);
            
            match (true) {

                str_ends_with(REQUEST, "/page"),
                str_ends_with(REQUEST, "/comment")

                    => header('Location: /guestbook'),


                REQUEST == "/guestbook",
                REQUEST == "/guestbook/index",
                str_contains(REQUEST, "/page"),
                str_contains(REQUEST, "/comment"),
                isset($params['id']) && str_contains($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST'])

                    => self::buildPage(),


                default

                    => header('Location: /guestbook')

            };
            
        }

        private static function routePOST(): void {

            $time_offset = $_SERVER['REQUEST_TIME'] - $_POST['timestamp'];

            if (isset($_POST) && $time_offset > 3) {

                if ($_POST['message'] == strip_tags($_POST['message']) && $_POST['name'] == strip_tags($_POST['name'])) {
                    
                    new Models\GuestbookPOST();
                    
                } else {

                    self::sendHeader('has_html');
        
                }
            
            } else {

                self::sendHeader('time_too_short');
        
            }

        }

        public static function sendHeader(string $status): void {

            $url = [
                'status'    => $status,
                'id'        => $_SERVER['REQUEST_TIME']
            ];

            $query = http_build_query($url);

            header("Location: /guestbook/{$query}");

        }

        public static function dispatch(): void {
            
            match ($_SERVER["REQUEST_METHOD"]) {

                "POST"  => self::routePOST(),
                "GET"   => self::routeGET(),
                default => Route::notFound()

            };

        }

    }

?>
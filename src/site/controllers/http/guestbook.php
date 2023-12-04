<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Site\Views\Layouts;
    use JasminesJournal\Site\Models;
    

    class Guestbook {

        private static function setPageNumber() {

            if (str_starts_with(REQUEST, "/guestbook/page")) {

                $page = preg_split('/guestbook\/page\//', REQUEST)[1];

                (!isset($page) || $page == 1) ? $page = 0 : $page;

                return (int) $page;

            } else {

                return (int) 0;

            }

        }

        private static function setPageSession() {

            $page = self::setPageNumber();

            if ($page !== 0) {

                $_SESSION['page'] = $page;
        
            } else {

                $_SESSION['page'] = 1;

            }

        }

        private static function buildPage() {

            self::setPageSession();
            
            new Layouts\Guestbook(self::setPageNumber());

        }

        private static function routeGET() {

            parse_str(REQUEST, $params);
            
            match (true) {

                str_ends_with(REQUEST, "/page"),
                str_ends_with(REQUEST, "/comment")

                    => header('Location: /guestbook'),


                REQUEST == "/guestbook",
                REQUEST == "/guestbook/index",
                str_contains(REQUEST, "/page"),
                str_contains(REQUEST, "/comment"),
                isset($params['id'])

                    => self::buildPage(),


                default

                    => header('Location: /guestbook')

            };
            
        }

        private static function routePOST() {

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

        public static function sendHeader(string $status) {

            $url = [
                'status'    => $status,
                'id'        => $_SERVER['REQUEST_TIME']
            ];

            $query = http_build_query($url);

            header("Location: /guestbook/{$query}");

        }

        public static function dispatch() {
            
            match ($_SERVER["REQUEST_METHOD"]) {

                "POST"  => self::routePOST(),
                "GET"   => self::routeGET(),
                default => Route::notFound()

            };

        }

    }

?>
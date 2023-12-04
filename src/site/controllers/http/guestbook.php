<?php

    namespace JasminesJournal\Site\RequestRouter;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Site\Views\Layouts;
    use JasminesJournal\Site\Models;
    

    class Guestbook {

        private static function setPageNumber() {

            if (str_starts_with(REQUEST, "/guestbook/page")) {

                $page_req = preg_split('/guestbook\/page/', REQUEST);

                $page = trim($page_req[1], "/");

                (!isset($page) || $page == 1) ? $page = 0 : $page;

                return (int) $page;

            }

        }

        private static function setPageSession() {

            $page = self::setPageNumber();

            if (REQUEST == "/guestbook" || REQUEST == "/guestbook/page/1") {

                $_SESSION['page'] = 1;
        
            } elseif (REQUEST == "/guestbook/page/" . $page) {

                $page !== 0 ? $_SESSION['page'] = $page : $_SESSION['page'] = 1;

            }

            $_SESSION['page'] ??= 1;

        }

        private static function buildPage() {

            self::setPageSession();
            
            new Layouts\Guestbook(self::setPageNumber());

        }

        private static function routeGET() {
            
            match (true) {

                REQUEST == "/guestbook",
                REQUEST == "/guestbook/index",
                str_contains(REQUEST, "/page") && REQUEST !== "/guestbook/page",
                str_contains(REQUEST, "/comment") && REQUEST !== "/guestbook/comment",
                isset($_SERVER['HTTP_REFERER']) && (str_contains(REQUEST, "/error") || str_contains(REQUEST, "/success"))

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

                    http_response_code(303);
                    header('Location: /guestbook/error/has_html');
        
                }
            
            } else {

                http_response_code(303);
                header('Location: /guestbook/error/time_too_short');
        
            }

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
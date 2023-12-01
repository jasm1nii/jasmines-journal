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

                (!isset($page) || $page == 1) ? 0 : $page;

                return $page;

            }

        }

        private static function setPageSession() {

            $page = self::setPageNumber();

            if (REQUEST == "/guestbook" || REQUEST == "/guestbook/page/1") {

                $_SESSION['gb_page'] = 1;
        
            } elseif (REQUEST == "/guestbook/page/" . $page) {

                $page !== 0 ? $_SESSION['gb_page'] = $page : $_SESSION['gb_page'] = 1;

            }

            $_SESSION['gb_page'] ?? 1;

        }

        private static function validateResponse() {

            $time_offset = $_SERVER['REQUEST_TIME'] - $_POST['timestamp'];

            if (isset($_POST) && $time_offset > 3) {

                if ($_POST['message'] == strip_tags($_POST['message']) && $_POST['name'] == strip_tags($_POST['name'])) {
                    
                    new Models\GuestbookPOST();

                } else {

                    header('Location: /guestbook/error/has_html');
        
                }
            
            } else {

                header('Location: /guestbook/error/time_too_short');
        
            }

        }

        public static function dispatch() {

            switch ($_SERVER["REQUEST_METHOD"]) {

                case "POST":

                    self::validateResponse();

                    break;

                
                case "GET":

                    switch (REQUEST) {

                        case str_contains(REQUEST, "success") && !isset($_SERVER['HTTP_REFERER']):
                        case str_contains(REQUEST, "error") && !isset($_SERVER['HTTP_REFERER']):
                        case "/guestbook/page":
                        case "/guestbook/comment":

                            header('Location: /guestbook');

                            break;

                        
                        case "/guestbook":
                        case "/guestbook/index":
                        case str_contains(REQUEST, "/page") && REQUEST !== "/guestbook/page":
                        case str_contains(REQUEST, "/comment") && REQUEST !== "/guestbook/comment":

                            self::setPageSession();

                            new Layouts\Guestbook(self::setPageNumber());

                            break;

                        default:
                    
                            Route::notFound();
                    
                    }

                    break;

                default:
                    
                    header('Location: /guestbook');

            }

        }

    }

?>
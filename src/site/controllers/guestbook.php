<?php

    namespace JasminesJournal\Site\Router;

    use \JasminesJournal\Core\Route as Route;
    use \JasminesJournal\Site\Views\Layouts as Layouts;
    use \JasminesJournal\Site\Models\GuestbookPageNav as GuestbookPageNav;

    //

    class Guestbook extends Route {

        public static function setPageNumber() {

            if (str_starts_with(REQUEST, "/guestbook/page")) {

                $page_req = preg_split('/guestbook\/page/', $_SERVER['REQUEST_URI']);
                $page = trim($page_req[1], "/");

                if (!isset($page) || $page == 1) {

                    $page = 0;
            
                }

                return $page;

            }

        }

        public static function setPageSession() {

            $page = self::setPageNumber();

            if (REQUEST == "/guestbook" || REQUEST == "/guestbook/page/1") {

                $_SESSION['gb_page'] = 1;
        
            } elseif (REQUEST == "/guestbook/page/" . $page) {
        
                if ($page !== 0) {
        
                    $_SESSION['gb_page'] = $page;
        
                } else {
        
                    $_SESSION['gb_page'] = 1;
                }
        
            }

            if (!isset($_SESSION['gb_page'])) {

                $_SESSION['gb_page'] = 1;

            }

        }

        public static function setFormSession() {

            if (REQUEST == "/guestbook" || isset($_SERVER['HTTP_REFERER'])) {

                session_start();
                $_SESSION['form_start'] = true;

            } elseif (!isset($_SERVER['HTTP_REFERER'])) {

                switch (REQUEST) {

                    case str_contains(REQUEST, "success"):
                    case str_contains(REQUEST, "error"):
                        
                        header('Location: /guestbook');
                        break;

                    default:
                    
                        REQUEST;

                }

            }

        }

    }

    switch (REQUEST) {

        case "/guestbook/post":
        case "/guestbook/post/":

            Route::forwardToModel('guestbook/guestbook_submit.php');

            break;

        
        default:
            
            Guestbook::setFormSession();
            Guestbook::setPageSession();

            new Layouts\Guestbook(Guestbook::setPageNumber());

    }

?>
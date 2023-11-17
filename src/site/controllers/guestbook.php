<?php

    namespace Site\Router;

    \Route::loadLayoutClasses('guestbook.php');

    require_once SITE_ROOT . DIR['models'] . "guestbook/guestbook_page.php";

    //

    class Guestbook extends \Route {

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

            if (REQUEST == "/guestbook/" || REQUEST == "/guestbook/page/1/") {

                $_SESSION['gb_page'] = 1;
        
            } elseif (REQUEST == "/guestbook/page/" . $page . "/") {
        
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

            if (REQUEST == "/guestbook/" || isset($_SERVER['HTTP_REFERER'])) {

                session_start();
                $_SESSION['form_start'] = true;

            }

        }

    }

    switch (REQUEST) {

        case "/guestbook/post/":

            \Route::forwardToModel('guestbook/guestbook_submit.php');

            break;

        
        default:
            
            \Site\Router\Guestbook::setFormSession();
            \Site\Router\Guestbook::setPageSession();

            new \Site\Views\Layouts\Guestbook(\Site\Router\Guestbook::setPageNumber());

    }

?>
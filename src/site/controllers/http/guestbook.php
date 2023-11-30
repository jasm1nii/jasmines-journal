<?php

    namespace JasminesJournal\Site\Request;

    use JasminesJournal\Core\Route as Route;
    use JasminesJournal\Site\Views\Layouts as Layouts;
    use JasminesJournal\Site\Models\GuestbookPOST as GuestbookPOST;

    //

    trait Guestbook {

        private static function setPageNumber() {

            if (str_starts_with(REQUEST, "/guestbook/page")) {

                $page_req = preg_split('/guestbook\/page/', $_SERVER['REQUEST_URI']);
                $page = trim($page_req[1], "/");

                if (!isset($page) || $page == 1) {

                    $page = 0;
            
                }

                return $page;

            }

        }

        private static function setPageSession() {

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

        private static function setFormSession() {

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

        public static function dispatch() {

            switch (REQUEST) {

                case "/guestbook/post":
                case "/guestbook/post/":

                    $time_offset = $_SERVER['REQUEST_TIME'] - $_POST['timestamp'];

                    if (isset($_POST) && $time_offset > 3) {

                        if ($_POST['message'] == strip_tags($_POST['message']) && $_POST['name'] == strip_tags($_POST['name'])) {
                            
                            new GuestbookPOST();

                        } else {

                            header('Location: /guestbook/error/has_html');
                
                        }
                    
                    } else {

                        header('Location: /guestbook/error/time_too_short');
                
                    }

                    break;

                
                default:
                    
                    self::setFormSession();
                    self::setPageSession();

                    new Layouts\Guestbook(self::setPageNumber());

            }

        }

    }

?>
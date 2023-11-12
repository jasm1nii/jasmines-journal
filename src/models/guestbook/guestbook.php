<?php
    class Guestbook {
        const Index = "/guestbook/";
        const Comment = self::Index . 'comment';
        const Page = self::Index . 'page';
        const PostSuccess = self::Index . 'success';
        const PostError = self::Index .'error';

        public static function sendPOST() {
            require SITE_ROOT . DIR['includes'] . "_guestbook_submit.php";
        }

        public static function render() {
            require SITE_ROOT . DIR['layouts'] . "guestbook_layout.php";
        }
    }

    if (REQUEST == "/guestbook/post/") {

        Guestbook::sendPOST();

    } else {

        switch (REQUEST) {
            
            case Guestbook::Index:
            case str_starts_with(REQUEST, Guestbook::Page):
            case str_starts_with(REQUEST, Guestbook::PostSuccess):
            case str_starts_with(REQUEST, Guestbook::PostError):

                if (str_starts_with(REQUEST, Guestbook::Page)) {

                    $page_req = preg_split('/guestbook\/page/', $_SERVER['REQUEST_URI']);
                    $page = trim($page_req[1], "/");

                }

                if (REQUEST == Guestbook::Index || isset($_SERVER['HTTP_REFERER'])) {

                    session_start();
                    $_SESSION['form_start'] = true;

                } elseif (!isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== Guestbook::Post . "/") {

                    header('Location: /guestbook');

                }

                Guestbook::render();
                break;
            
            default:
                Guestbook::render();
        }
    }
?>
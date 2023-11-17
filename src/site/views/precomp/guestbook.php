<?php

    namespace Site\Views\Layouts;
    use Core\Views\Render\View as View;

    require_once View::MARKDOWN_COMMENTS;
    use Core\Views\Render\Extension\MarkdownComments as MarkdownComments;

    require_once SITE_ROOT . DIR['models'] . "guestbook/guestbook_page.php";
    use \Site\Models\GuestbookComments as GuestbookComments;
    use \Site\Models\GuestbookThread as GuestbookThread;
    use \Site\Models\GuestbookThreadReply as GuestbookThreadReply;
    use \Site\Models\GuestbookPageNav as GuestbookPageNav;

    //

    class Guestbook extends View {

        const LAYOUT = DIR['layouts'] . "guestbook/guestbook_layout.html.twig";

        private static function setDialog() {

            if (isset($_SERVER['HTTP_REFERER'])) {

                $dialog = match (REQUEST) {
                    '/guestbook/success/'               => 'success',
                    '/guestbook/success/exception/'     => 'exception',
                    '/guestbook/error/has_html/'        => 'html_error',
                    '/guestbook/error/time_too_short/'  => 'spam_error',
                    default                             => null
                };
                
            } else {
                
                $dialog = null;

            }

            return $dialog;

        }

        private static function getCommentKeys($page_num) {

            $msg_arr = GuestbookComments::getRows($page_num);

            for ($i=0; $i < count($msg_arr); $i++) {

                $comment[] = $msg_arr[$i];

            }

            return $comment;

        }

        private static function getThreadParent() {

            if (str_contains(REQUEST, "comment")) {

                $parent = GuestbookThread::getThread()[0];

            } else {

                $parent = null;

            }

            return $parent;

        }

        private static function getThreadReplies() {

            if (str_contains(REQUEST, "comment")) {

                $reply = GuestbookThreadReply::getThreadReplies();

                if (count($reply) !== 0) {

                    $result = $reply;

                }

            }
            
            if (!isset($result)) {

                $result = null;
            }

            return $result;
            
        }

        private static function getPageNumbers($pages) {

            $total = GuestbookPageNav::getTotal();
            $max_pages = $total[0]['total'];
            $nav_total = intdiv($max_pages, 10);
            $nav_entries = range(1, $nav_total);

            return $nav_entries;

        }

        public function __construct($page_num) {

            $vars = [
                'dialog'         => self::setDialog(),
                'thread_parent'  => self::getThreadParent(),
                'thread_replies' => self::getThreadReplies(),
                'current_page'   => $_SESSION['gb_page'],
                'request_time'   => $_SERVER['REQUEST_TIME'],
                'comment_pages'  => self::getPageNumbers($page_num),
                'comments'       => self::getCommentKeys($page_num)
            ];

            $include_path = DIR['layouts'] . "guestbook";

            parent::Twig(self::LAYOUT, $vars, $include_path);

        }

    }

?>
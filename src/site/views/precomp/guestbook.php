<?php

    namespace JasminesJournal\Site\Views\Layouts;
    
    use JasminesJournal\Core\Views\Render\View;

    use JasminesJournal\Site\Models\GuestbookComments;
    use JasminesJournal\Site\Models\GuestbookThread;
    use JasminesJournal\Site\Models\GuestbookThreadReply;
    use JasminesJournal\Site\Models\GuestbookRowCount;


    class Guestbook extends View {

        const LAYOUT    = DIR['layouts'] . "guestbook/guestbook_layout.html.twig";
        const INCLUDES  = DIR['layouts'] . "guestbook";

        private static function setDialog() {

            if (isset($_SERVER['HTTP_REFERER'])) {

                $dialog = match (REQUEST) {
                    '/guestbook/success'               =>   'success',
                    '/guestbook/success/exception'     =>   'exception',
                    '/guestbook/error/has_html'        =>   'html_error',
                    '/guestbook/error/time_too_short'  =>   'spam_error',
                    default                            =>   null
                };
                
            } else {
                
                $dialog = null;

            }

            return $dialog;

        }

        private static function getCommentKeys(int|null $page_num) {

            $msg_arr = GuestbookComments::getRows($page_num);

            if ($msg_arr !== null) {

                for ($i=0; $i < count($msg_arr); $i++) {

                    $comment[] = $msg_arr[$i];

                }

            }

            $comment ?? $comment = null;

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

        private static function getPageNumbers() {

            $total_rows = GuestbookRowCount::getTotal();

            if ($total_rows !== null) {

                $db_pages = intdiv($total_rows, 10);
                $html_pages = range(1, $db_pages);

                // to start numbering from 1 instead of 0:

                if ($html_pages[1] == 0) {

                    array_shift($html_pages);
                    $html_pages[0] = 1;
                    
                }

                // to prevent returning an empty last page, if the result of intdiv() == result of normal float division):

                if (($total_rows / 10) == count($html_pages)) {

                    array_pop($html_pages);

                }

            } else {

                $html_pages = null;
                
            }

            return $html_pages;

        }

        public function __construct(int|null $page_num) {

            $vars = [
                'dialog'         => self::setDialog(),
                'thread_parent'  => self::getThreadParent(),
                'thread_replies' => self::getThreadReplies(),
                'current_page'   => $_SESSION['page'],
                'request_time'   => $_SERVER['REQUEST_TIME'],
                'comment_pages'  => self::getPageNumbers(),
                'comments'       => self::getCommentKeys($page_num)
            ];

            parent::Twig(self::LAYOUT, $vars, self::INCLUDES);

        }

    }

?>
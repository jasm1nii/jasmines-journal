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

            parse_str(REQUEST, $params);

            if (isset($params['id'])) {

                if ($params['id'] == $_SERVER['REQUEST_TIME']) {

                    return match (true) {

                        str_contains(REQUEST, 'has_html')
                            => 'html_error',

                        str_contains(REQUEST, 'time_too_short')
                            => 'spam_error',

                        default => null
                        
                    };
                    
                } else {
                    
                    return match (true) {

                        str_contains(REQUEST, 'success')
                            => 'success',

                        str_contains(REQUEST, 'exception')
                            => 'exception',

                        default => null
                        
                    };

                }

            }

        }

        private static function getCommentKeys(int $page_num): ?array {

            $msg_arr = GuestbookComments::getRows($page_num);

            if ($msg_arr !== null) {

                for ($i=0; $i < count($msg_arr); $i++) {

                    $comment[] = $msg_arr[$i];

                }

            }

            return $comment ??= null;

        }

        private static function getThreadParent() {

            return str_contains(REQUEST, "comment") ? GuestbookThread::getThread() : null;

        }

        private static function getThreadReplies() {

            if (str_contains(REQUEST, "comment")) {

                $reply = GuestbookThreadReply::getThreadReplies();

                if (count($reply) !== 0) {

                    $result = $reply;

                }

            }
            
            return $result ??= null;
            
        }

        private static function getPageNumbers() {

            $total_rows = GuestbookRowCount::getTotal();

            if ($total_rows !== null) {

                $pages = intdiv($total_rows, 10);

                if ($pages * 10 == $total_rows) {

                    // removes the last page if it's blank due to perfect division:

                    return $pages - 1;

                } else {

                    return $pages;

                }

            } else {

                return null;
                
            }
            
        }

        public function __construct(int $page_num) {

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
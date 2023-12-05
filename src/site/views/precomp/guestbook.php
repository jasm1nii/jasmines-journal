<?php

    namespace JasminesJournal\Site\Views\Layouts;
    
    use JasminesJournal\Core\Views\Render\Layout;

    use JasminesJournal\Site\Models\GuestbookComments;
    use JasminesJournal\Site\Models\GuestbookThread;
    use JasminesJournal\Site\Models\GuestbookThreadReply;
    use JasminesJournal\Site\Models\GuestbookRowCount;


    class Guestbook extends Layout {

        protected string $layout = DIR['layouts'] . "guestbook/guestbook_layout.html.twig";

        protected static string $includes_path = DIR['layouts'] . "guestbook";

        private function setDialog() {

            if ($this->show_dialog == true && isset($_SESSION['guestbook'])) {

                return match (true) {

                    str_contains(REQUEST, 'has_html')
                        => 'html_error',

                    str_contains(REQUEST, 'time_too_short')
                        => 'spam_error',

                    str_contains(REQUEST, 'success')
                        => 'success',

                    str_contains(REQUEST, 'exception')
                        => 'exception'
                    
                };
            
            } else {

                return null;

            }

        }

        private function getCommentKeys(): ?array {

            $msg_arr = GuestbookComments::getRows($this->page_num);

            if ($msg_arr !== null) {

                for ($i=0; $i < count($msg_arr); $i++) {

                    $comment[] = $msg_arr[$i];

                }

            }

            return $comment ??= null;

        }

        private function getThreadParent(): ?array {

            return str_contains(REQUEST, "comment") ? GuestbookThread::getThread() : null;

        }

        private function getThreadReplies(): ?array {

            if (str_contains(REQUEST, "comment")) {

                $reply = GuestbookThreadReply::getThreadReplies();

                if (count($reply) !== 0) {

                    $result = $reply;

                }

            }
            
            return $result ??= null;
            
        }

        private function getPageNumbers(): ?int {

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

        public function __construct(bool $show_dialog = false, int $page_num) {

            $this->show_dialog  = $show_dialog;
            $this->page_num     = $page_num;

            if ($this->show_dialog == true && !isset($_SESSION['guestbook'])) {

                header("Location: /guestbook");

            } else {

                $this->render();
                session_unset();
                
            }

        }

        protected function render(): void {

            $vars = [
                    'dialog'         => $this->setDialog(),
                    'thread_parent'  => $this->getThreadParent(),
                    'thread_replies' => $this->getThreadReplies(),
                    'current_page'   => $_SESSION['page'],
                    'request_time'   => $_SERVER['REQUEST_TIME'],
                    'comment_pages'  => $this->getPageNumbers(),
                    'comments'       => $this->getCommentKeys()
                ];

            parent::Twig($this->layout, $vars, self::$includes_path);

        }

    }

?>
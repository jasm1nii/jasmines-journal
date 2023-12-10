<?php

    namespace JasminesJournal\Site\Views\Layouts;
    
    use JasminesJournal\Core\Views\Render\Layout;
    use JasminesJournal\Site\Models\GuestbookComments;

    final class Guestbook extends Layout {

        protected string $layout = DIR['layouts'] . "guestbook/guestbook_layout.html.twig";
        protected static string $includes_path = DIR['layouts'] . "guestbook";

        private readonly ?object $data;
        private readonly int $current_page;

        private ?string $dialog;
        private ?array $comments;
        private ?array $thread_parent;
        private ?array $thread_replies;

        final public function __construct(bool $show_dialog = false, int $page_num) {

            $this->current_page = $page_num;

            if ($show_dialog == true && !isset($_SESSION['guestbook'])) {

                header("Location: /guestbook");

            } else {

                $this->buildPage();
                session_unset();
                
            }

        }

        private function buildPage(): void {

            $this->data = new GuestbookComments();

            if (str_contains(REQUEST, "comment")) {

                $this->getThreadParent();
                $this->getThreadReplies();

            } else {

                $this->thread_parent = null;
                $this->thread_replies = null;

            }

            $this->setDialog();
            $this->getPageNumbers();
            $this->getComments();

            $this->render();

        }

        private function setDialog(): void {

            $this->dialog = preg_split('/\/(status)=/', REQUEST)[1] ??= null;

        }

        private function getComments(): void {

            $msg_data = $this->data;
            $msg_arr = $msg_data->getMessages($this->current_page);

            if ($msg_arr !== null) {

                for ($i=0; $i < count($msg_arr); $i++) {

                    $comments[] = $msg_arr[$i];

                }

            }

            $this->comments = $comments ??= null;

        }

        private function getThreadParent(): void {

            $this->thread_parent = $this->data->getThread();

        }

        private function getThreadReplies(): void {

            $replies = $this->data->getThreadReplies();

            $this->thread_replies = count($replies) !== 0 ? $replies : null;
            
        }

        private function getPageNumbers(): void {

            $total_rows = $this->data->getTotal();

            if ($total_rows !== null) {

                $pages = intdiv($total_rows, 10);

                // remove the last page if it's blank due to perfect division:

                $this->total_pages = $pages * 10 == $total_rows ? $pages - 1 : $pages;

            } else {

                $this->total_pages = null;
                
            }
            
        }

        final protected function render(): void {

            $vars = [
                    'request'        => REQUEST,
                    'dialog'         => $this->dialog,
                    'thread_parent'  => $this->thread_parent,
                    'thread_replies' => $this->thread_replies,
                    'current_page'   => $_SESSION['page'],
                    'request_time'   => $_SERVER['REQUEST_TIME'],
                    'comment_pages'  => $this->total_pages,
                    'comments'       => $this->comments
                ];

            parent::Twig($this->layout, $vars, self::$includes_path);

        }

    }

?>
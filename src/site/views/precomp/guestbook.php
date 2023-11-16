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

    class Guestbook extends View {

        const LAYOUT = DIR['layouts'] . "guestbook_layout.html.twig";

        private static function setDialog() {

            if (isset($_SERVER['HTTP_REFERER'])) {

                if (REQUEST == '/guestbook/success/') {

                    $dialog = "success";

                } elseif (REQUEST == '/guestbook/success/exception/') {

                    $dialog = "exception";

                } elseif (REQUEST == "/guestbook/error/has_html/") {

                    $dialog = "html_error";

                } elseif (REQUEST == "/guestbook/error/time_too_short/") {

                    $dialog = "spam_error";

                } else {

                    $dialog = null;
                }
                
            } else {

                $dialog = null;

            }

            return $dialog;

        }

        private static function showMessage($v, $is_threaded) {

            $name = htmlspecialchars($v['Name'], ENT_QUOTES, "UTF-8", false);
            $msg = "<section class='message";

            if ($is_threaded == true) {

                $msg .= " is-threaded";

            }

            $msg .= "'><hgroup><h2 id='{$v['ID']}'><a href='/guestbook/comment/{$v['ID']}'>#{$v['ID']}</a> &#x2022; ";

            if ($v['User Privilege'] == 'Admin') {

                $name .= "&nbsp;👑";

            }

            if ($v['Website'] !== null) {

                $msg .= "<a href='{$v['Website']}'>{$name}</a>";

            } else {

                $msg .= $name;

            }

            $msg .= "&nbsp;";

            if ($v['Parent ID'] !== null) {

                $msg .= "<span class='reply-context'>(in reply to <a href='/guestbook/comment/{$v['Parent ID']}'>#{$v['Parent ID']}</a>)</span>";

            }

            $md_comment = MarkdownComments::convert($v['Comment']);

            $msg .= "</h2></hgroup><section class='content'>" . $md_comment . "</section><footer><time>{$v['Date']}</time></footer></section>";

            return $msg;

        }

        private static function setRows($page_num) {

            $msg_arr = GuestbookComments::getRows($page_num);

            $results = [];

            for ($i=0; $i < count($msg_arr); $i++) {

                $comment = $msg_arr[$i];

                $results[] = self::showMessage($comment, false);

            }

            return implode("",$results);

        }

        private static function showThreadParent() {

            if (str_contains(REQUEST, "comment")) {

                $parent = GuestbookThread::getThread()[0];
                $result = self::showMessage($parent, false);

            } else {

                $result = null;

            }

            return $result;

        }

        private static function showThreadReplies() {

            if (str_contains(REQUEST, "comment")) {

                $reply = GuestbookThreadReply::getThreadReplies();

                if (count($reply) !== 0) {

                    $result = self::showMessage($reply[0], true);

                }

            } else {

                $result = null;

            }

            return $result;
            
        }

        private static function getPageNumbers($pages) {

            $total = GuestbookPageNav::getTotal();
            $max_pages = $total[0]['total'];
            $nav_total = intdiv($max_pages, 10);
            $nav_entries = range(1, $nav_total);

            $nav = "<nav><span>page</span><ul>";

            for ($i=0; $i < (count($nav_entries)); $i++) {

                $page_num = $nav_entries[$i];

                if ($page_num == $pages || (($pages + 1) == 1 && 1 == $page_num)) {

                    $nav .= "<li><span class='current'><a href='/guestbook/page/{$page_num}'>{$page_num}</a></span></li>";

                    continue;

                }

                $nav .= "<li><span class='page'><a href='/guestbook/page/{$page_num}'>{$page_num}</a></span></li>";
            }

            $nav .= "</ul></nav>";

            return $nav;

        }

        public function __construct($page_num) {

            $vars = [
                'dialog'            => self::setDialog(),
                'comments'          => self::setRows($page_num),
                'thread'            => self::showThreadParent(),
                'thread_replies'    => self::showThreadReplies(),
                'previous_page'     => $_SESSION['gb_page'],
                'request_time'      => $_SERVER['REQUEST_TIME'],
                'comments_nav'      => self::getPageNumbers($page_num)
            ];

            parent::Twig(self::LAYOUT, $vars, null);
        }

    }

?>
<?php

    namespace Site\Views\Layouts;

    include SITE_ROOT . "/src/site/models/guestbook/guestbook_preview.php";
    use Core\Views\Render\View as View;
    use Site\Models\Guestbook\NewestMessage as NewestMessage;

    include View::MARKDOWN_COMMENTS;
    use Core\Views\Render\Extension\MarkdownComments as MarkdownComments;

    //

    final class Home extends View {

        private static $layout = DIR['layouts'] . "home/home_layout.html.twig";

        private static $includes_path = DIR['layouts'] . "home/includes/";

        public function __construct() {

            function showGuestbook() {

                $msg = NewestMessage::get();

                $name = htmlspecialchars($msg['Name'], ENT_QUOTES, "UTF-8", false);

                $comment = MarkdownComments::convert($msg['Comment']);

                // source: https://www.w3schools.in/php/examples/time-ago-function

                function getTimeDiff($time) {

                    $time_diff = time() - $time;

                    if ($time_diff < 1) {

                        return 'less than 1 second ago';

                    }

                    $condition = [
                        12 * 30 * 24 * 60 * 60  =>  'year',
                        30 * 24 * 60 * 60       =>  'month',
                        24 * 60 * 60            =>  'day',
                        60 * 60                 =>  'hour',
                        60                      =>  'minute',
                        1                       =>  'second'
                    ];

                    foreach ($condition as $secs => $str) {

                        $d = $time_diff / $secs;

                        if ($d >= 1) {

                            $t = round($d);

                            return $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ago';

                        }
                    }
                }

                $date = getTimeDiff(strtotime($msg['Date']));

                $msg_html = "<h3><a href='/guestbook/comment/{$msg['ID']}'>#{$msg['ID']}</a> &bull; {$name} ({$date})</h3>";

                $msg_html .= "<div class='overflow'>{$comment}</div>";

                return $msg_html;

            }

            $vars = [
                'src' => "/_assets/media/main",
                'guestbook' => showGuestbook()
            ];

            parent::Twig(self::$layout, $vars, self::$includes_path);

        }

    }

?>

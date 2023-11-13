<?php

    class Home extends View {

        function __construct() {

            function showGuestbook() {

                include SITE_ROOT . "/src/site/models/guestbook/guestbook_preview.php";

                include View::MARKDOWN_COMMENTS;

                $name = htmlspecialchars($msg['Name'], ENT_QUOTES, "UTF-8", false);

                $comment = $commonmark->convert($msg['Comment']);

                $msg_html = "<h3><a href='/guestbook/comment/{$msg['ID']}'>#{$msg['ID']}</a> &bull; {$name} ({$date})</h3>";
                
                $msg_html .= "<div class='overflow'>{$comment}</div>";

                return $msg_html;

            }

            $layout = DIR['layouts'] . "home/home_layout.html.twig";

            $vars = [
                'src' => "/_assets/media/main",
                'guestbook' => showGuestbook()
            ];

            $includes_path = SITE_ROOT . DIR['layouts'] . "home/includes/";

            parent::Twig($layout, $vars, $includes_path);

        }

    }
    
?>

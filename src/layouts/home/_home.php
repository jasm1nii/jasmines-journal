<?php

    include SITE_ROOT . "/src/models/guestbook/guestbook_preview.php";

    include RenderConfig::MarkdownComments;

    $name = htmlspecialchars($msg['Name'], ENT_QUOTES, "UTF-8", false);
    $comment = $commonmark->convert($msg['Comment']);

    $msg_html = "<h3><a href='/guestbook/comment/{$msg['ID']}'>#{$msg['ID']}</a> &bull; {$name} ({$date})</h3>";
    
    $msg_html .= "<div class='overflow'>{$comment}</div>";

    $layout = DIR['layouts'] . "home/home_layout.html.twig";

    $vars = [
        'src' => "/_assets/media/main",
        'guestbook' => $msg_html
    ];

    $includes_path = SITE_ROOT . DIR['layouts'] . "home/includes/";

    View::Twig($layout, $vars, $includes_path);

?>

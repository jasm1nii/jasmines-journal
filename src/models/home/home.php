<?php

    include SITE_ROOT . "/src/models/guestbook/guestbook_preview.php";

    $layout = DIR['layouts'] . "home/home_layout.html.twig";

    $vars = [
        'src' => "/_assets/media/main",
        'guestbook' => $msg_html
    ];

    $includes_path = SITE_ROOT . DIR['layouts'] . "home/includes/";

    View::Twig($layout, $vars, $includes_path);

?>

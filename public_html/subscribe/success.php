<?php
    require_once dirname(__DIR__,2).'/config/twig_default_config.php';

    echo $twig->render('/resources/layouts/subscribe_post_layout.html.twig', ['h2' => 'yippe!!', 'message' => 'thanks for subscribing!']);
?>
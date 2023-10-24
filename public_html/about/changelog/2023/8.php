<?php
    require_once dirname(__DIR__,4).'/config/twig_default_config.php';

    echo $twig->render('/resources/content/changelog/2023/8_august.html.twig');
?>
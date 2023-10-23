<?php
    require_once dirname(__DIR__,6).'/config/twig_default_config.php';

    echo $twig->render('/tests/blog/articles/yyyy/mm/dd/entry_content.html.twig');
?>
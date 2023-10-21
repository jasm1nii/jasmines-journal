<?php
    require_once dirname(__DIR__,6).'/php_resources/_templates/_article-config.php';

    echo $twig->render('/public_html/blog/articles/2023/10/20/_article-content.twig');
?>
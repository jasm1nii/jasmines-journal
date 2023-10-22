<?php
    require_once dirname(__DIR__,6).'/php_resources/_templates/article_config.php';

    echo $twig->render('/public_html/blog/articles/2023/10/22/entry_content.html.twig');
?>
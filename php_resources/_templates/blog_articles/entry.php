<?php
    require_once dirname(__DIR__,1).'/entry_config.php';

    echo $twig->render('/php_resources/_templates/blog_articles/entry_content.html.twig');
?>
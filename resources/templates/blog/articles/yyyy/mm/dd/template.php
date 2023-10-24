<?php
    require_once dirname(__DIR__,7).'/config/twig_default_config.php';

    $layout = $twig->load($blog_article_layout);
    
    echo $twig->render('/resources/templates/blog/articles/yyyy/mm/dd/entry_content.html.twig',['layout'=>$layout]);
?>
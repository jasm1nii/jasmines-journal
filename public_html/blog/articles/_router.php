<?php
    $request = $_SERVER['REQUEST_URI'];

    $url_slug = rtrim($request,'/');

    $content = '/resources/content'.$url_slug.'.html.twig';
    
    $source = dirname(__DIR__,3).$content;

    if (file_exists($source)) {
        require_once dirname(__DIR__,3).'/config/twig_default_config.php';

        $layout = $twig->load('/resources/layouts/blog_article_layout.html.twig');

        echo $twig->render($content,['layout'=>$layout]);
    } else {
        echo 'not here';
    }
?>
<?php
    $request = $_SERVER['REQUEST_URI'];
    $_404 = __DIR__.'/404.shtml';

    $twig_settings = dirname(__DIR__,1).'/config/twig_default_config.php';

    $url_slug = rtrim($request,'/');
    $content = '/resources/content'.$url_slug.'.html.twig';
    $image_root = '/_assets/media'.rtrim($url_slug,'/entry').'/';
    $source = dirname(__DIR__,1).$content;

    switch ($request) {
        case str_contains($request,'/blog/articles/'):
            if (file_exists($source)) {
                require_once $twig_settings;

                $layout = $twig->load('/resources/layouts/blog_article_layout.html.twig');

                echo $twig->render($content,['layout'=>$layout,'slug'=>$url_slug, 'src'=>$image_root]);

            } else {
                http_response_code(404);
                require_once $_404;

            }

            break;

        case str_contains($request, '/blog/notes/');
            if (file_exists($source)) {
                require_once $twig_settings;
        
                $layout = $twig->load('/resources/layouts/blog_note_layout.html.twig');
        
                echo $twig->render($content,['layout'=>$layout,'slug'=>$url_slug, 'src'=>$image_root]);

            } else {
                http_response_code(404);
                require_once $_404;
            }

            break;

        default:
           http_response_code(404);
           require_once $_404;
   }   
?>
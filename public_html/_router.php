<?php
    $request = $_SERVER['REQUEST_URI'];
    function _404() {
        http_response_code(404);
        require_once __DIR__.'/404.shtml';
    }

    $twig_settings = dirname(__DIR__,1).'/config/twig_default_config.php';

    switch ($request) {
        case str_contains($request,'/'.'blog/'):
            $slug = rtrim($request,'/');
            $blog_content = '/resources/content'.$slug.'.html.twig';
            $document_source = dirname(__DIR__,1).$blog_content;
            $media_source = '/_assets/media'.rtrim($slug,'/entry').'/';

            $article_layout = '/resources/layouts/blog_article_layout.html.twig';
            $note_layout = '/resources/layouts/blog_note_layout.html.twig';

            if (str_contains($request,'/'.'articles/')) {
                if (file_exists($document_source)) {
                    require_once $twig_settings;
                    $layout = $twig->load($article_layout);
                    echo $twig->render($blog_content,['layout'=>$layout,'slug'=>$slug, 'src'=>$media_source]);
                } else {
                    _404();
                }
            }
            if (str_contains($request,'/'.'notes/')) {
                if (file_exists($document_source)) {
                    require_once $twig_settings;
                    $layout = $twig->load($note_layout);
                    echo $twig->render($blog_content,['layout'=>$layout,'slug'=>$slug, 'src'=>$media_source]);
                } else {
                    _404();
                }
            }
            break;

        case str_contains($request, '/about/changelog/');
            $path_1 = ltrim($request,'/about');
            $path_2 = rtrim($path_1,'/');
            $document_source = dirname(__DIR__,1).'/resources/content/'.$path_2.'.html.twig';
            if (file_exists($document_source)) {
                require_once $twig_settings;
                echo $twig->render('/resources/content/'.$path_2.'.html.twig');
            } else {
                _404();
            }
            break;

        default:
            _404();
   }
?>
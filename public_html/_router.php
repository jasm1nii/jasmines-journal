<?php
    $request = $_SERVER['REQUEST_URI'];
    function _404() {
        http_response_code(404);
        require_once __DIR__.'/404.shtml';
    }

    require_once dirname(__DIR__,1).'/config/twig_default_config.php';

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

                    $layout = $twig->load($article_layout);

                    echo $twig->render($blog_content,
                        [
                            'layout'=>$layout,'slug'=>$slug,
                            'src'=>$media_source
                        ]);

                } else {
                    _404();
                }
            }
            if (str_contains($request,'/'.'notes/')) {
                if (file_exists($document_source)) {

                    $layout = $twig->load($note_layout);

                    echo $twig->render($blog_content,
                        [
                            'layout'=>$layout,
                            'slug'=>$slug,
                            'src'=>$media_source
                        ]);
                    
                } else {
                    _404();
                }
            }

            break;

        case str_contains($request, '/about/changelog/'):
            $path_1 = ltrim($request,'/about');
            $path_2 = rtrim($path_1,'/');
            $document_source = dirname(__DIR__,1).'/resources/content/'.$path_2.'.html.twig';

            if (file_exists($document_source)) {

                $layout = $twig->load('/resources/layouts/changelog_layout.html.twig');

                include dirname(__DIR__,1).'/resources/includes/_changelog_nav.php';
                $nav_html = $nav->saveHTML();

                echo $twig->render('/resources/content/'.$path_2.'.html.twig',
                    [
                        'layout'=>$layout,
                        'nav'=>$nav_html
                    ]);

            } else {
                _404();
            }

            break;

        case str_ends_with($request, '/'.'resources/'):
        case str_ends_with($request, '/'.'resources'):

            $updated = filemtime(dirname(__DIR__,1).'/resources/content/resources/resources_index.md');

            echo $twig->render('/resources/layouts/resources/resources_index.html.twig',
                [
                    'updated'=>$updated
                ]);

            break;

        case str_contains($request, '/'.'resources/'):
            $path_1 = preg_split(('/\/(resources)\//'),$request);
            $path_2 = rtrim($path_1[1],"/");

            $doc_dir = dirname(__DIR__,1).'/resources/content/resources/categories/';
            $doc_src = $doc_dir.$path_2.'.html.twig';

            if (file_exists($doc_src)) {
                
                $layout = $twig->load('/resources/layouts/resources/resources_subpage_1.html.twig');

                $markdown_src = $doc_dir.$path_2.'.md';
                if (file_exists($markdown_src)) {
                    $content = file_get_contents($markdown_src);
                    $updated = filemtime($markdown_src);
                } else {
                    $content = null;
                    $updated = filemtime($doc_src);
                }

                $url = preg_split('/\//',$request);
                if (!empty($url[3])) {
                    $parent = '/'.$url[1].'/'.$url[2];
                } else {
                    $parent = null;
                }

                echo $twig->render(ltrim($doc_src, dirname(__DIR__,1)),
                    [
                        'layout'=>$layout,
                        'updated'=>$updated,
                        'content'=>$content,
                        'parent'=>$parent
                    ]);

            } elseif (preg_match('/\/(resources)\/.+/', $request, $matches)) {

                $category_src = preg_split('/\/(resources)\//',$matches[0]);
                
                $doc_src = $doc_dir.$category_src[1];
                $category_index = $doc_src.'index.html.twig';

                if (file_exists($category_index)) {

                    $layout = $twig->load('/resources/layouts/resources/resources_subpage_1.html.twig');

                    $markdown_src = $doc_src.'index.md';
                    if (file_exists($markdown_src)) {
                        $content = file_get_contents($markdown_src);
                        $updated = filemtime($markdown_src);
                    } else {
                        $content = null;
                        $updated = filemtime($doc_src);
                    }

                    echo $twig->render(ltrim($category_index, dirname(__DIR__,1)),
                    [
                        'layout'=>$layout,
                        'updated'=>$updated,
                        'content'=>$content
                    ]);

                } else {
                    _404();
                }
                
            } else {
                _404();
            }

            break;

        default:
            _404();
   }
?>
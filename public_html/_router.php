<?php
    $request = $_SERVER['REQUEST_URI'];

    function _404() {
        http_response_code(404);
        require_once __DIR__.'/404.shtml';
    }

    $server_root = dirname(__DIR__,1);

    require_once $server_root.'/config/twig_default_config.php';
    require_once $server_root.'/config/commonmark_toc_config.php';

    $layouts_dir = '/resources/layouts';
    $content_dir = '/resources/content';

    switch ($request) {
        case str_contains($request,'/'.'blog/'):
            $slug = rtrim($request,'/');
            $blog_content = $content_dir.$slug.'.html.twig';
            $document_source = $server_root.$blog_content;
            $media_source = '/_assets/media'.rtrim($slug,'/entry').'/';

            $article_layout = $layouts_dir.'/blog_article_layout.html.twig';
            $note_layout = $layouts_dir.'/blog_note_layout.html.twig';

            if (str_contains($request,'/'.'articles/')) {
                if (file_exists($document_source)) {

                    $layout = $twig->load($article_layout);

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
            $document_source = $server_root.$content_dir.$path_2.'.html.twig';

            if (file_exists($document_source)) {

                $layout = $twig->load($layouts_dir.'/changelog_layout.html.twig');

                include $server_root.'/resources/includes/_changelog_nav.php';
                $nav_html = $nav->saveHTML();

                echo $twig->render($content_dir.$path_2.'.html.twig',
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

            $updated = filemtime($server_root.'/resources/content/resources/resources_index.md');

            echo $twig->render($layouts_dir.'/resources/resources_index.html.twig',
                [
                    'updated'=>$updated
                ]);

            break;

        case str_contains($request, '/'.'resources/'):

            $path = preg_split(('/\/(resources)\//'),$request);
            $file_base = rtrim($path[1],"/");

            $category = $server_root.$content_dir.'/resources/categories/';
            $subpage = $category.$file_base.'.html.twig';

            function renderPage($page) {
                global $request, $server_root, $twig, $layouts_dir, $content_dir, $content, $updated;

                $url = preg_split('/\//',$request);
                if (!empty($url[3])) {
                    $parent = '/'.$url[1].'/'.$url[2];
                } else {
                    $parent = null;
                }

                echo $twig->render(ltrim($page, $server_root),
                    [
                        'layout'=>$twig->load($layouts_dir.'/resources/resources_subpage_1.html.twig'),
                        'updated'=>$updated,
                        'legend'=>file_get_contents($server_root.$content_dir.'/resources/_legend.md'),
                        'content'=>$content,
                        'parent'=>$parent
                    ]);
            }

            if (file_exists($subpage)) {
                
                $markdown = $category.$file_base.'.md';
                
                if (file_exists($markdown)) {
                    $content = $commonmark_converter->convert(file_get_contents($markdown));
                    $updated = filemtime($markdown);

                } else {
                    $content = null;
                    $updated = filemtime($subpage);
                }

                renderPage($subpage);

            } elseif (preg_match('/\/(resources)\/.+/', $request, $matches)) {

                $path = preg_split('/\/(resources)\//',$matches[0]);
                
                $file_base = $category.$path[1];
                $index = $file_base.'index.html.twig';

                if (file_exists($index)) {

                    $markdown = $file_base.'index.md';

                    if (file_exists($markdown)) {
                        $content = $commonmark_converter->convert(file_get_contents($markdown));
                        $updated = filemtime($markdown);

                    } else {
                        $content = null;
                        $updated = filemtime($index);
                    }

                    renderPage($index);

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
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
        case str_contains($request, '/link-gallery'):
            $link_gallery = '/link-gallery/index.html.twig';

            echo $twig->render($content_dir.$link_gallery,
                [
                    'updated'=>stat($server_root.$content_dir.'/link-gallery')['mtime']
                ]);
                
            break;

        case str_contains($request,'/'.'blog/'):
            $article_layout = $layouts_dir.'/blog_article_layout.html.twig';
            $note_layout = $layouts_dir.'/blog_note_layout.html.twig';

            function renderBlogLayout($type) {
                global $request, $server_root, $twig, $content_dir;

                $slug = rtrim($request,'/');
                $blog_content = $content_dir.$slug.'.html.twig';
                $document_source = $server_root.$blog_content;

                if (file_exists($document_source)) {

                    echo $twig->render($blog_content,
                        [
                            'layout'=>$twig->load($type),
                            'slug'=>$slug,
                            'src'=>'/_assets/media'.rtrim($slug,'/entry').'/'
                        ]);
                } else {
                    _404();
                }
            }

            if (str_contains($request,'/'.'articles/')) {
                renderBlogLayout($article_layout);

            } elseif (str_contains($request,'/'.'notes/')) {
                renderBlogLayout($note_layout);

            } else {
                _404();
            }

            break;

        case str_contains($request, '/about/changelog/'):
            $path_1 = ltrim($request,'/about');
            $path_2 = '/'.rtrim($path_1,'/');
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

            echo $twig->render($layouts_dir.'/resources/resources_index.html.twig',
                [
                    'updated'=>filemtime($server_root.$content_dir.'/resources/resources_index.md')
                ]);

            break;

        case str_contains($request, '/'.'resources/'):

            $path = preg_split(('/\/(resources)\//'),$request);
            $file_base = rtrim($path[1],"/");
            $category = $server_root.$content_dir.'/resources/categories/';

            function renderPage($markdown_file, $twig_file) {
                global $request, $server_root, $twig, $commonmark, $layouts_dir, $content_dir;

                if (file_exists($markdown_file)) {
                    $content = $commonmark->convert(file_get_contents($markdown_file));
                    $updated = filemtime($markdown_file);

                } else {
                    $content = null;
                    $updated = filemtime($twig_file);
                }

                $url = preg_split('/\//',$request);
                if (!empty($url[3])) {
                    $parent = '/'.$url[1].'/'.$url[2];
                } else {
                    $parent = null;
                }

                echo $twig->render(ltrim($twig_file, $server_root),
                    [
                        'layout'=>$twig->load($layouts_dir.'/resources/resources_subpage_1.html.twig'),
                        'updated'=>$updated,
                        'legend'=>file_get_contents($server_root.$content_dir.'/resources/_legend.md'),
                        'content'=>$content,
                        'parent'=>$parent
                    ]);
            }

            $subpage = $category.$file_base.'.html.twig';
            
            if (file_exists($subpage)) {
                renderPage($category.$file_base.'.md',$subpage);

            } elseif (preg_match('/\/(resources)\/.+/', $request, $matches)) {

                $path = preg_split('/\/(resources)\//',$matches[0]);
                $file_base = $category.$path[1];
                $index = $file_base.'index.html.twig';

                if (file_exists($index)) {
                    renderPage($file_base.'index.md',$index);

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
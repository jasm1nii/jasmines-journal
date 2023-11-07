<?php
    define("REQUEST", $_SERVER['REQUEST_URI']);
    define("SITE_ROOT", dirname(__DIR__,1));

    class Route {
        const About = "/about/";
        const Blog = "/blog/";
        const BlogArticles = "/articles/";
        const BlogNotes = "/notes/";
        const Changelog = "/about/changelog/";
        const Resources = "/resources/";
        const LinkGallery = "/link-gallery";
        const Accessibility = "/accessibility";
        const Credits = "/credits";
        const SiteMap = "/site-map";
        const Guestbook = "/guestbook/";
        public static function NotFound() {
            http_response_code(404);
            require_once __DIR__.'/404.shtml';
        }
    }

    class Template {
        const Layouts = "/resources/layouts";
        const Includes = "/resources/includes";
        const Content = "/resources/content";
    }

    class Layout {
        const About = Template::Layouts."/about_layout.html.twig";
        const Subpage = Template::Layouts."/subpage_layout.html.twig";
        const BlogArticle =  Template::Layouts.'/blog_article_layout.html.twig';
        const BlogNote = Template::Layouts.'/blog_note_layout.html.twig';
        const LinkGallery = Template::Layouts.'/link-gallery_layout.html.twig';
        const SiteMap = Template::Layouts.'/site-map_layout.html.twig';
        const Guestbook = Template::Layouts.'/guestbook_layout.php';
    }

    class Includes {
        const IncludesRoot = SITE_ROOT.Template::Includes;
        public static function Head() {
            include self::IncludesRoot.'/head.shtml';
        }
        public static function HeaderNav() {
            include self::IncludesRoot.'/headernav.shtml';
        }
        public static function Footer() {
            include self::IncludesRoot.'/footer.shtml';
        }
    }

    class RenderConfig {
        const Twig = SITE_ROOT."/config/twig_default_config.php";
        const MarkdownComments = SITE_ROOT."/config/commonmark_comments_config.php";
        const MarkdownWithTOC = SITE_ROOT."/config/commonmark_toc_config.php";
    }

    require_once RenderConfig::Twig;

    class View {
        public static function renderPage($layout, $page, $slug) {
            global $twig;
            echo $twig->render($page,
                [
                    "layout" => $layout,
                    "slug" => $slug,
                    "updated" => filemtime(SITE_ROOT.$page)
                ]);
        }
    }

    switch (REQUEST) {
        case str_ends_with(REQUEST, Route::About):

            include SITE_ROOT.Template::Includes.'/_changelog_nav.php';
            $nav_html = $nav->saveHTML();

            $content = Template::Content."/about.html.twig";

            echo $twig->render($content,
            [
                "layout" => Layout::About,
                "nav" => $nav_html,
                "updated" => filemtime(SITE_ROOT.$content)
            ]);

            break;

        case str_starts_with(REQUEST, Route::LinkGallery):

            echo $twig->render(Layout::LinkGallery,
                [
                    'updated' => stat(SITE_ROOT.Template::Content.'/link-gallery')['mtime']
                ]);
                
            break;

        case str_starts_with(REQUEST, Route::Blog):

            function renderBlogLayout($type) {
                global $twig;

                $slug = rtrim(REQUEST,'/');
                $blog_content = Template::Content.$slug.'.html.twig';
                $document_source = SITE_ROOT.$blog_content;

                if (file_exists($document_source)) {

                    echo $twig->render($blog_content,
                        [
                            'layout'=>$twig->load($type),
                            'slug'=>$slug,
                            'src'=>'/_assets/media'.rtrim($slug,'/entry').'/'
                        ]);

                } else {
                    Route::NotFound();
                }
            }

            if (str_contains(REQUEST, Route::BlogArticles)) {
                renderBlogLayout(Layout::BlogArticle);

            } elseif (str_contains(REQUEST, Route::BlogNotes)) {
                renderBlogLayout(Layout::BlogNote);

            } else {
                Route::NotFound();
            }

            break;

        case str_ends_with(REQUEST, Route::Changelog):

            require SITE_ROOT.Template::Layouts.'/changelog/changelog_index.php';

            break;

        case str_starts_with(REQUEST, Route::Changelog):

            $path = ltrim(REQUEST,'/about');
            $file = '/'.rtrim($path,'/');
            $document_source = SITE_ROOT.Template::Content.$file.'.html.twig';

            if (file_exists($document_source)) {

                include SITE_ROOT.Template::Includes.'/_changelog_nav.php';
                $nav_html = $nav->saveHTML();

                echo $twig->render(Template::Content.$file.'.html.twig',
                    [
                        'layout'=>$twig->load(Template::Layouts.'/changelog/changelog_subpage.html.twig'),
                        'nav'=>$nav_html
                    ]);

            } else {
                Route::NotFound();
            }

            break;

        case str_ends_with(REQUEST, Route::Resources):

            echo $twig->render(Template::Layouts.'/resources/resources_index.html.twig',
                [
                    'updated' => filemtime(SITE_ROOT.Template::Content.'/resources/resources_index.md')
                ]);

            break;

        case str_starts_with(REQUEST, Route::Resources):

            $path = preg_split(('/\/(resources)\//'),REQUEST);
            $file_base = rtrim($path[1],"/");
            $category = SITE_ROOT.Template::Content.'/resources/categories/';

            function renderResourcesPage($markdown_file, $twig_file) {
                global $twig;

                if (file_exists($markdown_file)) {
                    require_once RenderConfig::MarkdownWithTOC;
                    $content = $commonmark->convert(file_get_contents($markdown_file));
                    $updated = filemtime($markdown_file);

                } else {
                    $content = null;
                    $updated = filemtime($twig_file);
                }

                $url = preg_split('/\//',REQUEST);
                if (!empty($url[3])) {
                    $parent = '/'.$url[1].'/'.$url[2];
                } else {
                    $parent = null;
                }

                echo $twig->render(ltrim($twig_file, SITE_ROOT),
                    [
                        'layout'=>$twig->load(Template::Layouts.'/resources/resources_subpage.html.twig'),
                        'updated'=>$updated,
                        'legend'=>file_get_contents(SITE_ROOT.Template::Content.'/resources/_legend.md'),
                        'content'=>$content,
                        'parent'=>$parent
                    ]);
            }

            $page = $category.$file_base.'.html.twig';
            
            if (file_exists($page)) {
                renderResourcesPage($category.$file_base.'.md',$page);

            } elseif (preg_match('/\/(resources)\/.+/', REQUEST, $matches)) {

                $path = preg_split('/\/(resources)\//',$matches[0]);
                $file_base = $category.$path[1];
                $page = $file_base.'index.html.twig';

                if (file_exists($page)) {
                    renderResourcesPage($file_base.'index.md',$page);

                } else {
                    Route::NotFound();
                }
                
            } else {
                Route::NotFound();
            }

            break;

        case str_starts_with(REQUEST, Route::Accessibility):

            View::renderPage(Layout::Subpage, Template::Content.'/accessibility.html.twig', trim(Route::Accessibility,"/"));
            break;

        case str_starts_with(REQUEST, Route::Credits):

            View::renderPage(Layout::Subpage, Template::Content.'/credits.html.twig', trim(Route::Credits,"/"));
            break;
        
        case str_starts_with(REQUEST, Route::SiteMap):

            View::renderPage(Layout::SiteMap, Template::Content.'/site-map.html.twig', null);
            break;

        case str_ends_with(REQUEST, Route::Guestbook):
        case str_starts_with(REQUEST, Route::Guestbook.'success'):
        case str_starts_with(REQUEST, Route::Guestbook.'error'):
            if (REQUEST == '/guestbook/' || isset($_SERVER['HTTP_REFERER'])) {
                session_start();
                $_SESSION['form_start'] = true;
            } elseif (!isset($_SERVER['HTTP_REFERER'])) {
                header('Location: /guestbook');
            }
            require SITE_ROOT.Layout::Guestbook;
            break;

        case str_ends_with(REQUEST, "/guestbook/post/"):

            require SITE_ROOT.'/resources/includes/_guestbook_submit.php';
            break;

        case str_starts_with(REQUEST, Route::Guestbook.'page'):
            $page_req = preg_split('/guestbook\/page/', $_SERVER['REQUEST_URI']);
            $page = trim($page_req[1], "/");
            require SITE_ROOT.Layout::Guestbook;
            break;
        
        default:
            Route::NotFound();
   }
?>
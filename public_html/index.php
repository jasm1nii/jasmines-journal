<?php
    putenv("ENV=dev");
    define("ENV_SRC", getenv('ENV'));
    define("REQUEST", $_SERVER['REQUEST_URI']);
    define("SITE_ROOT", dirname(__DIR__,1));

    class Route {
        const About = "/about/";
        const Blog = "/blog/";
        const BlogArticles = "/articles/";
        const BlogNotes = "/notes/";
        const Changelog = "/about/changelog/";
        const Resources = "/resources/";
        const LinkGallery = "/link-gallery/";
        const Accessibility = "/accessibility/";
        const Credits = "/credits/";
        const SiteMap = "/site-map/";
        const Feeds = "/subscribe/";
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
        const Home = Template::Layouts."/home_layout.php";
        const About = Template::Layouts."/about_layout.html.twig";
        const Subpage = Template::Layouts."/subpage_layout.html.twig";
        const BlogArticle =  Template::Layouts.'/blog_article_layout.html.twig';
        const BlogNote = Template::Layouts.'/blog_note_layout.html.twig';
        const LinkGallery = Template::Layouts.'/link-gallery_layout.html.twig';
        const SiteMap = Template::Layouts.'/site-map_layout.html.twig';
        const Feeds = Template::Layouts . '/feeds_layout.php';
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
        const Composer = SITE_ROOT . '/src/vendor/autoload.php';
        const Config = SITE_ROOT . "/config";
        const Ini = self::Config . "/env_" . ENV_SRC . ".ini";
        const Twig = self::Config . "/twig_default_config.php";
        const MarkdownComments = self::Config . "/commonmark_comments_config.php";
        const MarkdownWithTOC = self::Config . "/commonmark_toc_config.php";
    }

    class View {
        public static function RenderTwig($page, $vars) {
            require_once RenderConfig::Twig;
            if ($vars == null) {
                $vars = [];
            }
            echo $twig->render($page, $vars);
        }
    }

    switch (REQUEST) {
        case "":
        case "/":
        case "/index":
            require SITE_ROOT . Layout::Home;
            break;

        case Route::About:

            include SITE_ROOT.Template::Includes.'/_changelog_nav.php';
            $nav_html = $nav->saveHTML();

            $page = Template::Content."/about.html.twig";
            $vars = [
                "layout" => Layout::About,
                "nav" => $nav_html,
                "updated" => filemtime(SITE_ROOT.$page)
            ];

            View::RenderTwig($page, $vars);

            break;

        case Route::Changelog:

            require SITE_ROOT.Template::Layouts.'/changelog/changelog_index.php';
            break;

        case str_starts_with(REQUEST, Route::Changelog):

            $path = ltrim(REQUEST,'/about');
            $file = '/'.rtrim($path,'/');
            $document_source = SITE_ROOT.Template::Content.$file.'.html.twig';

            if (file_exists($document_source)) {

                include SITE_ROOT.Template::Includes.'/_changelog_nav.php';
                $nav_html = $nav->saveHTML();
                
                $layout = $twig->load(Template::Layouts.'/changelog/changelog_subpage.html.twig');

                $page = Template::Content . $file . '.html.twig';
                $vars = [
                    'layout' => $layout,
                    'nav' => $nav_html
                ];

                View::RenderTwig($page, $vars);

            } else {
                Route::NotFound();
            }
            break;

        case str_starts_with(REQUEST, Route::LinkGallery):

            $page = Layout::LinkGallery;
            $updated = stat(SITE_ROOT.Template::Content.'/link-gallery')['mtime'];
            $vars = [
                'updated' => $updated
            ];

            View::RenderTwig($page, $vars);
            break;

        case str_starts_with(REQUEST, Route::Blog):

            function renderBlogLayout($type) {

                require_once RenderConfig::Twig;

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

        case Route::Resources:

            $page = Template::Layouts.'/resources/resources_index.html.twig';
            $updated = filemtime(SITE_ROOT.Template::Content.'/resources/resources_index.md');
            $vars = [
                'updated' => $updated
            ];

            View::RenderTwig($page, $vars);
            break;

        case str_starts_with(REQUEST, Route::Resources):

            $path = preg_split(('/\/(resources)\//'),REQUEST);
            $file_base = rtrim($path[1],"/");
            $category = SITE_ROOT.Template::Content.'/resources/categories/';

            function renderResourcesPage($markdown_file, $twig_file) {

                require_once RenderConfig::Twig;

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

        case Route::Accessibility:

            $page = Template::Content.'/accessibility.html.twig';
            $layout = Layout::Subpage;
            $slug = trim(Route::Accessibility,"/");
            $updated = filemtime(SITE_ROOT . $page);

            $vars = [
                'layout' => $layout,
                'slug' => $slug,
                'updated' => $updated
            ];

            View::RenderTwig($page, $vars);
            break;

        case Route::Credits:

            $page = Template::Content.'/credits.html.twig';
            $layout = Layout::Subpage;
            $slug = trim(Route::Credits,"/");
            $updated = filemtime(SITE_ROOT . $page);

            $vars = [
                'layout' => $layout,
                'slug' => $slug,
                'updated' => $updated
            ];

            View::RenderTwig($page, $vars);
            break;
        
        case Route::SiteMap:

            $page = Template::Content.'/site-map.html.twig';
            $layout = Layout::SiteMap;

            $vars = [
                'layout' => $layout
            ];

            View::RenderTwig($page, $vars);
            break;
        
        case str_starts_with(REQUEST, Route::Feeds):

            class Feeds {
                const Index = Route::Feeds;
                const Success = Route::Feeds . "success/";
                const Error = Route::Feeds . "error/";
                const PostLayout = '/resources/layouts/subscribe_post_layout.html.twig';
                public static function LoadDefault() {
                    require SITE_ROOT . Layout::Feeds;
                }
            }

            if (REQUEST == Feeds::Index) {
                Feeds::LoadDefault();

            } else {
                switch (str_starts_with(REQUEST, Route::Feeds)) {
                    case Feeds::Success:
                        $vars = [
                            'h2' => 'yippe!!',
                            'message' => 'thanks for subscribing!'
                        ];

                        View::RenderTwig(Feeds::PostLayout, $vars);
                        break;

                    case Feeds::Error:
                        $vars = [
                            'h2' => 'aw shucks',
                            'message' => 'there was an error with your submission ☹'
                        ];

                        View::RenderTwig(Feeds::PostLayout, $vars);
                        break;

                    default:
                        Feeds::LoadDefault();
                }
            }

            break;

        case str_starts_with(REQUEST, Route::Guestbook):

            class Guestbook {
                const Index = Route::Guestbook;
                const Comment = Route::Guestbook . 'comment';
                const Page = Route::Guestbook . 'page';
                const Post = Route::Guestbook . 'post';
                const PostSuccess = Route::Guestbook . 'success';
                const PostError = Route::Guestbook .'error';
            }

            if (REQUEST == Guestbook::Post . "/") {
                require SITE_ROOT . Template::Includes . '/_guestbook_submit.php';

            } else {
                switch (str_starts_with(REQUEST, Route::Guestbook)) {
                    case Guestbook::Index:
                    case str_starts_with(REQUEST, Guestbook::Page):
                    case str_starts_with(REQUEST, Guestbook::PostSuccess):
                    case str_starts_with(REQUEST, Guestbook::PostError):

                        if (str_starts_with(REQUEST, Guestbook::Page)) {
                            $page_req = preg_split('/guestbook\/page/', $_SERVER['REQUEST_URI']);
                            $page = trim($page_req[1], "/");
                        }

                        if (REQUEST == Guestbook::Index || isset($_SERVER['HTTP_REFERER'])) {
                            session_start();
                            $_SESSION['form_start'] = true;

                        } elseif (!isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== Guestbook::Post . "/") {
                            header('Location: /guestbook');
                        }

                        require SITE_ROOT.Layout::Guestbook;
                        break;
                    
                    default:
                        require SITE_ROOT.Layout::Guestbook;
                }
            }

            break;
        
        default:
            Route::NotFound();
   }
?>
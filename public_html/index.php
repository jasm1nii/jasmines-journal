<?php
    putenv("ENV=dev");

    define("REQUEST", $_SERVER['REQUEST_URI']);
    define("SITE_ROOT", dirname($_SERVER['DOCUMENT_ROOT'], 1));

    define("CONFIG_DIR", SITE_ROOT . "/config/");
    define("ENV_CONF", CONFIG_DIR . "env_" . getenv('ENV') . ".ini");
    define("COMPOSER", SITE_ROOT . "/vendor/autoload.php");

    require_once COMPOSER;

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
        const Feeds = "/feeds/";
        const Guestbook = "/guestbook/";

        public static function NotFound() {
            http_response_code(404);
            require_once __DIR__.'/404.shtml';
        }
    }

    class Template {
        const Layouts = "/src/layouts/";
        const Includes = "/src/includes/";
        const Content = "/src/content/";
    }

    class Includes {
        const IncludesRoot = SITE_ROOT.Template::Includes;
        public static function Head() {
            include self::IncludesRoot . "head.shtml";
        }
        public static function HeaderNav() {
            include self::IncludesRoot . "headernav.shtml";
        }
        public static function Footer() {
            include self::IncludesRoot . "footer.shtml";
        }
    }

    class RenderConfig {
        const UtilsDir = SITE_ROOT . "/src/utils/";
        const Twig = self::UtilsDir . "twig_default_config.php";
        const MarkdownComments = self::UtilsDir  . "commonmark_comments_config.php";
        const MarkdownWithTOC = self::UtilsDir  . "commonmark_toc_config.php";
    }

    class View {
        const Subpage = Template::Layouts . "subpage_layout.html.twig";
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

            $layout = SITE_ROOT . Template::Layouts . "home_layout.php";
            require $layout;
            break;

        case Route::About:

            $partial = SITE_ROOT . Template::Includes . "_changelog_nav.php";
            include $partial;
            $nav_html = $nav->saveHTML();

            $page = Template::Content . "about.html.twig";
            $vars = [
                "layout" => Template::Layouts . "about_layout.html.twig",
                "nav" => $nav_html,
                "updated" => filemtime(SITE_ROOT . $page)
            ];

            View::RenderTwig($page, $vars);
            break;

        case Route::Changelog:

            $layout = SITE_ROOT . Template::Layouts . "changelog/changelog_index.php";

            require $layout;
            break;

        case str_starts_with(REQUEST, Route::Changelog):

            $path = ltrim(REQUEST, "/about");
            $file = "/" . rtrim($path, "/");
            $document_source = SITE_ROOT . Template::Content . $file . ".html.twig";

            if (file_exists($document_source)) {

                include SITE_ROOT.Template::Includes . "_changelog_nav.php";
                $nav_html = $nav->saveHTML();
                
                $layout = $twig->load(Template::Layouts . "changelog/changelog_subpage.html.twig");

                $page = Template::Content . $file . ".html.twig";
                $vars = [
                    "layout" => $layout,
                    "nav" => $nav_html
                ];

                View::RenderTwig($page, $vars);

            } else {
                Route::NotFound();
            }

            break;

        case Route::LinkGallery:

            class LinkGallery {

                const PartialsDir = Template::Content . "link-gallery";

                const Mutuals = self::PartialsDir . "/link-gallery_mutuals.html.twig";
                const _32bit = self::PartialsDir . "/link-gallery_32bitcafe.html.twig";
                const Etc = self::PartialsDir . "/link-gallery_other-sites.html.twig";

                public static function render() {
                    $layout = Template::Layouts . "link-gallery_layout.html.twig";
                    $updated = stat(SITE_ROOT . self::PartialsDir)['mtime'];
                    $vars = [
                        'updated' => $updated,
                        'mutuals' => self::Mutuals,
                        '_32bit' => self::_32bit,
                        'etc' => self::Etc
                    ];

                    View::RenderTwig($layout, $vars);
                }
            }

            LinkGallery::render();

            break;

        case str_starts_with(REQUEST, Route::Blog):

            class Blog {
                const LayoutsDir = Template::Layouts . "blog/";
                const MainIndex = SITE_ROOT . self::LayoutsDir . "blog_index.php";
                const ArticlesIndex = SITE_ROOT . self::LayoutsDir . "articles_index.php";
                const ArticleEntry = self::LayoutsDir . "article_entry.html.twig";
                const NotesIndex = SITE_ROOT . self::LayoutsDir . "notes_index.php";
                const NoteEntry = self::LayoutsDir . "note_entry.html.twig";

                public static function nav() {
                    include SITE_ROOT . Template::Includes . "_blog_nav.php";
                }

                public static function render($type) {
                    require_once RenderConfig::Twig;

                    $layout = $twig->load($type);
                    $slug = rtrim(REQUEST,'/');
                    $img_dir = '/_assets/media' . rtrim($slug,'/entry') . '/'; 
                    $content = Template::Content . $slug . ".html.twig";

                    if (file_exists(SITE_ROOT . $content)) {
                        echo $twig->render($content,
                            [
                                'layout' => $layout,
                                'slug' => $slug,
                                'src' => $img_dir,
                            ]);

                    } else {
                        Route::NotFound();
                    }
                }
            }

            switch (REQUEST) {

                case Route::Blog:
                case Route::Blog . "/index":
                    require Blog::MainIndex;
                    break;

                case (str_contains(REQUEST, Route::BlogArticles)):

                    switch (REQUEST) {

                        case (str_ends_with(REQUEST, ".xml")):
                            require $_SERVER['DOCUMENT_ROOT'] . "/articles.xml";
                            break;
                        
                        case REQUEST == "/blog/articles/":
                            require Blog::ArticlesIndex;
                            break;

                        default:
                            Blog::render(Blog::ArticleEntry);
                    }

                    break;

                case (str_contains(REQUEST, Route::BlogNotes)):

                    switch (REQUEST) {

                        case (str_ends_with(REQUEST, ".xml")):
                            require $_SERVER['DOCUMENT_ROOT'] . "/notes.xml";
                            break;

                        case REQUEST == "/blog/notes/":
                            require Blog::NotesIndex;
                            break;

                        default:
                            Blog::render(Blog::NoteEntry);
                    }

                    break;

                default:
                    Route::NotFound();
            }

            break;

        case Route::Resources:

            $layout = Template::Layouts . "resources/resources_index.html.twig";
            $updated = filemtime(SITE_ROOT . Template::Content . "resources/resources_index.md");
            $vars = [
                'updated' => $updated
            ];

            View::RenderTwig($layout, $vars);
            break;

        case str_starts_with(REQUEST, Route::Resources):

            $path = preg_split(('/\/(resources)\//'),REQUEST);
            $file_base = rtrim($path[1],"/");
            $category = SITE_ROOT . Template::Content . "resources/categories";

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
                        'layout' => $twig->load(Template::Layouts . "resources/resources_subpage.html.twig"),
                        'updated' => $updated,
                        'legend' => file_get_contents(SITE_ROOT.Template::Content . "resources/_legend.md"),
                        'content'=> $content,
                        'parent' => $parent
                    ]);
            }

            $page = $category . $file_base . ".html.twig";
            
            if (file_exists($page)) {

                renderResourcesPage($category . $file_base . ".md", $page);

            } elseif (preg_match('/\/(resources)\/.+/', REQUEST, $matches)) {

                $path = preg_split('/\/(resources)\//',$matches[0]);
                $file_base = $category.$path[1];
                $page = $file_base . "index.html.twig";

                if (file_exists($page)) {
                    renderResourcesPage($file_base . "index.md", $page);

                } else {
                    Route::NotFound();
                }
                
            } else {
                Route::NotFound();
            }

            break;

        case Route::Accessibility:

            $content = Template::Content . "accessibility.html.twig";
            $layout = View::Subpage;
            $slug = trim(Route::Accessibility,"/");
            $updated = filemtime(SITE_ROOT . $content);

            $vars = [
                'layout' => $layout,
                'slug' => $slug,
                'updated' => $updated
            ];

            View::RenderTwig($content, $vars);
            break;

        case Route::Credits:

            $content = Template::Content . "credits.html.twig";
            $layout = View::Subpage;
            $slug = trim(Route::Credits,"/");
            $updated = filemtime(SITE_ROOT . $content);

            $vars = [
                'layout' => $layout,
                'slug' => $slug,
                'updated' => $updated
            ];

            View::RenderTwig($content, $vars);
            break;
        
        case Route::SiteMap:

            $content = Template::Content . "site-map.html.twig";
            $layout = Template::Layouts . "site-map_layout.html.twig";

            $vars = [
                'layout' => $layout
            ];

            View::RenderTwig($content, $vars);
            break;
        
        case str_starts_with(REQUEST, Route::Feeds):

            class Feeds {
                const Index = Route::Feeds;
                const Success = Route::Feeds . "success/";
                const Error = Route::Feeds . "error/";

                const IndexLayout = Template::Layouts . "feeds/feeds_index.php";
                const POSTLayout = Template::Layouts . "feeds/feeds_post.html.twig";

                public static function loadSubpage($title, $message) {
                    $vars = [
                        "h2" => $title,
                        "message" => $message
                    ];

                    View::RenderTwig(self::POSTLayout, $vars);
                }

                public static function loadDefault() {
                    require SITE_ROOT . self::IndexLayout;
                }
            }

            if (REQUEST == Feeds::Index) {

                Feeds::loadDefault();

            } else {

                switch (REQUEST) {
                    case Feeds::Success:
                        Feeds::loadSubpage("yippee!!", "thanks for subscribing!");
                        break;

                    case Feeds::Error:
                        Feeds::loadSubpage("aw shucks", "there was an error with your submission ☹");
                        break;

                    default:
                        Feeds::loadDefault();
                }

            }

            break;

        case str_starts_with(REQUEST, Route::Guestbook):

            class Guestbook {
                const Index = Route::Guestbook;
                const Comment = Route::Guestbook . 'comment';
                const Page = Route::Guestbook . 'page';
                const PostSuccess = Route::Guestbook . 'success';
                const PostError = Route::Guestbook .'error';

                public static function sendPOST() {
                    require SITE_ROOT . Template::Includes . "_guestbook_submit.php";
                }

                public static function render() {
                    require SITE_ROOT . Template::Layouts . "guestbook_layout.php";
                }
            }

            if (REQUEST == "/guestbook/post/") {

                Guestbook::sendPOST();

            } else {
                switch (REQUEST) {
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

                        Guestbook::render();
                        break;
                    
                    default:
                        Guestbook::render();
                }
            }

            break;
        
        default:
            Route::NotFound();
   }
?>
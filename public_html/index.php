<?php
    putenv("ENV=dev");

    define("REQUEST", $_SERVER['REQUEST_URI']);
    define("SITE_ROOT", dirname($_SERVER['DOCUMENT_ROOT'], 1));
    define("ENV_CONF",  SITE_ROOT . "/config/env_" . getenv('ENV') . ".ini");

    define(
        "DIR",
        [
            'models'    => "/src/models/",
            'layouts'   => "/src/layouts/",
            'includes'  => "/src/includes/",
            'content'   => "/src/content/"
        ]
    );

    require_once SITE_ROOT . "/vendor/autoload.php";

    class Route {

        const Resources = "/resources/";
        const Accessibility = "/accessibility/";
        const Credits = "/credits/";
        const SiteMap = "/site-map/";

        public static function execute($route_file) {
            require SITE_ROOT . DIR['models'] . $route_file;

        }

        public static function NotFound() {
            http_response_code(404);
            require_once __DIR__.'/404.shtml';

        }
    }

    class Includes {
        const IncludesRoot = SITE_ROOT . DIR['includes'];

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
        const Dir = SITE_ROOT . "/src/utils/";
        const Twig = self::Dir . "twig_global.php";
        const MarkdownComments = self::Dir  . "commonmark_comments.php";
        const MarkdownWithTOC = self::Dir  . "commonmark_toc.php";
    }

    class View {

        const Utils = SITE_ROOT . "/src/utils/";
        const Subpage = DIR['layouts'] . "subpage_layout.html.twig";

        public static function Markdown($md_file) {

            include self::Utils . "/commonmark.php";
            $output = $converter->convert($md_file);
            return $output;

        }

        public static function Twig($page, $vars, $path) {

            require self::Utils . "twig_global.php";

            if ($vars == null) {
                $vars = [];
            }

            if ($path !== null) {
                $loader->addPath($path);
            }

            echo $twig->render($page, $vars);

        }
    }

    switch (REQUEST) {
        case "":
        case "/":
        case "/index":

            Route::execute('home/home.php');
            break;

        case str_starts_with(REQUEST, "/about/"):

            Route::execute('about/about.php');
            break;

        case "/link-gallery/":

            Route::execute('link-gallery/link-gallery.php');
            break;

        case str_starts_with(REQUEST, "/blog/"):

            Route::execute('blog/blog.php');
            break;

        case "/resources/":
        case "/resources/index/":

            $layout = DIR['layouts'] . "resources/resources_index.html.twig";
            $updated = filemtime(SITE_ROOT . DIR['content'] . "resources/resources_index.md");
            $vars = [
                'updated' => $updated
            ];

            View::Twig($layout, $vars, null);
            break;

        case str_starts_with(REQUEST, "/resources/"):

            $path = preg_split(('/\/(resources)/'), REQUEST);
            $file_base = rtrim($path[1], "/");
            $category = SITE_ROOT . DIR['content'] . "resources/categories";

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

                $twig_path = preg_split('/resources/', $twig_file);

                echo $twig->render(DIR['content'] . "resources" . $twig_path[1],
                    [
                        'layout' => DIR['layouts'] . "resources/resources_subpage.html.twig",
                        'updated' => $updated,
                        'legend' => file_get_contents(SITE_ROOT.DIR['content'] . "resources/_legend.md"),
                        'content'=> $content,
                        'parent' => $parent
                    ]);
            }

            $page = $category . $file_base . ".html.twig";
            
            if (file_exists($page)) {

                renderResourcesPage($category . $file_base . ".md", $page);

            } elseif (preg_match('/\/(resources)\/.+/', REQUEST, $matches)) {
                
                $path = preg_split('/\/(resources)/', $matches[0]);
                $file_base = $category . $path[1];
                
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

            $content = DIR['content'] . "accessibility.html.twig";
            $layout = View::Subpage;
            $slug = trim(Route::Accessibility,"/");
            $updated = filemtime(SITE_ROOT . $content);

            $vars = [
                'layout' => $layout,
                'slug' => $slug,
                'updated' => $updated
            ];

            View::Twig($content, $vars);
            break;

        case Route::Credits:

            $content = DIR['content'] . "credits.html.twig";
            $layout = View::Subpage;
            $slug = trim(Route::Credits,"/");
            $updated = filemtime(SITE_ROOT . $content);

            $vars = [
                'layout' => $layout,
                'slug' => $slug,
                'updated' => $updated
            ];

            View::Twig($content, $vars);
            break;
        
        case Route::SiteMap:

            $content = DIR['content'] . "site-map.html.twig";
            $layout = DIR['layouts'] . "site-map_layout.html.twig";

            $vars = [
                'layout' => $layout
            ];

            View::Twig($content, $vars);
            break;
        
        case str_starts_with(REQUEST, "/feeds/"):

            Route::execute('feeds/feeds.php');
            break;

        case str_starts_with(REQUEST, "/guestbook/"):

            Route::execute('guestbook/guestbook.php');
            break;
        
        default:
            Route::NotFound();
   }
?>
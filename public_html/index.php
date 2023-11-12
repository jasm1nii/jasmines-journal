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
        case "/link-gallery/index/":

            Route::execute('link-gallery/link-gallery.php');
            break;

        case str_starts_with(REQUEST, "/blog/"):

            Route::execute('blog/blog.php');
            break;

        case str_starts_with(REQUEST, "/resources/"):

            Route::execute('resources/resources.php');
            break;

        case "/accessibility/":
        case "/accessibility/index/":

            $content = DIR['content'] . "accessibility.html.twig";
            $layout = View::Subpage;
            $slug = trim("/accessibility/", "/");
            $updated = filemtime(SITE_ROOT . $content);

            $vars = [
                'layout' => $layout,
                'slug' => $slug,
                'updated' => $updated
            ];

            View::Twig($content, $vars, null);
            break;

        case "/credits/":
        case "/credits/index/":

            $content = DIR['content'] . "credits.html.twig";
            $layout = View::Subpage;
            $slug = trim("/credits/", "/");
            $updated = filemtime(SITE_ROOT . $content);

            $vars = [
                'layout' => $layout,
                'slug' => $slug,
                'updated' => $updated
            ];

            View::Twig($content, $vars, null);
            break;
        
        case "/site-map/":
        case "/site-map/index/":

            $content = DIR['content'] . "site-map.html.twig";
            $layout = DIR['layouts'] . "site-map_layout.html.twig";

            $vars = [
                'layout' => $layout
            ];

            View::Twig($content, $vars, null);
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
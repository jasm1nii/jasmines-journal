<?php
    namespace Router;

    putenv("ENV=dev");
    
    define("SITE_ROOT", dirname(__DIR__,1));
    define("ENV_CONF", SITE_ROOT . "/config/env_" . getenv('ENV') . ".ini");
    define("COMPOSER", SITE_ROOT . "/src/vendor/autoload.php");

    // define("REQUEST", $_SERVER['REQUEST_URI']);

    class Config {
        const SRC_DIR = SITE_ROOT . "/config/";
        const TWIG = self::SRC_DIR . "twig_default_config.php";
        const MARKDOWN_COMMENTS = self::SRC_DIR . "commonmark_comments_config.php";
        const MARKDOWN_WITH_TOC = self::SRC_DIR . "commonmark_toc_config.php";
    }

    class DocumentSrc {
        const SRC_DIR = "/resources/";
        const LAYOUTS_DIR = self::SRC_DIR . "layouts/";
        const INCLUDES_DIR = self::SRC_DIR . "includes/";
        const CONTENT_DIR = self::SRC_DIR . "content/";
    }

    class Includes {
        public static function Head() {
            include DocumentSrc::INCLUDES_DIR . "head.shtml";
        }
        public static function HeaderNav() {
            include DocumentSrc::INCLUDES_DIR . "headernav.shtml";
        }
        public static function Footer() {
            include DocumentSrc::INCLUDES_DIR . "footer.shtml";
        }
    }

    class Render {
        public static function useTwig($page, $vars) {
            require_once Config::TWIG;
            if ($vars == null) {
                $vars = [];
            }
            echo $twig->render($page, $vars);
        }
    }

    class Route {
        public $name;
        public $url;
        public $layout;
        
        function __construct($name, $url, $layout) {
            $this->name = $name;
            $this->url = $url;
            $this->layout = $layout;
        }
        function getName() {
            return $this->name;
        }
        function getURL() {
            return $this->url;
        }
        function getLayout() {
            return $this->layout;
        }
        public static function NotFound() {
            http_response_code(404);
            require_once __DIR__.'/404.shtml';
        }
    }

    // test

    $page = new Route("Index", "index.html", "index_layout.html");
    echo $page->getName();
?>
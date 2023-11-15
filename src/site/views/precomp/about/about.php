<?php

    namespace Site\Views\Layouts;

    use Core\Views\Render\View as View;

    //

    trait About {

        public static function Nav() {

            include SITE_ROOT . DIR['includes'] . "_about_nav.php";
            
            return $nav_html;

        }

    }

    //

    final class AboutIndex extends View {

        use About;

        private static $layout = DIR['layouts'] . "about_layout.html.twig";

        private static $content = DIR['content'] . "about.html.twig";

        function __construct() {

            $vars = [
                "layout" => self::$layout,
                "nav" => About::Nav(),
                "updated" => filemtime(SITE_ROOT . $content)
            ];

            parent::Twig(self::$content, $vars, null);

        }

    }

    //

    final class ChangelogIndex extends View {

        use About;

        private static $main_layout = DIR['layouts'] . "changelog/changelog_index.html.twig";

        private static $main_content_abs = SITE_ROOT . DIR['content'] . 'changelog/index.md';

        private static $archive_nav_layout = DIR['layouts'] . 'changelog/_index_subnav.html.twig';

        private static function getArchiveNav() {

            require parent::TWIG;

            include __DIR__ . "changelog_archive.php";

            $archive_nav_html =
                $twig->render(
                    self::$archive_nav_layout,
                    [
                        "years" => $year_label,
                        "months" => $month_label
                    ]);

            return $archive_nav_html;

        }

        function __construct() {

            $content = file_get_contents($main_content_abs);

            $vars = [
                "nav" => About::Nav(),
                'archivenav' => self::getArchiveNav(),
                'content' => $content
            ];
            
            parent::Twig(self::$main_layout, $vars, null);

        }

    }

    //

    final class ChangelogSubpage extends View {

        use About;

        private static $layout =  DIR['layouts'] . "changelog/changelog_subpage.html.twig";

        function __construct() {

            $path = ltrim(REQUEST, "/about");
            
            $file = "/" . rtrim($path, "/");

            $content = DIR['content'] . $file . ".html.twig";
            
            $vars = [
                "layout" => self::$layout,
                "nav" => About::Nav()
            ];

            parent::Twig($content, $vars, null);

        }

    }

?>
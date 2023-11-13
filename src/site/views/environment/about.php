<?php

    trait About {

        public static function Nav() {

            $headernav = SITE_ROOT . DIR['includes'] . "_about_nav.php";

            include $headernav;
            
            return $nav_html;

        }

    }

    class AboutIndex extends View {

        use About;

        function __construct() {

            $layout = DIR['layouts'] . "about_layout.html.twig";

            $content = DIR['content'] . "about.html.twig";

            $vars = [
                "layout" => $layout,
                "nav" => About::Nav(),
                "updated" => filemtime(SITE_ROOT . $content)
            ];

            parent::Twig($content, $vars, null);

        }

    }

    class ChangelogIndex extends View {

        use About;

        private static function getArchiveNav() {

            require parent::TWIG;

            include SITE_ROOT . DIR['models'] . "changelog/changelog_archive.php";

            $archive_nav = DIR['layouts'] . 'changelog/_index_subnav.html.twig';

            $archive_nav_html =
                $twig->render(
                    $archive_nav,
                    [
                        "years" => $year_label,
                        "months" => $month_label
                    ]);

            return $archive_nav_html;

        }

        function __construct() {

            $layout = DIR['layouts'] . "changelog/changelog_index.html.twig";

            $content_path =  SITE_ROOT . DIR['content'] . 'changelog/index.md';

            $content = file_get_contents($content_path);

            $vars = [
                "nav" => About::Nav(),
                'archivenav' => self::getArchiveNav(),
                'content' => $content
            ];
            
            parent::Twig($layout, $vars, null);

        }

    }

    class ChangelogSubpage extends View {

        use About;

        function __construct() {

            $path = ltrim(REQUEST, "/about");
            
            $file = "/" . rtrim($path, "/");

            $page = DIR['content'] . $file . ".html.twig";

            $layout = DIR['layouts'] . "changelog/changelog_subpage.html.twig";
            
            $vars = [
                "layout" => $layout,
                "nav" => About::Nav()
            ];

            parent::Twig($page, $vars, null);

        }

    }

?>
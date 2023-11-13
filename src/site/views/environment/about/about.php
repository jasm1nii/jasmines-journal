<?php

    trait About {

        public static function Nav() {

            $headernav = SITE_ROOT . DIR['includes'] . "_about_nav.php";

            include $headernav;
            
            return $nav_html;

        }

    }

    class AboutIndex {

        use About;

        function __construct() {

            $layout = DIR['layouts'] . "about_layout.html.twig";

            $content = DIR['content'] . "about.html.twig";

            $vars = [
                "layout" => $layout,
                "nav" => About::Nav(),
                "updated" => filemtime(SITE_ROOT . $content)
            ];

            View::Twig($content, $vars, null);

        }

    }

    class ChangelogIndex {

        use About;

        function __construct() {

            $layout = DIR['layouts'] . "changelog/changelog_index.html.twig";

            $content_path =  SITE_ROOT . DIR['content'] . 'changelog/index.md';

            $content = file_get_contents($content_path);

            function getArchiveNav() {

                require RenderConfig::Twig;

                include SITE_ROOT . DIR['models'] . "changelog/changelog_archive.php";

                $archive_nav = '/src/layouts/changelog/includes/_changelog_archive.html.twig';

                $archive_nav_html =
                    $twig->render(
                        $archive_nav,
                        [
                            "years" => $year_label,
                            "months" => $month_label
                        ]);

                return $archive_nav_html;

            }

            $vars = [
                "nav" => About::Nav(),
                'archivenav' => getArchiveNav(),
                'content' => $content
            ];
            
            View::Twig($layout, $vars, null);

        }

    }

    class ChangelogSubpage {

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

            View::Twig($page, $vars, null);

        }

    }

?>
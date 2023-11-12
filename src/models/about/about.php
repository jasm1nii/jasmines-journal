<?php

    class About {
        const Partial = SITE_ROOT . DIR['includes'] . "_headernav_about-changelog.php";
        public static function Nav() {
            include self::Partial;
            return $nav_html;
        }
    }

    switch (REQUEST) {

        case "/about/":

            $page = DIR['content'] . "about.html.twig";
            $vars = [
                "layout" => DIR['layouts'] . "about_layout.html.twig",
                "nav" => About::Nav(),
                "updated" => filemtime(SITE_ROOT . $page)
            ];

            View::Twig($page, $vars, null);

            break;

        case str_starts_with(REQUEST, "/about/changelog/"):

            switch (REQUEST) {

                case "/about/changelog/":

                    class ChangelogIndex {

                        const Layout = DIR['layouts'] . "changelog/changelog_index.html.twig";

                        const Dir = SITE_ROOT . DIR['content'] . 'changelog/';

                        const Content = self::Dir . 'index.md';

                        function __construct() {

                            function getArchiveNav() {

                                require RenderConfig::Twig;

                                include SITE_ROOT . DIR['models'] . "changelog/_changelog_archive_src.php";

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

                            $content = file_get_contents(self::Content);

                            $vars = [
                                "nav" => About::Nav(),
                                'archivenav' => getArchiveNav(),
                                'content' => $content
                            ];
                            
                            View::Twig(self::Layout, $vars, null);
                        }

                    }

                    new ChangelogIndex();

                    break;

                default:
                    
                    $path = ltrim(REQUEST, "/about");
                    $file = "/" . rtrim($path, "/");
                    $document_source = SITE_ROOT . DIR['content'] . $file . ".html.twig";
        
                    if (file_exists($document_source)) {
                        
                        $layout = DIR['layouts'] . "changelog/changelog_subpage.html.twig";
        
                        $page = DIR['content'] . $file . ".html.twig";

                        $vars = [
                            "layout" => $layout,
                            "nav" => About::Nav()
                        ];
        
                        View::Twig($page, $vars, null);
        
                    } else {

                        Route::NotFound();
                        
                    }

            }

            break;
    
    }

?>
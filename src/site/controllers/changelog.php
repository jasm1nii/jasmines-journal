<?php
    switch (REQUEST) {

        case "/about/changelog/":
        case "/about/changelog/index/":

            class ChangelogIndex extends About {

                const Layout = DIR['layouts'] . "changelog/changelog_index.html.twig";
                const ContentDir = SITE_ROOT . DIR['content'] . 'changelog/';
                const Content = self::ContentDir . 'index.md';

                function __construct() {

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
?>
<?php
    class Blog {

        const LayoutsDir = DIR['layouts'] . "blog/";

        const MainIndex = SITE_ROOT . self::LayoutsDir . "blog_index.php";
        const ArticlesIndex = SITE_ROOT . self::LayoutsDir . "articles_index.php";
        const ArticleEntry = self::LayoutsDir . "article_entry.html.twig";
        const NotesIndex = SITE_ROOT . self::LayoutsDir . "notes_index.php";
        const NoteEntry = self::LayoutsDir . "note_entry.html.twig";

        public static function nav() {

            include __DIR__ . "/blog_nav.php";
            return $nav_html;

        }

        public static function render($type) {

            require_once RenderConfig::Twig;

            $layout = $twig->load($type);
            $slug = rtrim(REQUEST,'/');
            $img_dir = '/_assets/media' . rtrim($slug,'/entry') . '/'; 
            $content = DIR['content'] . $slug . ".html.twig";

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

        case "/blog/":
        case "/blog/index/":
            require Blog::MainIndex;
            break;

        case (str_contains(REQUEST, "/blog/articles/")):

            switch (REQUEST) {

                case (str_ends_with(REQUEST, ".xml")):
                    require $_SERVER['DOCUMENT_ROOT'] . "/articles.xml";
                    break;
                
                case "/blog/articles/":
                case "/blog/articles/index/":
                    require Blog::ArticlesIndex;
                    break;

                default:
                    Blog::render(Blog::ArticleEntry);
            }

            break;

        case (str_contains(REQUEST, "/blog/notes/")):

            switch (REQUEST) {

                case (str_ends_with(REQUEST, ".xml")):

                    require $_SERVER['DOCUMENT_ROOT'] . "/notes.xml";
                    break;

                case "/blog/notes/":
                case "/blog/notes/index/":

                    require Blog::NotesIndex;
                    break;

                default:
                
                    Blog::render(Blog::NoteEntry);
            }

            break;

        default:
            Route::NotFound();
    }
?>
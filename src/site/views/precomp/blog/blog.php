<?php

    namespace Site\Views\Layouts;

    use Site\Views\Render\View as View;

    trait Blog {

        public static function nav() {

            include SITE_ROOT . DIR['includes'] . "_blog_nav.php";
            return $nav_html;

        }

    }

    final class BlogIndex extends View {

        use Blog;

        private static function notesPreview() {

            include __DIR__ . "/main_notes_preview.php";
            return $notes_preview;

        }

        private static function articlesPreview() {

            include __DIR__ . "/main_articles_preview.php";
            return implode("", $content);

        }

        public function __construct() {

            $page = DIR['layouts'] . "blog/blog_layout.html.twig";

            $vars = [
                'nav' => Blog::nav(),
                'notes_preview' => self::notesPreview(),
                'articles_preview' => self::articlesPreview()
            ];

            parent::Twig($page, $vars, null);

        }

    }

    final class ArticlesIndex extends View {

        use Blog;

        private static function showEntries() {

            include __DIR__ . "/subpages/articles_index_preview.php";
            return implode("", $content);

        }

        public function __construct() {

            $page = DIR['layouts'] . "blog/articles/articles_index_layout.html.twig";

            $vars = [
                'nav' => Blog::nav(),
                'entries' => self::showEntries()
            ];

            parent::Twig($page, $vars, null);

        }

    }

    final class NotesIndex extends View {

        use Blog;

        private static function showEntries() {

            include __DIR__ . "/subpages/notes_index_preview.php";
            return implode("", $content);

        }

        public function __construct() {

            $page = DIR['layouts'] . "blog/notes/notes_index_layout.html.twig";

            $vars = [
                'nav' => Blog::nav(),
                'entries' => self::showEntries()
            ];

            parent::Twig($page, $vars, null);

        }

    }

    final class BlogEntry extends View {

        use Blog;

        public function __construct($blog_type) {

            if ($blog_type == 'article') {

                $layout = DIR['layouts'] . "blog/articles/article_entry.html.twig";

            } elseif ($blog_type == 'note') {

                $layout = DIR['layouts'] . "blog/notes/note_entry.html.twig";

            }

            $slug = rtrim(REQUEST,'/');

            $img_dir = '/_assets/media' . rtrim($slug,'/entry') . '/';

            $content = DIR['content'] . $slug . ".html.twig";

            $vars = [
                'layout' => $layout,
                'slug' => $slug,
                'src' => $img_dir,
                'nav' => Blog::nav()
            ]; 

            if (file_exists(SITE_ROOT . $content)) {
                
                parent::Twig($content, $vars, null);

            } else {

                Route::NotFound();

            }

        }

    }

?>
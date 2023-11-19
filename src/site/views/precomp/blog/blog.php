<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\View as View;
    use JasminesJournal\Site\Views\Partials as Partials;

    //

    trait Blog {

        public static function nav() {

            return Partials\BlogNav::make();

        }

    }

    //

    final class BlogIndex extends View {

        use Blog;

        private static function makeArticlesList() {

            return implode("", Partials\BlogIndex_Articles::make());

        }

        private static function makeLatestNote() {

            return Partials\BlogIndex_Notes::make();

        }

        public function __construct() {

            $page = DIR['layouts'] . "blog/blog_layout.html.twig";

            $vars = [
                'nav' => Blog::nav(),
                'notes_preview' => self::makeLatestNote(),
                'articles_archive' => self::makeArticlesList()
            ];

            parent::Twig($page, $vars, null, true);
            
        }

    }

    final class ArticlesIndex extends View {

        use Blog;

        private static function showEntries() {

            return implode("", Partials\ArticlesIndex_List::make());

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

            return implode("", Partials\NotesIndex_List::make());

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
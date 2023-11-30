<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\View as View;
    use JasminesJournal\Site\Views\Partials as Partials;


    final class BlogIndex extends View {

        public function __construct() {

            $page = DIR['layouts'] . "blog/blog_layout.html.twig";

            $vars = [
                'nav'               => Partials\Blog\Nav::make(),
                'notes_preview'     => Partials\Blog\Notes::makeList(),
                'articles_archive'  => implode("", Partials\Blog\Articles::makeList())
            ];

            parent::Twig($page, $vars, null, true);
            
        }

    }

    final class ArticlesIndex extends View {

        private static function showEntries() {

            $entries_array = Partials\Blog\Subpage\Articles::renderIndex();

            return implode("", $entries_array);

        }

        public function __construct() {

            $page = DIR['layouts'] . "blog/articles/articles_index_layout.html.twig";

            $vars = [
                'nav'       => Partials\Blog\Nav::make(),
                'entries'   => self::showEntries()
            ];

            parent::Twig($page, $vars, null);

        }

    }

    final class NotesIndex extends View {

        private static function showEntries() {

            $entries_array = Partials\Blog\Subpage\Notes::renderIndex();

            return implode("", $entries_array);

        }

        public function __construct() {

            $page = DIR['layouts'] . "blog/notes/notes_index_layout.html.twig";

            $vars = [
                'nav'       => Partials\Blog\Nav::make(),
                'entries'   => self::showEntries()
            ];

            parent::Twig($page, $vars, null);

        }

    }

    final class BlogEntry extends View {

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
                'layout'    => $layout,
                'slug'      => $slug,
                'src'       => $img_dir,
                'nav'       => Partials\Blog\Nav::make()
            ]; 

            if (file_exists(SITE_ROOT . $content)) {
                
                parent::Twig($content, $vars, null);

            } else {

                Route::NotFound();

            }

        }

    }

?>
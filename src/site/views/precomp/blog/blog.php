<?php

    namespace Site\Views\Layouts;

    use Core\Views\Render\View as View;

    //

    trait Blog {

        public static function nav() {

            include SITE_ROOT . DIR['includes'] . "_blog_nav.php";
            return $nav_html;

        }

    }

    //

    final class BlogIndex extends View {

        use Blog;

        private static function makeArticlesPreview() {

            include __DIR__ . "/blog_index_articles.php";
            return implode("", \Site\Views\Partials\BlogIndex_Articles::make());

        }

        private static function makeNotesPreview() {

            $notes_xml = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/notes.xml');
            $notes_doc = new \DOMDocument();
            $notes_doc->loadXML($notes_xml);

            $notes_pub =
                $notes_doc->getElementsByTagName('published')->item(0)->textContent;

            $notes_link =
                $notes_doc->getElementsByTagName('id')->item(1)->textContent;

            $notes_title =
                $notes_doc->getElementsByTagName('title')->item(1)->textContent;

            $notes_title_html =
                str_replace(" | jasmine's notes", "", $notes_title);

            $notes_content =
                $notes_doc->getElementsByTagName('content')->item(0)->textContent;
            
            //

            $notes_preview =
                "<h3 class='p-name'><time datetime='{$notes_pub}'><a href='{$notes_link}'>{$notes_title_html}</a></time></h3>";

            $notes_preview .=
                "<p id='latest-note-content' class='e-content'>{$notes_content}</p>";

            return $notes_preview;

        }

        public function __construct() {

            $page = DIR['layouts'] . "blog/blog_layout.html.twig";

            $vars = [
                'nav' => Blog::nav(),
                'notes_preview' => self::makeNotesPreview(),
                'articles_archive' => self::makeArticlesPreview()
            ];

            parent::Twig($page, $vars, null, true);
            
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
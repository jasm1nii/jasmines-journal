<?php

    namespace Site\Views\Layouts;

    use Site\Views\Render\View as View;

    trait Blog {

        public static function nav() {

            include __DIR__ . "/_blog_nav.php";
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

?>
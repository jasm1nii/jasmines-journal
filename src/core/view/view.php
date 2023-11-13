<?php

    class View {

        const Dir = SITE_ROOT . "/src/utils/";

        const Twig = self::Dir . "twig_global.php";
        const MarkdownComments = self::Dir  . "commonmark_comments.php";
        const MarkdownWithTOC = self::Dir  . "commonmark_toc.php";

        public static function Markdown($md_file) {

            require self::Dir . "/commonmark.php";

            $output = $converter->convert($md_file);

            return $output;

        }

        public static function Twig($page, $vars, $path) {

            require self::Dir . "twig_global.php";

            if ($vars == null) {
                $vars = [];
            }

            if ($path !== null) {
                $loader->addPath($path);
            }

            echo $twig->render($page, $vars);

        }

    }

    class Layout extends View {

        public $subpage;

        public static function useDefault() {

            $subpage = DIR['layouts'] . "subpage_layout.html.twig";
            return $subpage;

        }

    }
    
?>
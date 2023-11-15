<?php

    namespace Site\Views\Render;

    class View {

        const DIR = __DIR__ . '/extensions/';

        const TWIG = self::DIR . "twig_global.php";
        const MARKDOWN_COMMENTS = self::DIR  . "commonmark_comments.php";
        const MARKDOWN_WITH_TOC = self::DIR  . "commonmark_toc.php";

        public static function Markdown($md_file) {

            require self::DIR . "/commonmark.php";

            $output = $converter->convert($md_file);

            return $output;

        }

        public static function Twig($page, $vars, $path) {

            require self::TWIG;

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

        public static function useDefault() {

            $subpage = DIR['layouts'] . "subpage_layout.html.twig";
            
            return $subpage;

        }

    }
    
?>
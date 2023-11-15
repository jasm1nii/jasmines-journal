<?php

    namespace Core\Views\Render;

    use Core\Views\Render\Extension\Twig as Twig;

    class View {

        const DIR = __DIR__ . '/extensions/';

        const TWIG = self::DIR . "twig_global.php";
        const MARKDOWN_COMMENTS = self::DIR  . "commonmark_comments.php";
        const MARKDOWN_WITH_TOC = self::DIR  . "commonmark_toc.php";

        public static function Twig($page, $vars, $path = null) {

            require self::TWIG;

            $twig = new Twig();

            if ($vars == null) {
                $vars = [];
            }

            $loader = $twig->loadBaseLoader($path);

            $twig->createEnvAndMake($loader, $page, $vars);

        }

    }

    class Layout extends View {

        public static function useDefault() {

            $subpage = DIR['layouts'] . "subpage_layout.html.twig";
            
            return $subpage;

        }

    }
    
?>
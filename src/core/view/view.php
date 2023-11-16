<?php

    namespace Core\Views\Render;

    class View {

        const DIR = __DIR__ . '/extensions/';
        const TWIG = self::DIR . "twig_global.php";
        const TWIG_PARTIAL = self::DIR . "twig_partial.php";
        const MARKDOWN_COMMENTS = self::DIR  . "commonmark_comments.php";
        const MARKDOWN_WITH_TOC = self::DIR  . "commonmark_toc.php";

        public static function Twig($page, $vars, $path = null) {

            require self::TWIG;

            $twig = new Extension\Twig();

            if ($vars == null) {
                $vars = [];
            }

            $loader = $twig->loadBaseLoader($path);
            $twig->createEnvAndMake($loader, $page, $vars);

        }

    }
    
?>
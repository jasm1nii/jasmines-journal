<?php

    namespace JasminesJournal\Core\Views\Render;

    class View {

        public static function Twig($page, $vars, $path = null) {

            $twig = new Extension\Twig();

            if ($vars == null) {
                $vars = [];
            }

            $loader = $twig->loadBaseLoader($path);
            $twig->createEnvAndMake($loader, $page, $vars);

        }

    }
    
?>
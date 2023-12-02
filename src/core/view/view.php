<?php

    namespace JasminesJournal\Core\Views\Render;

    class View {

        public static function Twig(string $page, array $vars, string $path = null) {

            $twig = new Extension\Twig();

            $vars ?? [];

            $loader = $twig->loadBaseLoader($path);
            $twig->createEnvAndMake($loader, $page, $vars);

        }

    }
    
?>
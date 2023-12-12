<?php

    namespace JasminesJournal\Core\Views\Render;

    class View {

        public static function Twig(string $page, array|null $vars, string $path = null): void {

            $twig = new Extension\Twig();

            $vars ??= [];

            $loader = $twig->loadBaseLoader($path);
            $twig->createEnvAndMake($loader, $page, $vars);

        }

    }

    abstract class Layout extends View {

        protected string $layout;
        protected string $content;
        protected static string $includes_path;

        public function __construct() {

            $this->render();

        }
        
        abstract protected function render(): void;

    }
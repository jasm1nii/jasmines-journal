<?php

    namespace JasminesJournal\Core\View\Main;

    abstract class Layout {

        protected string $layout;
        protected string $content;
        protected static string $includes_path;

        public function __construct() {

            $this->render();

        }

        public static function renderTwig(
            string $page,
            array|null $vars,
            string $path = null
        ): void {

            $twig = new Extension\Twig();

            $vars ??= [];

            $loader = $twig->loadBaseLoader($path);
            $twig->createEnvAndMake($loader, $page, $vars);

        }
        
        abstract protected function render(): void;

    }
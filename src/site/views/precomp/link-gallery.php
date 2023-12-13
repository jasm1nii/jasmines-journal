<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\Layout;
    use JasminesJournal\Core\Route;

    final class LinkGallery extends Layout {

        protected string $layout = DIR['layouts'] . "link-gallery_layout.html.twig";
        protected static string $includes_path = DIR['content'] . "link-gallery";
        
        final protected function render(): void {

            $vars = [
                'updated'   => Route::getLastUpdated(SITE_ROOT . self::$includes_path . "/*"),
            ];

            parent::Twig($this->layout, $vars, self::$includes_path);

        }

    }
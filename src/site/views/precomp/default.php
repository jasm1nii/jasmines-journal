<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Route;

    trait DefaultLayout {

        private const LAYOUT = DIR['layouts'] . "subpage_layout.html.twig";

        final public function setVars(): array {

            return $vars = [
                'layout'    => self::LAYOUT,
                'slug'      => Route::useCleanSlug(),
                'updated'   => filemtime(SITE_ROOT . $this->content)
            ];

        }

    }
    
?>
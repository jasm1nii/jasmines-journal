<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\Layout;

    final class SiteMap extends Layout {

        protected string $content   = DIR['content'] . "site-map.html.twig";
        protected string $layout    = DIR['layouts'] . "site-map_layout.html.twig";

        protected function render(): void {

            $vars = [
                'layout'    => $this->layout,
                'updated'   => filemtime(SITE_ROOT . $this->content)
            ];

            parent::Twig($this->content, $vars, null);

        }

    }

?>
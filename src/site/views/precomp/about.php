<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\Layout;
    use JasminesJournal\Site\Views\Partials;


    final class AboutIndex extends Layout {

        protected string $layout    = DIR['layouts'] . "about_layout.html.twig";
        protected string $content   = DIR['content'] . "about.html.twig";

        final protected function render(): void {

            $vars = [
                "layout"    => $this->layout,
                "nav"       => Partials\About\Nav::make(),
                "updated"   => filemtime(SITE_ROOT . $this->content)
            ];

            parent::Twig($this->content, $vars, null);

        }

    }

?>
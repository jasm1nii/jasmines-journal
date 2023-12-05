<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\Layout;
    use JasminesJournal\Site\Views\Partials;

    final class ChangelogIndex extends Layout {

        protected string $layout    = DIR['layouts'] . "changelog/changelog_index.html.twig";

        protected string $content   = SITE_ROOT . DIR['content'] . 'changelog/index.md';

        final protected function render(): void {

            $vars = [
                "nav"       => Partials\About\Nav::make(),
                "content"   => file_get_contents($this->content),
                "array"     => Partials\ChangelogArchive::createChangelogArray(),
                "updated"   => filemtime($this->content)
            ];
            
            parent::Twig($this->layout, $vars, null);

        }

    }

?>
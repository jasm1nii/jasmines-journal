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


    final class ChangelogSubpage extends Layout {

        protected string $layout    =  DIR['layouts'] . "changelog/changelog_subpage.html.twig";

        protected string $content;

        private function matchContent(): ?string {

            $path = ltrim(REQUEST, "/about");
            $file = "/" . rtrim($path, "/");

            return DIR['content'] . $file . ".html.twig";

        }

        final protected function render(): void {

            $this->content = $this->matchContent();
            
            $vars = [
                "layout"    => $this->layout,
                "nav"       => Partials\About\Nav::make(),
            ];

            parent::Twig($this->content, $vars, null);

        }

    }

?>
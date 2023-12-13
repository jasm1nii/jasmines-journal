<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\Layout;
    use JasminesJournal\Site\Views\Partials;

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
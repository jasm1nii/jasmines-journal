<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\View;
    use JasminesJournal\Site\Views\Partials;

    trait About {

        public static function nav() {

            return Partials\About\Nav::make();

        }

    }


    final class AboutIndex extends View {

        use About;

        private const LAYOUT    = DIR['layouts'] . "about_layout.html.twig";
        private const CONTENT   = DIR['content'] . "about.html.twig";

        public function __construct() {

            $this->render();

        }

        private function render(): void {

            $vars = [
                "layout"    => self::LAYOUT,
                "nav"       => About::nav(),
                "updated"   => filemtime(SITE_ROOT . self::CONTENT)
            ];

            parent::Twig(self::CONTENT, $vars, null);

        }

    }


    final class ChangelogIndex extends View {

        private const LAYOUT    = DIR['layouts'] . "changelog/changelog_index.html.twig";
        private const CONTENT   = SITE_ROOT . DIR['content'] . 'changelog/index.md';

        public function __construct() {

            $this->render();

        }

        private function render(): void {

            $vars = [
                "nav"       => About::nav(),
                "content"   => file_get_contents(self::CONTENT),
                "array"     => Partials\ChangelogArchive::createChangelogArray(),
                "updated"   => filemtime(self::CONTENT)
            ];
            
            parent::Twig(self::LAYOUT, $vars, null);

        }

    }


    final class ChangelogSubpage extends View {

        private const LAYOUT    =  DIR['layouts'] . "changelog/changelog_subpage.html.twig";
        private string $content;

        public function __construct() {

            $this->render();

        }

        private function render(): void {

            $this->content = $this->matchContent();
            
            $vars = [
                "layout"    => self::LAYOUT,
                "nav"       => About::nav(),
            ];

            parent::Twig($this->content, $vars, null);

        }

        private function matchContent(): ?string {

            $path = ltrim(REQUEST, "/about");
            $file = "/" . rtrim($path, "/");

            return DIR['content'] . $file . ".html.twig";

        }

    }

?>
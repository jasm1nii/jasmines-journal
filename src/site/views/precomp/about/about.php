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

        const LAYOUT    = DIR['layouts'] . "about_layout.html.twig";
        const CONTENT   = DIR['content'] . "about.html.twig";

        function __construct() {

            $vars = [
                "layout"    => self::LAYOUT,
                "nav"       => About::nav(),
                "updated"   => filemtime(SITE_ROOT . self::CONTENT)
            ];

            parent::Twig(self::CONTENT, $vars, null);

        }

    }


    final class ChangelogIndex extends View {

        const LAYOUT    = DIR['layouts'] . "changelog/changelog_index.html.twig";
        const CONTENT   = SITE_ROOT . DIR['content'] . 'changelog/index.md';

        function __construct() {

            $vars = [
                "nav"       => About::nav(),
                "content"   => file_get_contents(self::CONTENT),
                "array"     => Partials\ChangelogArchive::createChangelogArray()
            ];
            
            parent::Twig(self::LAYOUT, $vars, null);

        }

    }


    final class ChangelogSubpage extends View {

        const   LAYOUT    =  DIR['layouts'] . "changelog/changelog_subpage.html.twig";
        private $content;

        private function matchContent() {

            $path = ltrim(REQUEST, "/about");
            $file = "/" . rtrim($path, "/");
            $content = DIR['content'] . $file . ".html.twig";

            return $content;

        }

        function __construct() {

            $this->content = $this->matchContent();
            
            $vars = [
                "layout"    => self::LAYOUT,
                "nav"       => About::nav()
            ];

            parent::Twig($this->content, $vars, null);

        }

    }

?>
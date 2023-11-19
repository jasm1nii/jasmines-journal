<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\View as View;
    use JasminesJournal\Site\Views\Partials as Partials;


    final class AboutIndex extends View {

        private static $layout = DIR['layouts'] . "about_layout.html.twig";
        private static $content = DIR['content'] . "about.html.twig";

        function __construct() {

            $vars = [
                "layout" => self::$layout,
                "nav" => Partials\AboutNav::make(),
                "updated" => filemtime(SITE_ROOT . self::$content)
            ];

            parent::Twig(self::$content, $vars, null);

        }

    }



    final class ChangelogIndex extends View {

        private static $main_layout = DIR['layouts'] . "changelog/changelog_index.html.twig";
        private static $main_content_abs = SITE_ROOT . DIR['content'] . 'changelog/index.md';

        function __construct() {

            $content = file_get_contents(self::$main_content_abs);

            $vars = [
                "nav" => Partials\AboutNav::make(),
                'content' => $content,
                'array' => Partials\ChangelogArchive::createChangelogArray()
            ];
            
            parent::Twig(self::$main_layout, $vars, null);

        }

    }

    //

    final class ChangelogSubpage extends View {

        private static $layout =  DIR['layouts'] . "changelog/changelog_subpage.html.twig";

        function __construct() {

            $path = ltrim(REQUEST, "/about");
            $file = "/" . rtrim($path, "/");
            $content = DIR['content'] . $file . ".html.twig";
            
            $vars = [
                "layout" => self::$layout,
                "nav" => Partials\AboutNav::make()
            ];

            parent::Twig($content, $vars, null);

        }

    }

?>
<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\View as View;
    use JasminesJournal\Core\Views\Render\Layout as Layout;

    final class SiteMap extends View {

        private const CONTENT   = DIR['content'] . "site-map.html.twig";
        private const LAYOUT    = DIR['layouts'] . "site-map_layout.html.twig";

        public function __construct() {

            $vars = [
                'layout' => self::LAYOUT,
                'updated' => filemtime(SITE_ROOT . self::CONTENT)
            ];

            parent::Twig(self::CONTENT, $vars, null);

        }

    }

?>
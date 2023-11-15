<?php

    namespace Site\Views\Layouts;

    use Site\Views\Render\View as View;
    use Site\Views\Render\Layout as Layout;

    final class SiteMap extends View {

        private static $content = DIR['content'] . "site-map.html.twig";

        private static $layout = DIR['layouts'] . "site-map_layout.html.twig";

        public function __construct() {

            $updated = filemtime(SITE_ROOT . self::$content);

            $vars = [
                'layout' => self::$layout,
                'updated' => $updated
            ];

            parent::Twig(self::$content, $vars, null);

        }

    }

?>
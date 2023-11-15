<?php

    namespace Site\Views\Layouts;

    use Core\Views\Render\View as View;
    use Core\Views\Render\Layout as Layout;

    final class Accessibility extends View {

        private static $content = DIR['content'] . "accessibility.html.twig";

        private static $slug = "accessibility";

        public function __construct() {

            $updated = filemtime(SITE_ROOT . self::$content);

            $vars = [
                'layout' => Layout::useDefault(),
                'slug' => self::$slug,
                'updated' => $updated
            ];

            parent::Twig(self::$content, $vars, null);

        }

    }

?>
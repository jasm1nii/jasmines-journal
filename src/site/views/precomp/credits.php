<?php

    namespace Site\Views\Layouts;

    use Core\Views\Render\View as View;
    use Core\Views\Render\Layout as Layout;

    final class Credits extends View {

        private static $content = DIR['content'] . "credits.html.twig";

        private static $slug = "credits";

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
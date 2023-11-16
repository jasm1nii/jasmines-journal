<?php

    namespace Site\Views\Layouts;
    include __DIR__ . "/default.php";

    use Site\Views\Layouts\_Default as _Default;
    use Core\Views\Render\View as View;

    final class Credits extends View {

        private static $content = DIR['content'] . "credits.html.twig";
        private static $slug = "credits";

        public function __construct() {

            $updated = filemtime(SITE_ROOT . self::$content);

            $vars = [
                'layout' => _Default::$layout,
                'slug' => self::$slug,
                'updated' => $updated
            ];

            parent::Twig(self::$content, $vars, null);

        }

    }

?>
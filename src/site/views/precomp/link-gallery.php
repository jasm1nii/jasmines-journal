<?php

    namespace Site\Views\Layouts;

    use Core\Views\Render\View as View;

    final class LinkGallery extends View {

        const LAYOUT = DIR['layouts'] . "link-gallery_layout.html.twig";

        const DIR = DIR['content'] . "link-gallery";

        private static $mutuals = self::DIR . "/link-gallery_mutuals.html.twig";

        private static $_32bit = self::DIR . "/link-gallery_32bitcafe.html.twig";

        private static $etc = self::DIR . "/link-gallery_other-sites.html.twig";

        function __construct() {

            $updated = stat(SITE_ROOT . self::DIR)['mtime'];

            $vars = [
                'updated' => $updated,
                'mutuals' => self::$mutuals,
                '_32bit' => self::$_32bit,
                'etc' => self::$etc
            ];

            parent::Twig(self::LAYOUT, $vars, null);

        }

    }
?>
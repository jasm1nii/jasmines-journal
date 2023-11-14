<?php

    namespace Site\Views\Layouts;

    use Site\Views\Render\View as View;

    final class LinkGallery extends View {

        const DIR = DIR['content'] . "link-gallery";

        private static $mutuals = self::DIR . "/link-gallery_mutuals.html.twig";

        private static $_32bit = self::DIR . "/link-gallery_32bitcafe.html.twig";

        private static $etc = self::DIR . "/link-gallery_other-sites.html.twig";

        function __construct() {

            $page = DIR['layouts'] . "link-gallery_layout.html.twig";

            $updated = stat(SITE_ROOT . self::DIR)['mtime'];

            $vars = [
                'updated' => $updated,
                'mutuals' => self::$mutuals,
                '_32bit' => self::$_32bit,
                'etc' => self::$etc
            ];

            parent::Twig($page, $vars, null);

        }

    }
?>
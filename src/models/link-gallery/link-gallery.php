<?php
    class LinkGallery {

        const Dir = DIR['content'] . "link-gallery";

        const Mutuals = self::Dir . "/link-gallery_mutuals.html.twig";
        const _32bit = self::Dir . "/link-gallery_32bitcafe.html.twig";
        const Etc = self::Dir . "/link-gallery_other-sites.html.twig";

        public static function render() {
            $layout = DIR['layouts'] . "link-gallery_layout.html.twig";
            $updated = stat(SITE_ROOT . self::Dir)['mtime'];
            $vars = [
                'updated' => $updated,
                'mutuals' => self::Mutuals,
                '_32bit' => self::_32bit,
                'etc' => self::Etc
            ];

            View::Twig($layout, $vars, null);
        }
    }

    LinkGallery::render();
?>
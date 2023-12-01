<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\View as View;

    final class LinkGallery extends View {

        const LAYOUT    = DIR['layouts'] . "link-gallery_layout.html.twig";
        const DIR       = DIR['content'] . "link-gallery";

        const INCLUDES  = [
            'mutuals'   => self::DIR . "/link-gallery_mutuals.html.twig",
            '32bit'     => self::DIR . "/link-gallery_32bitcafe.html.twig",
            'etc'       => self::DIR . "/link-gallery_other-sites.html.twig"
        ];

        function __construct() {

            $vars = [
                'updated'   => stat(SITE_ROOT . self::DIR)['mtime'],
                'mutuals'   => self::INCLUDES['mutuals'],
                '_32bit'    => self::INCLUDES['32bit'],
                'etc'       => self::INCLUDES['etc']
            ];

            parent::Twig(self::LAYOUT, $vars, null);

        }

    }
?>
<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Site\Views\Layouts\DefaultLayout;
    use JasminesJournal\Core\Views\Render\View;
    use JasminesJournal\Core\Route;

    final class Accessibility extends View implements DefaultLayout {

        private const CONTENT = DIR['content'] . "accessibility.html.twig";

        public function __construct() {

            $vars = [
                'layout'    => self::LAYOUT,
                'slug'      => Route::useCleanSlug(),
                'updated'   => filemtime(SITE_ROOT . self::CONTENT)
            ];

            parent::Twig(self::CONTENT, $vars, null);

        }

    }

?>
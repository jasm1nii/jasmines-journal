<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\Layout;
    use JasminesJournal\Core\Route;

    final class LinkGallery extends Layout {

        protected string $layout = DIR['layouts'] . "link-gallery_layout.html.twig";

        protected static string $includes_path = DIR['content'] . "link-gallery";
        
        private array $includes;

        final public function __construct() {

            $this->getIncludes();
            $this->render();

        }

        private function getIncludes(): void {

            $this->includes = [

                'mutuals'
                    => self::$includes_path . "/link-gallery_mutuals.html.twig",

                '32bit'
                    => self::$includes_path . "/link-gallery_32bitcafe.html.twig",

                'etc'
                    => self::$includes_path . "/link-gallery_other-sites.html.twig"

            ];

        }

        final protected function render(): void {

            $vars = [
                'updated'   => Route::getLastUpdated(SITE_ROOT . static::$includes_path . "/*"),
                'mutuals'   => $this->includes['mutuals'],
                '_32bit'    => $this->includes['32bit'],
                'etc'       => $this->includes['etc']
            ];

            parent::Twig($this->layout, $vars, null);

        }

    }
?>
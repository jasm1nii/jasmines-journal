<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\View;
    use JasminesJournal\Site\Views\Partials;
    use JasminesJournal\Site\FileRouter;
    use JasminesJournal\Core\Route;

    final class BlogIndex extends View {
        
        private const LAYOUT = DIR['layouts'] . "blog/blog_layout.html.twig";

        public function __construct() {

            $vars = [
                'nav'               => Partials\Blog\Nav::make(),
                'notes_preview'     => Partials\Blog\Notes::makeList(),
                'articles_archive'  => Partials\Blog\Articles::makeList()
            ];

            parent::Twig(self::LAYOUT, $vars, null, true);

        }

    }


    final class BlogSubpageIndex extends View {

        private $type;
        private $layout;

        public function __construct(string $type) {

            $this->type = $type;
            $this->render();

        }

        private function render() {

            $this->layout = DIR['layouts'] . "blog/{$this->type}/{$this->type}_index_layout.html.twig";

            $vars = [
                'nav'       => Partials\Blog\Nav::make(),
                'entries'   => Partials\Blog\Subpage\Index::render($this->type)
            ];

            parent::Twig($this->layout, $vars, null);

        }

    }


    final class BlogEntry extends View {

        private $type;
        private $layout;
        private $content;

        public function __construct(string $type) {

            $this->type = $type;
            $this->render();

        }

        private function render() {

            $this->layout = DIR['layouts'] . "blog/{$this->type}/{$this->type}_entry.html.twig";

            $this->content = FileRouter\BlogEntry::file($use_root = false);

            $vars = [
                'layout'    => $this->layout,
                'slug'      => Route::useCleanSlug(),
                'src'       => FileRouter\BlogEntry::mapMedia(),
                'nav'       => Partials\Blog\Nav::make()
            ]; 
                
            parent::Twig($this->content, $vars, null);

        }

    }

?>
<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\View;
    use JasminesJournal\Site\Views\Partials;
    use JasminesJournal\Site\FileRouter;
    use JasminesJournal\Core\Route;


    final class BlogIndex extends View {
        
        private const LAYOUT = DIR['layouts'] . "blog/blog_layout.html.twig";

        public function __construct() {

            $this->render();

        }

        private function render() {

            $vars = [
                'nav'               => Partials\Blog\Nav::make(),
                'notes_preview'     => Partials\Blog\Notes::makeList(),
                'articles_archive'  => implode("", Partials\Blog\Articles::makeList())
            ];

            parent::Twig(self::LAYOUT, $vars, null, true);

        }

    }

    final class BlogSubpageIndex extends View {

        private $type;
        private $layout;

        public function __construct($type) {

            $this->type = $type;
            $this->render();

        }

        private function showEntries($type) {

            $entries_array = Partials\Blog\Subpage\Index::render($type);

            return implode("", $entries_array);

        }

        private function render() {

            $this->layout = DIR['layouts'] . "blog/{$this->type}/{$this->type}_index_layout.html.twig";

            $vars = [
                'nav'       => Partials\Blog\Nav::make(),
                'entries'   => $this->showEntries($this->type)
            ];

            parent::Twig($this->layout, $vars, null);

        }

    }

    final class BlogEntry extends View {

        private $type;
        private $layout;
        private $content;

        public function __construct($type) {

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
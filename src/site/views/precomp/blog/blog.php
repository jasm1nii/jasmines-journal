<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\Layout;
    use JasminesJournal\Site\Views\Partials;
    use JasminesJournal\Site\FileRouter;
    use JasminesJournal\Core\Route;

    final class BlogIndex extends Layout {
        
        protected string $layout = DIR['layouts'] . "blog/blog_layout.html.twig";

        final protected function render(): void {

            $vars = [
                'nav'               => Partials\Blog\Nav::make(),
                'notes_preview'     => Partials\Blog\Notes::makeList(),
                'articles_archive'  => Partials\Blog\Articles::makeList()
            ];

            parent::Twig($this->layout, $vars, null, true);

        }

    }


    final class BlogSubpageIndex extends Layout {

        private string $type;

        final public function __construct(string $type) {

            $this->type = $type;

            $this->layout = DIR['layouts'] . "blog/{$this->type}/{$this->type}_index_layout.html.twig";

            $this->render();

        }

        final protected function render(): void {

            $vars = [
                'nav'       => Partials\Blog\Nav::make(),
                'entries'   => Partials\Blog\Subpage\Index::render($this->type)
            ];

            parent::Twig($this->layout, $vars, null);

        }

    }


    final class BlogEntry extends Layout {

        private string $type;

        final public function __construct(string $type) {

            $this->type = $type;

            $this->layout = DIR['layouts'] . "blog/{$this->type}/{$this->type}_entry.html.twig";

            $this->content = FileRouter\BlogEntry::matchURLToFile($use_root = false);

            $this->render();

        }

        final protected function render(): void {

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
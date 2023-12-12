<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Route;
    use JasminesJournal\Core\Views\Render\Layout;
    
    use JasminesJournal\Site\FileRouter;
    use JasminesJournal\Site\Views\Partials;
    use JasminesJournal\Site\Models\ArticlesDatabase;
    use JasminesJournal\Site\Models\NotesDatabase;

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

        final public function __construct(private string $type, private int $current_page) {

            $this->data = match ($this->type) {
                'articles'  => new ArticlesDatabase,
                'notes'     => new NotesDatabase
            };

            $this->getTotalPages();
            $this->render();

        }

        private function getTotalPages(): void {

            $total_rows = $this->data->getTotal();
    
            if ($total_rows !== null) {
    
                $pages = intdiv($total_rows, 10);
    
                // remove the last page if it's blank due to perfect division:
    
                $this->total_pages = ($pages * 10 == $total_rows) ? $pages - 1 : $pages;
                    
            } else {

                $this->total_pages = null;

            }
                
        }

        final protected function render(): void {

            $this->layout = DIR['layouts'] . "blog/{$this->type}/{$this->type}_index_layout.html.twig";

            $this->index = Partials\Blog\Subpage\Index::renderRows(
                type: $this->type,
                rows: $this->current_page
            );

            $vars = [
                'nav'           => Partials\Blog\Nav::make(),
                'entries'       => $this->index,
                'total_pages'   => $this->total_pages,
                'page'          => $this->current_page
            ];

            parent::Twig($this->layout, $vars, null);

        }

    }


    final class BlogEntry extends Layout {

        final public function __construct(private string $type) {

            $this->render();

        }

        final protected function render(): void {

            $this->layout = DIR['layouts'] . "blog/{$this->type}/{$this->type}_entry.html.twig";

            $this->content = FileRouter\BlogEntry::matchURLToFile($use_root = false);

            $vars = [
                'layout'    => $this->layout,
                'slug'      => Route::useCleanSlug(),
                'src'       => FileRouter\BlogEntry::mapMedia(),
                'nav'       => Partials\Blog\Nav::make()
            ]; 
                
            parent::Twig($this->content, $vars, null);

        }

    }
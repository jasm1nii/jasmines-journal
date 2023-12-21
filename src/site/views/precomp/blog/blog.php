<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Controller\Route;
    use JasminesJournal\Core\View\Main\Layout;
    
    use JasminesJournal\Site\FileRouter;
    use JasminesJournal\Site\Views\Partials;
    use JasminesJournal\Site\Models\ArticlesDatabase;
    use JasminesJournal\Site\Models\NotesDatabase;

    final class BlogIndex extends Layout {
        
        protected string $layout
            = DIR['layouts'] . "blog/blog_layout.html.twig";

        final protected function render(): void {

            $vars = [
                'nav'               => Partials\Blog\Nav::make(),
                'notes_preview'     => Partials\Blog\Notes::makeList(),
                'note_tags'         => Partials\Blog\Notes::getTags(),
                'articles_archive'  => Partials\Blog\Articles::makeList(),
                'article_tags'      => Partials\Blog\Articles::getTags()
            ];

            parent::renderTwig($this->layout, $vars, null);

        }

    }

    final class BlogSubpageIndex extends Layout {

        private ?object $data;
        private ?string $index;
        private ?int $total_rows;
        private ?int $total_pages;
        private ?string $decoded_tag;

        final public function __construct(
            private string $type,
            private int $current_page,
            private ?string $sort_tag = null
        ) {

            $this->decoded_tag = ($this->sort_tag !== null)
                ? rawurldecode($this->sort_tag)
                : $this->sort_tag;

            $this->getTotalPages();
            $this->render();

        }

        private function getTotalPages(): void {

            $this->data = match ($this->type) {
                'articles'  => new ArticlesDatabase,
                'notes'     => new NotesDatabase
            };

            $this->total_rows = $this->data->getTotal($this->decoded_tag);
    
            if ($this->total_rows !== null) {
    
                $pages = intdiv($this->total_rows, 10);
    
                // remove the last page if it's blank due to perfect division:
    
                $this->total_pages
                    = ($pages * 10 == $this->total_rows)
                    ? $pages - 1 : $pages;
                    
            } else {

                $this->total_pages = null;

            }
                
        }

        final protected function render(): void {

            $this->layout
                = DIR['layouts']
                . "blog/{$this->type}/{$this->type}_index_layout.html.twig";

            $this->index
                = Partials\Blog\Subpage\Index::renderRows(
                    type: $this->type,
                    rows: $this->current_page,
                    sort_tag: $this->decoded_tag
                );

            $vars = [
                'request'       => REQUEST,
                'tag'           => $this->sort_tag,
                'nav'           => Partials\Blog\Nav::make(),
                'entries'       => $this->index,
                'total_entries' => $this->total_rows,
                'total_pages'   => $this->total_pages,
                'page'          => $this->current_page
            ];

            parent::renderTwig($this->layout, $vars, null);

        }

    }


    final class BlogEntry extends Layout {

        final public function __construct(private string $type) {

            $this->render();

        }

        final protected function render(): void {

            $this->layout
                = DIR['layouts']
                . "blog/{$this->type}/{$this->type}_entry.html.twig";

            $this->content
                = FileRouter\BlogEntry::matchURLToFile(
                    use_root: false
                );

            $vars = [
                'layout'    => $this->layout,
                'slug'      => Route::useCleanSlug(),
                'src'       => FileRouter\BlogEntry::mapMedia(),
                'nav'       => Partials\Blog\Nav::make()
            ];
                
            parent::renderTwig($this->content, $vars, null);

        }

    }
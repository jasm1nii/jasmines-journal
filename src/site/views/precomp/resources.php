<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\View\Main\Layout;
    use JasminesJournal\Core\View\Extension\MarkdownWithTOC;
    use JasminesJournal\Site\FileRouter;

    abstract class Resources extends Layout {
        
        final public const INCLUDES = DIR['content'] . "resources";

    }

    final class ResourcesIndex extends Resources {

        protected string $layout = DIR['layouts'] . "resources/resources_index.html.twig";

        final protected function render(): void {

            $vars = [
                'updated' => filemtime(SITE_ROOT . DIR['content'] . "resources/resources_index.md")
            ];

            parent::Twig($this->layout, $vars, parent::INCLUDES);

        }

    }

    final class ResourcesSubpage extends Resources {

        private const CATEGORY      = DIR['content'] . "resources/categories";

        protected string $layout    = DIR['layouts'] . "resources/resources_subpage.html.twig";
        private string $template;

        private array $base_blocks;
        private array $content_blocks;

        private string $twig_file;
        private string $markdown_file;

        final public function __construct() {

            $this->getContentData();
            $this->render();

        }

        private static function matchCategory(): ?string {

            return self::CATEGORY . FileRouter\Resources::getCategory();

        }

        private static function useIndex(): ?string {

            return self::matchCategory() . "/index";

        }

        private function matchTargetFile(): void {

            $this->twig_file = SITE_ROOT . self::matchCategory() . ".html.twig";

            if (file_exists($this->twig_file)) {

                $this->template         = self::matchCategory() . ".html.twig";
                $this->markdown_file    = SITE_ROOT . self::matchCategory() . ".md";
                
            } else {
                
                $this->template         = self::useIndex() . ".html.twig";
                $this->markdown_file    = SITE_ROOT . self::useIndex() . ".md";

            }

        }

        private function getContentData(): void {

            $this->matchTargetFile();

            $this->base_blocks = [
                'layout'    => $this->layout,
                'parent'    => FileRouter\Resources::getParentURL()
            ];

            if (file_exists($this->markdown_file)) {

                $this->content_blocks = [
                    'content' => MarkdownWithTOC::convert($this->markdown_file),
                    'updated' => filemtime($this->markdown_file)
                ];

            } else {

                $this->content_blocks = [
                    'content' => null,
                    'updated' => filemtime($this->twig_file)
                ];

            }

        }

        final protected function render(): void {

            $vars = array_merge($this->content_blocks, $this->base_blocks);

            parent::Twig($this->template, $vars, parent::INCLUDES);

        }

    }
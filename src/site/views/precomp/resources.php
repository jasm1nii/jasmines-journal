<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\View;
    use JasminesJournal\Core\Views\Render\Extension\MarkdownWithTOC;
    use JasminesJournal\Site\FileRouter;

    interface Resources {
        
        const INCLUDES = DIR['content'] . "resources";

    }

    final class ResourcesIndex extends View implements Resources {

        const LAYOUT = DIR['layouts'] . "resources/resources_index.html.twig";

        public function __construct() {

            $vars = [
                'updated' => filemtime(SITE_ROOT . DIR['content'] . "resources/resources_index.md")
            ];

            parent::Twig(self::LAYOUT, $vars, self::INCLUDES);

        }

    }

    final class ResourcesSubpage extends View implements Resources {

        const   CATEGORY  = DIR['content'] . "resources/categories";
        const   LAYOUT    = DIR['layouts'] . "resources/resources_subpage.html.twig";
        private $template;

        public function __construct() {

            $this->base_blocks = [
                'layout'    => self::LAYOUT,
                'parent'    => FileRouter\Resources::getParentURL()
            ];

            $this->matchTargetFile();
            $this->render();

        }

        private static function matchCategory() {

            return self::CATEGORY . FileRouter\Resources::getCategory();

        }

        private static function useIndex() {

            return self::matchCategory() . "/index";

        }

        private function matchTargetFile() {

            $twig_file = SITE_ROOT . self::matchCategory() . ".html.twig";

            if (file_exists($twig_file)) {

                $this->template = self::matchCategory() . ".html.twig";
                $markdown_file  = SITE_ROOT . self::matchCategory() . ".md";
                
            } else {
                
                $this->template = self::useIndex() . ".html.twig";
                $markdown_file  = SITE_ROOT . self::useIndex() . ".md";

            }

            if (file_exists($markdown_file)) {

                $this->content_blocks = [
                    'content' => MarkdownWithTOC::convert($markdown_file),
                    'updated' => filemtime($markdown_file)
                ];

            } else {

                $this->content_blocks = [
                    'content' => null,
                    'updated' => filemtime($twig_file)
                ];

            }

        }

        private function render() {

            $vars = array_merge($this->content_blocks, $this->base_blocks);

            parent::Twig($this->template, $vars, self::INCLUDES);

        }

    }

?>
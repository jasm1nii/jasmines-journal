<?php

    namespace Site\Views\Layouts;

    use Core\Views\Render\View as View;
    use Core\Views\Render\Extension\MarkdownWithTOC as MarkdownWithTOC;

    //

    trait Resources {

        public static $includes_path = SITE_ROOT . DIR['content'] . "resources";

    }

    //

    final class ResourcesIndex extends View {

        use Resources;

        private static $layout = DIR['layouts'] . "resources/resources_index.html.twig";

        public function __construct() {

            $updated = filemtime(SITE_ROOT . DIR['content'] . "resources/resources_index.md");

            $vars = [
                'updated' => $updated
            ];

            parent::Twig(self::$layout, $vars, Resources::$includes_path);

        }

    }

    final class ResourcesSubpage extends View {

        use Resources;

        private static $category_dir = DIR['content'] . "resources/categories";

        private static $layout = DIR['layouts'] . "resources/resources_subpage.html.twig";

        private static function matchCategory() {

            $category_query = '/\w*.*[^\/]/';
            preg_match($category_query, REQUEST, $matches, null, 11);
            $partial_path = self::$category_dir . "/{$matches[0]}";

            return $partial_path;

        }

        private static function getParentURL() {

            $url = preg_split('/\//', REQUEST);

            if (!empty($url[3])) {

                $parent = '/' . $url[1] . '/' . $url[2];

            } else {
                    
                $parent = null;
            }

            return $parent;

        }

        public function __construct() {
            
            $legend = file_get_contents(SITE_ROOT.DIR['content'] . "resources/_legend.md");

            $template = self::matchCategory() . ".html.twig";
            $twig_as_main = SITE_ROOT . $template;

            // the following needs to be passed through League/Commonmark first to generate a table of contents:

            $markdown_as_main = SITE_ROOT . self::matchCategory() . ".md";

            if (!file_exists($twig_as_main)) {

                $template = self::matchCategory() . "/index.html.twig";
                $markdown_as_main = SITE_ROOT . self::matchCategory() . "/index.md";
                
            }

            if (file_exists($markdown_as_main)) {

                require parent::MARKDOWN_WITH_TOC;

                $content = MarkdownWithTOC::convert($markdown_as_main);
                $updated = filemtime($markdown_as_main);

            } else {

                $content = null;
                $updated = filemtime($twig_as_main);

            }

            $vars = [
                'layout'    => self::$layout,
                'updated'   => $updated,
                'legend'    => $legend,
                'content'   => $content,
                'parent'    => self::getParentURL()
            ];

            parent::Twig($template, $vars, null);

        }

    }

?>
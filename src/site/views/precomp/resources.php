<?php

    namespace Site\Views\Layouts;

    use Site\Views\Render\View as View;

    //

    trait Resources {

        public static $includes_path = SITE_ROOT . DIR['content'] . "resources";

    }

    //

    final class ResourcesIndex extends View {

        use Resources;

        public function __construct() {

            $layout = DIR['layouts'] . "resources/resources_index.html.twig";

            $updated = filemtime(SITE_ROOT . DIR['content'] . "resources/resources_index.md");

            $vars = [
                'updated' => $updated
            ];

            parent::Twig($layout, $vars, Resources::$includes_path);

        }

    }

    final class ResourcesSubpage extends View {

        use Resources;

        private static $category_dir = DIR['content'] . "resources/categories";

        private static $layout = DIR['layouts'] . "resources/resources_subpage.html.twig";

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

            $category_query = '/\w*.*[^\/]/';

            preg_match($category_query, REQUEST, $matches, null, 11);

            // the following needs to be passed through League/Commonmark first to generate a table of contents:

            $markdown_as_main = SITE_ROOT . self::$category_dir . "/{$matches[0]}.md";

            $twig_as_main = SITE_ROOT . self::$category_dir . "/{$matches[0]}.html.twig";

            $template = self::$category_dir . "/{$matches[0]}.html.twig";

            if (!file_exists($twig_as_main)) {

                $twig_as_main = SITE_ROOT . self::$category_dir . "/{$matches[0]}/index.html.twig";

                $markdown_as_main = SITE_ROOT . self::$category_dir . "/{$matches[0]}/index.md";

                $template = self::$category_dir . "/{$matches[0]}/index.html.twig";

            }

            if (file_exists($markdown_as_main)) {

                require parent::MARKDOWN_WITH_TOC;

                $content = $commonmark->convert(file_get_contents($markdown_as_main));

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
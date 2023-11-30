<?php

    namespace JasminesJournal\Site\Views\Partials\Blog\Subpage;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;
    use JasminesJournal\Core\Views\Render\Extension as Extension;

    class Index {
        
        private static function getFiles($source) {

            $files = glob($source . "/*/{12,11,10,9,8,7,6,5,4,3,2,1}/{3,2,1,0}{9,8,7,6,5,4,3,2,1,0}/entry.html.twig", GLOB_BRACE);

            rsort($files, SORT_NATURAL);

            return $files;

        }

        protected static function makeList($type, $source, $template) {

            $twig = Extension\PartialTwig::buildTwigEnv();
            $files = self::getFiles($source);

            $content = [];

            foreach ($files as $article) {
                
                $dir = preg_split('/\/(src)/', $article);
                $content_path = "/src/{$dir[1]}";

                $slug_1 = rtrim($content_path, '.html.twig');
                $slug_2 = ltrim($slug_1, DIR['content'] . "blog/{$type}");

                $content[] = $twig->render($content_path,
                    [
                        'layout' => $template,
                        'slug' => $slug_2
                    ]);

            }

            return $content;

        }

    }

    class Notes extends Index {

        public static function renderIndex() {

            $type = 'notes';
            $source = SITE_ROOT . DIR['content'] . 'blog/notes';
            $template = DIR['layouts'] . "blog/notes/_notes_index.html.twig";

            return parent::makeList($type, $source, $template);

        }

    }

    class Articles extends Index {

        public static function renderIndex() {

            $type = 'articles';
            $source = SITE_ROOT . DIR['content'] . 'blog/articles';
            $template = DIR['layouts'] . "blog/articles/_articles_index.html.twig";

            return parent::makeList($type, $source, $template);

        }

    }

?>
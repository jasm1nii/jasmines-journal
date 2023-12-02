<?php

    namespace JasminesJournal\Site\Views\Partials\Blog\Subpage;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;
    use JasminesJournal\Core\Views\Render\Extension;
    use JasminesJournal\Site\FileRouter\BlogEntry;

    class Index {

        private static function makeList(string $type, string $source, string $template) {

            $twig   = Extension\PartialTwig::buildTwigEnv();
            $files  = BlogEntry::getFiles($source);

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

        public static function render(string $type) {

            $source     = SITE_ROOT . DIR['content'] . "blog/{$type}";
            $template   = DIR['layouts'] . "blog/{$type}/_{$type}_index.html.twig";

            return self::makeList($type, $source, $template);

        }

    }

?>
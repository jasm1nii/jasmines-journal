<?php

    namespace JasminesJournal\Site\Views\Partials;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;
    use \JasminesJournal\Core\Views\Render\Extension as Extension;

    class BlogIndex_Articles {

        const SOURCE_DIR = SITE_ROOT . DIR['content'] . 'blog/articles';
        const TEMPLATE = DIR['layouts'] . "blog/_blog_articles_preview.html.twig";

        public static function make() {

            $twig = Extension\PartialTwig::buildTwigEnv();

            $files = glob(self::SOURCE_DIR . "/*/*/*/entry.html.twig");
            asort($files, SORT_NATURAL);

            $content = [];

            $i = 0;

            foreach (array_reverse($files) as $article) {

                $dir = preg_split('/\/(src)/', $article);
                $content_path = "/src/{$dir[1]}";

                $slug_1 = rtrim($content_path, '.html.twig');
                $slug_2 = ltrim($slug_1, DIR['content'] . 'blog/articles');

                $content[] = $twig->render(
                    $content_path,
                    [
                        'layout' => self::TEMPLATE,
                        'slug' => $slug_2
                    ]);

                if (++$i > 4) break;

            }

            return $content;

        }

    }

?>
<?php

    namespace JasminesJournal\Site\Views\Partials\Blog;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;
    use JasminesJournal\Core\Views\Render\Extension as Extension;

    class Index {

        protected static function getFiles($source) {

            $files = glob($source . "/*/{12,11,10,9,8,7,6,5,4,3,2,1}/{3,2,1,0}{9,8,7,6,5,4,3,2,1,0}/entry.html.twig", GLOB_BRACE);

            rsort($files, SORT_NATURAL);

            return $files;

        }

    }

    class Notes extends Index {

        const SOURCE_DIR = SITE_ROOT . DIR['content'] . 'blog/notes';
        const TEMPLATE = DIR['layouts'] . "blog/_blog_notes_preview.html.twig";

        public static function makeList() {

            $twig = Extension\PartialTwig::buildTwigEnv();
            $file = parent::getFiles(self::SOURCE_DIR)[0];

            $dir = preg_split('/\/(src)/', $file);
            $content_path = "/src/{$dir[1]}";

            $slug_1 = rtrim($content_path, '.html.twig');
            $slug_2 = ltrim($slug_1, DIR['content'] . 'blog/notes');

            $content = $twig->render(
                $content_path,
                    [
                        'layout' => self::TEMPLATE,
                        'slug' => $slug_2
                    ]
                );

            return $content;

        }

    }

    class Articles extends Index {

        const SOURCE_DIR = SITE_ROOT . DIR['content'] . 'blog/articles';
        const TEMPLATE = DIR['layouts'] . "blog/_blog_articles_preview.html.twig";

        public static function makeList() {

            $twig = Extension\PartialTwig::buildTwigEnv();
            $files = parent::getFiles(self::SOURCE_DIR);

            $content = [];

            $i = 0;

            foreach ($files as $article) {

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
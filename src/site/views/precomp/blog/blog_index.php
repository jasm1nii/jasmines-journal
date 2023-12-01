<?php

    namespace JasminesJournal\Site\Views\Partials\Blog;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;
    use JasminesJournal\Core\Views\Render\Extension;
    use JasminesJournal\Site\FileRouter\BlogEntry;

    class Notes {

        const SOURCE_DIR    = SITE_ROOT . DIR['content'] . 'blog/notes';
        const TEMPLATE      = DIR['layouts'] . "blog/_blog_notes_preview.html.twig";

        public static function makeList() {

            $twig = Extension\PartialTwig::buildTwigEnv();
            $file = BlogEntry::getFiles(self::SOURCE_DIR)[0];

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

    class Articles {

        const SOURCE_DIR    = SITE_ROOT . DIR['content'] . 'blog/articles';
        const TEMPLATE      = DIR['layouts'] . "blog/_blog_articles_preview.html.twig";

        public static function makeList() {

            $twig = Extension\PartialTwig::buildTwigEnv();
            $files = BlogEntry::getFiles(self::SOURCE_DIR);

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
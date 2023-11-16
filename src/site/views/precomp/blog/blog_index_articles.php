<?php

    namespace Site\Views\Partials;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;

    class BlogIndex_Articles {

        const SOURCE_DIR = SITE_ROOT . DIR['content'] . 'blog/articles';
        const TEMPLATE = DIR['layouts'] . "blog/_blog_articles_preview.html.twig";

        public static function make() {

            $loader = new \Twig\Loader\FilesystemLoader(SITE_ROOT, getcwd());

            $twig = new \Twig\Environment(
                $loader,
                [
                    'cache' => SITE_ROOT . '/tmp/twig',
                    'auto_reload' => true
                ]
            );

            $twig->addExtension(new IntlExtension());

            $twig->getExtension(\Twig\Extension\CoreExtension::class)->setDateFormat(DATE_ATOM);

            $twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Asia/Jakarta');

            //

            $files = glob(self::SOURCE_DIR . "/*/*/*/entry.html.twig");
            asort($files, SORT_NATURAL);

            $content = [];

            $i = 0;

            foreach (array_reverse($files) as $article) {

                $content_path = DIR['content'] . ltrim($article, SITE_ROOT);

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
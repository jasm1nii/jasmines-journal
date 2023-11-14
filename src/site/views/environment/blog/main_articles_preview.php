<?php

    use Site\Views\Render\View as View;

    require View::TWIG;

    $source = SITE_ROOT . DIR['content'] . 'blog/articles';

    $layout = DIR['layouts'] . "blog/_blog_articles_preview.html.twig";

    $files = glob($source . "/*/*/*/entry.html.twig");
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
                'layout' => $layout,
                'slug' => $slug_2
            ]);

        if(++$i > 4) {

            break;

        }

    }

?>

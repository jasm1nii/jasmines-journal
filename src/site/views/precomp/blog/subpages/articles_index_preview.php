<?php

    $source = SITE_ROOT . DIR['content'] . 'blog/articles';
    $files = glob($source."/*/*/*/entry.html.twig");
    asort($files, SORT_NATURAL);

    $content = [];

    require Core\Views\Render\View::TWIG;

    foreach (array_reverse($files) as $article) {

        $layout = DIR['layouts'] . "blog/articles/_articles_index.html.twig";
        $content_path = DIR['content'] . ltrim($article, SITE_ROOT);

        $slug_1 = rtrim($content_path, '.html.twig');
        $slug_2 = ltrim($slug_1, DIR['content'] . 'blog/articles');

        $content[] = $twig->render($content_path,
            [
                'layout' => $layout,
                'slug'=> $slug_2
            ]);
    }

?>
<?php

    // to do: figure out how to extract data for each entry without rendering
    
    // require SITE_ROOT . DIR['models'] . 'blog/notes_archive.php';

    $source = SITE_ROOT . DIR['content'] . 'blog/notes';
    $files = glob($source . "/*/*/*/entry.html.twig");
    asort($files, SORT_NATURAL);

    $content = [];

    require Site\Views\Render\View::TWIG;
    
    foreach (array_reverse($files) as $article) {

        $layout = DIR['layouts'] . "blog/notes/_notes_index.html.twig";
        $content_path = DIR['content'] . ltrim($article, SITE_ROOT);

        $slug_1 = rtrim($content_path, '.html.twig');
        $slug_2 = ltrim($slug_1, DIR['content'] . 'blog/notes');

        $content[] = $twig->render($content_path,
            [
                'layout' => $layout,
                'slug' => $slug_2
            ]);

    }

?>
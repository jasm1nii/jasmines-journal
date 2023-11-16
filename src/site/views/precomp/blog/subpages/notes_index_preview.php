<?php

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;

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

    $source = SITE_ROOT . DIR['content'] . 'blog/notes';
    $files = glob($source . "/*/*/*/entry.html.twig");
    asort($files, SORT_NATURAL);

    $content = [];
    $layout = DIR['layouts'] . "blog/notes/_notes_index.html.twig";
    
    foreach (array_reverse($files) as $article) {
        
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
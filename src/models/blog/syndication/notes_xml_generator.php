<?php

    // also needs to be updated
    
    $server_root = dirname(__DIR__,3);

    require_once $server_root . '/vendor/autoload.php';
    require_once $server_root.'/src/utils/twig_default_config.php';

    $source = $server_root.'/src/content/blog/notes';
    $layout = "/src/utils/feed-generator_v2/notes_entry.xml.twig";

    $files = glob($source."/*/*/*/entry.html.twig");
    asort($files, SORT_NATURAL);

    //
    
    ob_start();

    foreach (array_reverse($files) as $article) {
        $path = ltrim($article, $server_root);
        $slug = ltrim(rtrim($path,'.html.twig'),'/src/content/blog/notes');

        echo $twig->render(
            $path,
            [
                'layout'=>$layout,
                'slug'=>$slug
            ]
        );
    }

    $target_dir = $server_root.'/tests';
    $xml_entries = ob_get_contents();

    file_put_contents($target_dir.'/notes.tmp.xml', $xml_entries);

    ob_end_clean();

    //

    ob_start();

    echo $twig->render('/src/utils/feed-generator_v2/notes.xml.twig');
    $xml_final = ob_get_contents();

    file_put_contents($target_dir.'/notes.xml', $xml_final);

    ob_end_clean();
?>
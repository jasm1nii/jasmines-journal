<?php
    $server_root = dirname(__DIR__,2);
    require_once $server_root.'/config/twig_default_config.php';

    $source_dir = $server_root.'/resources/content/blog/articles';
    $layout = "/bin/feed-generator_v2/articles_entry.xml.twig";

    $files = glob($source_dir."/*/*/*/entry.html.twig");
    asort($files, SORT_NATURAL);
    
    ob_start();
    foreach (array_reverse($files) as $article) {
        $path = ltrim($article, $server_root);
        $slug = ltrim(rtrim($path,'.html.twig'),'/resources/content/blog/articles');
        $media_src = "https://jasm1nii.xyz/_assets/media/blog/articles/".rtrim($slug, "entry");

        echo $twig->render($path, ['layout'=>$layout,'slug'=>$slug, 'src'=>$media_src]);
    }

    $target_dir = $server_root.'/tests';
    $xml_entries = ob_get_contents();

    file_put_contents($target_dir.'/articles.tmp.xml', $xml_entries);

    ob_end_clean();

    ob_start();

    echo $twig->render('/bin/feed-generator_v2/articles.xml.twig');
    $xml_final = ob_get_contents();

    file_put_contents($target_dir.'/articles.xml', $xml_final);

    ob_end_clean();
?>
<?php
    require_once dirname(__DIR__,2).'/config/twig_default_config.php';

    $source = dirname(__DIR__,2).'/resources/content/blog/notes';
    $layout = "/src/feed-generator_v2/notes_entry.xml.twig";

    $files = glob($source."/*/*/*/entry.html.twig");
    asort($files, SORT_NATURAL);
    
    ob_start();
    foreach (array_reverse($files) as $article) {
        $content_path = ltrim($article,dirname(__DIR__,2));

        $slug_1 = rtrim($content_path,'.html.twig');
        $slug_2 = ltrim($slug_1,'/resources/content/blog/notes');
        $media_source = 'https://jasm1nii.xyz/_assets/media/blog/articles/'.rtrim($slug_2,'/entry').'/';

        echo $twig->render($content_path, ['layout'=>$layout,'slug'=>$slug_2,'src'=>$media_source]);
    }
    $xml_entries = ob_get_contents();
    file_put_contents(__DIR__.'/notes.tmp.xml',$xml_entries);
    ob_end_clean();

    ob_start();
    echo $twig->render('/src/feed-generator_v2/notes.xml.twig');
    $xml_final = ob_get_contents();
    file_put_contents(__DIR__.'/notes.xml',$xml_final);
    ob_end_clean();
?>
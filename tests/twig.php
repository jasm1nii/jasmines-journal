<?php
    require_once dirname(__DIR__,1).'/php/vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__,2));
    $twig = new \Twig\Environment($loader);
    
    echo $twig->render('/source/test/templates/blog/notes/entry-layout_twig.html');
?>
<?php
    require_once dirname(__DIR__,6).'/php_resources/_templates/twig_default_config.php';

    $blog_subdir = ltrim(__DIR__, dirname(__DIR__,3));
    $blog_subdir_rel = $blog_root.DIRECTORY_SEPARATOR.$blog_subdir;

    echo $twig->render($blog_subdir_rel.'/entry_content.html.twig');
?>
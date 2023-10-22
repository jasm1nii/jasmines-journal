<?php
    require_once dirname(__DIR__,6).'/php_resources/_templates/twig_default_config.php';

    $microblog_subdir = ltrim(__DIR__, dirname(__DIR__,3));
    $microblog_subdir_rel = $microblog_root.DIRECTORY_SEPARATOR.$microblog_subdir;

    echo $twig->render($microblog_subdir_rel.'/entry_content.html.twig');
?>
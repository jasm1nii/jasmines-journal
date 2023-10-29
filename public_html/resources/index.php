<?php
    require_once dirname(__DIR__,2).'/config/twig_default_config.php';

    $md_source = filemtime(dirname(__DIR__,2).'/resources/content/resources/resources_index.md');

    echo $twig->render('/resources/layouts/resources/resources_index.html.twig',['updated'=>$md_source]);
?>
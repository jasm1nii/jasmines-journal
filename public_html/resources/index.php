<?php
    require_once dirname(__DIR__,2).'/config/twig_default_config.php';

    echo $twig->render('/resources/layouts/resources/resources_index.html.twig');
?>
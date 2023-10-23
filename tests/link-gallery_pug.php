<?php
    include_once dirname(__DIR__,1) . '/config/pug_default_config.php';
    $output = __DIR__.'/link-gallery_pug.html';
    Phug::renderAndWriteFile(dirname(__DIR__,1).'/data/link-gallery_pug_src.pug', $output);
?>
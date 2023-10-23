<?php
    use JsPhpize\JsPhpizePhug;
    include_once dirname(__DIR__,1) . '/src/vendor/autoload.php';
    Phug::addExtension(JsPhpizePhug::class);
?>
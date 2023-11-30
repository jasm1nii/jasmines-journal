<?php
    
    define("REQUEST", $_SERVER['REQUEST_URI']);
    define("SITE_ROOT", dirname($_SERVER['DOCUMENT_ROOT'], 1));

    require SITE_ROOT . "/vendor/autoload.php";

    use JasminesJournal\Site\Request as Request;

    Request\Index::dispatch();
   
?>
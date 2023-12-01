<?php
    
    define("SITE_ROOT", dirname($_SERVER['DOCUMENT_ROOT'], 1));

    require SITE_ROOT . "/vendor/autoload.php";

    use JasminesJournal\Site\RequestRouter;

    RequestRouter\Index::dispatch();
   
?>
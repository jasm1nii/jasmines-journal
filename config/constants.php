<?php
    /* this needs to be edited later */
    
    putenv("ENV=dev");

    define("REQUEST", $_SERVER['REQUEST_URI']);
    define("SITE_ROOT", dirname($_SERVER['DOCUMENT_ROOT'], 1));
    define("ENV_CONF",  SITE_ROOT . "/config/env_" . getenv('ENV') . ".ini");

    define(
        "DIR",
        [
            'models'    => "/src/models/",
            'layouts'   => "/src/layouts/",
            'includes'  => "/src/includes/",
            'content'   => "/src/content/"
        ]
    );
?>
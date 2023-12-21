<?php

    putenv("ENV=prod");

    dirname($_SERVER['DOCUMENT_ROOT'], 1)
        ? define("SITE_ROOT", dirname($_SERVER['DOCUMENT_ROOT'], 1))
        : define("SITE_ROOT", "/var/www/jasmines-journal");

    // the second argument for "ENV_CONF" should match the absolute path to the configuration file.

    define("ENV_CONF", SITE_ROOT . "/config/env_prod.ini");
    
    define(
        "DIR",
        [
            'layouts'   => "/src/site/views/layouts/",
            'includes'  => "/src/site/views/includes/",
            'content'   => "/src/site/content/"
        ]
    );

    isset($_SERVER['REQUEST_URI'])
        ? define("REQUEST", $_SERVER['REQUEST_URI'])
        : define("REQUEST", null);
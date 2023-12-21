<?php

    putenv("ENV=prod");

    define("INI", parse_ini_file(SITE_ROOT . "/config/env_" . getenv("ENV") . ".ini", true));

    define("SITE_ROOT", INI['server']['document_root']);
    
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
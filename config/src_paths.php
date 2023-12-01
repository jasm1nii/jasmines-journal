<?php

    match ($_SERVER['HTTP_HOST']) {
        'localhost'     => putenv("ENV=dev"),
        'jasm1nii.xyz'  => putenv("ENV=prod"),
        default         => putenv("ENV=sample")
    };

    define("SITE_ROOT", dirname($_SERVER['DOCUMENT_ROOT'], 1));

    // the second argument for "ENV_CONF" should match the absolute path to the configuration file.

    define("ENV_CONF", SITE_ROOT . "/config/env_" . getenv('ENV') . ".ini");
    
    define(
        "DIR",
        [
            'layouts'       => "/src/site/views/layouts/",
            'includes'      => "/src/site/views/includes/",
            'content'       => "/src/site/content/"
        ]
    );

    define("REQUEST", $_SERVER['REQUEST_URI']);
    
?>
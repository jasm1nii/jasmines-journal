<?php

    putenv("ENV=dev");

    // the second argument for "ENV_CONF" should match the absolute path to the configuration file.

    define("ENV_CONF", SITE_ROOT . "/config/env_" . getenv('ENV') . ".ini");
    
    define(
        "DIR",
        [
            'controllers'   => "/src/site/controllers/",
            'models'        => "/src/site/models/",
            'precomp'       => "/src/site/views/precomp/",
            'layouts'       => "/src/site/views/layouts/",
            'includes'      => "/src/site/views/includes/",
            'content'       => "/src/site/content/"
        ]
    );
    
?>
<?php

    putenv("ENV=dev");
    define("ENV_CONF",  SITE_ROOT . "/config/env_" . getenv('ENV') . ".ini");
    
    define(
        "DIR",
        [
            'models'    => "/src/site/models/",
            'view_env'  => "/src/site/views/environment/",
            'layouts'   => "/src/site/views/layouts/",
            'includes'  => "/src/site/views/includes/",
            'content'   => "/src/site/content/"
        ]
    );
    
?>
<?php

    class Route {

        public static function execute($route_file) {

            require SITE_ROOT . DIR['models'] . $route_file;

        }

        public static function NotFound() {

            http_response_code(404);
            
            require_once __DIR__.'/404.shtml';

        }

    }
    
?>
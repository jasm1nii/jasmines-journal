<?php

    class Route {

        public static function loadLayoutClasses($path) {

            require SITE_ROOT . DIR['precomp'] . $path;

        }

        public static function forwardToController($path) {

            require SITE_ROOT . DIR['controllers'] . $path;

        }

        public static function forwardToModel($path) {

            require SITE_ROOT. DIR['models'] . $path;

        }

        public static function NotFound() {

            http_response_code(404);
            
            require_once $_SERVER['DOCUMENT_ROOT'] . '/404.shtml';

        }

    }
    
?>
<?php

    namespace JasminesJournal\Core;

    class Route {

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

        protected static function matchURL($query) {

            preg_match($query, REQUEST, $matches);

            if (!isset($matches[0])) {

                $matches[0] = 0;
        
            }

            return $matches[0];

        }

    }
    
?>
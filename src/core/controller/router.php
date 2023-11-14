<?php

    class Route {

        public static function execute($path, $use_model = null) {

            if ($use_model == true) {

                require SITE_ROOT . DIR['models'] . $path;

            } elseif ($use_model == false || $use_model == null) {

                require SITE_ROOT . DIR['precomp'] . $path;

            }

        }

        public static function NotFound() {

            http_response_code(404);
            
            require_once $_SERVER['DOCUMENT_ROOT'] . '/404.shtml';

        }

    }
    
?>
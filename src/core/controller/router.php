<?php

    class Route {

        public static function execute($path, $prereq = null) {

            if ($prereq == 'use_model') {

                require SITE_ROOT . DIR['models'] . $path;

            } elseif ($prereq == 'use_controller') {

                require SITE_ROOT . DIR['controllers'] . $path;

            } else {

                require SITE_ROOT . DIR['precomp'] . $path;

            }

        }

        public static function NotFound() {

            http_response_code(404);
            
            require_once $_SERVER['DOCUMENT_ROOT'] . '/404.shtml';

        }

    }
    
?>
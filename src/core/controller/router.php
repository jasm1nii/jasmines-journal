<?php

    namespace JasminesJournal\Core;

    class Route {

        public static function notFound() {

            http_response_code(404);
            require_once $_SERVER['DOCUMENT_ROOT'] . '/404.shtml';

        }

        public static function redirect(string $new_url) {

            http_response_code(301);
            header("Location: {$new_url}");

        }

        public static function matchURL(string $query) {

            preg_match($query, REQUEST, $matches);

            if (!isset($matches[0])) {

                $matches[0] = 0;
        
            }

            return $matches[0];

        }

        public static function matchSubpage(int $level = 0) {

            $matches = preg_split('/\//', REQUEST);

            return $matches[$level];

        }

        public static function useCleanSlug() {

            return rtrim(REQUEST,'/');

        }

        public static function getLastUpdated(string $glob_args) {

            $glob = glob($glob_args, GLOB_BRACE);

            foreach ($glob as $glob_result) {

                $mtime[] = filemtime($glob_result);

            }

            rsort($mtime);

            return $mtime[0];

        }

    }
    
?>
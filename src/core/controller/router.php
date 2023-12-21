<?php

    namespace JasminesJournal\Core\Controller;

    abstract class FileRouter {

        public static function getLastUpdated(string $glob_args): int {

            $glob = glob($glob_args, GLOB_BRACE);

            foreach ($glob as $glob_result) {

                $mtime[] = filemtime($glob_result);

            }

            rsort($mtime);

            return $mtime[0];

        }

    }

    abstract class RequestRouter extends FileRouter {

        public static function notFound(): void {

            http_response_code(404);
            require_once $_SERVER['DOCUMENT_ROOT'] . '/404.shtml';

        }

        public static function redirect(string $new_url): void {

            http_response_code(301);
            header("Location: {$new_url}");

        }

        public static function matchURL(string $query): ?string {

            preg_match($query, REQUEST, $matches);
            return $matches[0] ??= null;

        }

        public static function matchSubpage(?int $level = 0): ?string {

            $matches = preg_split('/\//', REQUEST);

            if (isset($matches[$level])) {

                return $matches[$level];

            }

        }

        public static function useCleanSlug(): string {

            return rtrim(REQUEST,'/');

        }

    }

    class Route extends RequestRouter {

        protected static function dispatch(): void {}

    }
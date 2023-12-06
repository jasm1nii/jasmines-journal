<?php

    namespace JasminesJournal\Core\Config;

    class Config {

        private static function parseINI(): array {

            return parse_ini_file(ENV_CONF, true);

        }

        public static function getSettings(string $name): array {

            return self::parseINI()["{$name}"];

        }

    }

?>
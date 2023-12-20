<?php

    namespace JasminesJournal\Core;

    abstract class Config {

        final protected static function getSettings(string $name): array {

            return parse_ini_file(ENV_CONF, true)["{$name}"];

        }

    }

    #[\Attribute(\Attribute::IS_REPEATABLE)]
    class Setup {}

    #[\Attribute(\Attribute::IS_REPEATABLE)]
    class Routine {}

    #[\Attribute(\Attribute::IS_REPEATABLE)]
    class Testing {}
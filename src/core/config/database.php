<?php

    namespace JasminesJournal\Core;

    use JasminesJournal\Core\Config;
    use JasminesJournal\Core\Setup;

    abstract class Database extends Config {

        private readonly array $user_config;
        private readonly array $db_config;

        protected static string $db_name;
        protected ?object $database;
        protected ?string $table;

        final public function __construct() {

            $this->user_config = parent::getSettings('db_user');
            $this->db_config   = parent::getSettings(static::$db_name);

            try {

                $this->database = new \PDO(
                    "mysql:host=localhost;
                    dbname={$this->db_config['name']}",
                    $this->user_config['user'],
                    $this->user_config['password'],
                    [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4']
                );

                $this->table = $this->db_config['table'];

            } catch (\Exception) {

                $this->database = null;
                $this->table = null;

            }

        }

    }
<?php

    namespace JasminesJournal\Core;

    use JasminesJournal\Core\Config;

    abstract class GuestbookConfig extends Config {

        protected readonly object $database;
        protected readonly string $table;

        final public function __construct() {

            $settings = parent::getSettings('guestbook');

            try {

                $this->database = new \PDO(
                    "mysql:host=localhost;
                    dbname={$settings['name']}",
                    $settings['user'],
                    $settings['password'],
                    [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4']
                );

            } catch (\PDOException) {

                $this->database = null;

            }

            $this->table = Config::getSettings('guestbook')['table'];

        }
        
    }
    
?>
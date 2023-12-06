<?php

    namespace JasminesJournal\Site\Models;

    use JasminesJournal\Core\Config;

    abstract class Guestbook {

        protected readonly object $database;
        protected readonly string $table;

        final public function __construct() {

            $settings = Config::getSettings('guestbook');

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
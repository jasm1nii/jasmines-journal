<?php

    namespace JasminesJournal\Site\Models;

    class GuestbookConn {

        private static function parseConfig(): ?array {

            return parse_ini_file(ENV_CONF, true);

        }

        protected static function getTable(): ?string {

            return self::parseConfig()['guestbook']['table'];

        }

        protected static function connect(): ?object {

            $db = self::parseConfig();

            $servername = "localhost";
            $dbname = $db['guestbook']['name'];
            $user = $db['guestbook']['user'];
            $pass = $db['guestbook']['password'];

            try {

                return new \PDO(
                    "mysql:host=$servername;dbname=$dbname",
                    $user,
                    $pass,
                    [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4']
                );

            } catch (\PDOException $e) {

                return null;
                
            }
        
        }
        
    }
    
?>
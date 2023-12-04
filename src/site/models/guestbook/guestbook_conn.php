<?php

    namespace JasminesJournal\Site\Models;

    class GuestbookConn {

        private static function parseConfig() {

            return parse_ini_file(ENV_CONF, true);

        }

        protected static function getTable() {

            return self::parseConfig()['guestbook']['table'];

        }

        protected static function connect() {

            $db = self::parseConfig();

            $servername = "localhost";
            $dbname = $db['guestbook']['name'];
            $user = $db['guestbook']['user'];
            $pass = $db['guestbook']['password'];

            try {

                $guestbook = new \PDO(
                    "mysql:host=$servername;dbname=$dbname",
                    $user,
                    $pass,
                    [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4']
                );

            } catch (\PDOException $e) {

                $guestbook = null;
                
            }

            return $guestbook;
        
        }
        
    }
    
?>
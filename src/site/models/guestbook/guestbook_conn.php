<?php

    namespace JasminesJournal\Site\Models;

    class GuestbookConn {

        private static function parseConfig() {

            $db = parse_ini_file(ENV_CONF, true);
            return $db;

        }

        protected static function getTable() {

            $table = self::parseConfig()['guestbook']['table'];
            return $table;

        }

        protected static function connect() {

            $db = self::parseConfig();

            $servername = "localhost";
            $dbname = $db['guestbook']['name'];
            $user_show = $db['guestbook']['user'];
            $pass_show = $db['guestbook']['password'];

            try {

                $guestbook_show = new \PDO(
                    "mysql:host=$servername;dbname=$dbname",
                    $user_show,
                    $pass_show,
                    [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4']
                );

            } catch (\PDOException $e) {

                $guestbook_show = null;
                
            }

            return $guestbook_show;
        
        }
        
    }
    
?>
<?php

    namespace JasminesJournal\Core\Model;

    use JasminesJournal\Core\Database;

    class SecurityFilter extends Database {

        protected static string $db_name = 'admin';

        private function setTable() {

            $this->table = $this->db_config['blocklist_table'];

        }

        public function checkBlocklist(): bool|array {

            $this->setTable();

            $sql = $this->database->prepare(
                "SELECT `IP Address`
                FROM `{$this->table}`
                WHERE `IP Address` = INET6_ATON(:ip)"
            );

            $sql->bindValue('ip', $_SERVER['REMOTE_ADDR']);
            $sql->execute();

            return $sql->fetch();

        }

        public function logRequestTime(): void {

            $sql = $this->database->prepare(
                "UPDATE `{$this->table}`
                SET `Last Request` = CURRENT_TIMESTAMP
                WHERE `IP Address` = INET6_ATON(:ip)"
            );

            $sql->bindValue('ip', $_SERVER['REMOTE_ADDR']);
            $sql->execute();

        }

    }
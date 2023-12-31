<?php

    namespace JasminesJournal\Site\Models;

    use JasminesJournal\Core\Database;

    final class GuestbookLatest extends Database {
        
        protected static string $db_name = 'guestbook';
        public ?array $comment;

        final public function get(): void {

            if ($this->database !== null) {

                $sql = $this->database->prepare(
                    "SELECT `ID`, `Date`, `Name`, `Comment`
                    FROM `{$this->table}`
                    WHERE `Moderation Status`='Approved'
                    AND `User Privilege`='Guest'
                    ORDER BY `ID` DESC
                    LIMIT 1"
                );

                $sql->execute();

                $sql->setFetchMode(\PDO::FETCH_ASSOC);
                $this->comment = $sql->fetchAll()[0];

            } else {

                $this->comment = null;

            }

        }

    }
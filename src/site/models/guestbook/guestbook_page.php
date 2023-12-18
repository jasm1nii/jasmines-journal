<?php

    namespace JasminesJournal\Site\Models;

    use JasminesJournal\Core\Database;

    class GuestbookComments extends Database {

        protected static string $db_name = 'guestbook';

        private function templateQuery(): string {

            return 
                "SELECT `ID`, `Parent ID`, `Date`, `Name`, `Website`,`Comment`, `User Privilege`
                FROM `{$this->table}`
                WHERE `Moderation Status`='Approved'";

        }

        private function commentID(): int {

            preg_match('/\d+/', REQUEST, $matches);

            return $matches[0];

        }

        final public function getMessages(int $row_limit): ?array {

            $rows = ($row_limit - 1) * 10;

            if ($this->database !== null) {

                $sql = $this->database->prepare(
                    $this->templateQuery() . "ORDER BY `ID` DESC LIMIT :rows, 10"
                );

                $sql->bindValue('rows', $rows, \PDO::PARAM_INT);
                $sql->execute();
                $sql->setFetchMode(\PDO::FETCH_ASSOC);

                return $sql->fetchAll();

            } else {
                
                return null;
                
            }

        }

        final public function getTotal(): ?int {

            if ($this->database !== null) {

                $sql = $this->database->prepare(
                    "SELECT COUNT(*)
                    FROM `{$this->table}`
                    WHERE `Moderation Status`='Approved'"
                );

                $sql->execute();

                return $sql->fetchColumn();

            } else {

                return null;

            }

        }

        final public function getThread(): array {

            $sql = $this->database->prepare(
                $this->templateQuery() . "AND `ID` = :id"
            );

            $sql->bindValue('id', $this->commentID(), \PDO::PARAM_INT);
            $sql->execute();

            $sql->setFetchMode(\PDO::FETCH_ASSOC);
            return $sql->fetchAll()[0];

        }

        final public function getThreadReplies(): array {

            $sql = $this->database->prepare(
                $this->templateQuery()
                . "AND `Parent ID` = :parent_id
                ORDER BY `ID` ASC"
            );

            $sql->bindValue('parent_id', $this->commentID(), \PDO::PARAM_INT);
            $sql->execute();

            $sql->setFetchMode(\PDO::FETCH_ASSOC);
            return $sql->fetchAll();

        }

    }
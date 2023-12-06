<?php

    namespace JasminesJournal\Site\Models;

    use JasminesJournal\Core\GuestbookConfig;

    class GuestbookComments extends GuestbookConfig {

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
                    $this->templateQuery() . "ORDER BY `ID` DESC LIMIT $rows, 10"
                );

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
                    "SELECT COUNT(*) as total
                    FROM `{$this->table}`
                    WHERE `Moderation Status`='Approved'"
                );

                $sql->execute();
                $sql->setFetchMode(\PDO::FETCH_ASSOC);

                return $sql->fetchAll()[0]['total'];

            } else {

                return null;

            }

        }

        final public function getThread(): array {

            $sql = $this->database->prepare(
                $this->templateQuery() . "AND `ID`={$this->commentID()}"
            );

            $sql->execute();
            $sql->setFetchMode(\PDO::FETCH_ASSOC);

            return $sql->fetchAll()[0];

        }

        final public function getThreadReplies(): array {

            $sql = $this->database->prepare(
                $this->templateQuery() . "AND `Parent ID`={$this->commentID()} ORDER BY `ID` ASC"
            );

            $sql->execute();
            $sql->setFetchMode(\PDO::FETCH_ASSOC);

            return $sql->fetchAll();

        }

    }

?>
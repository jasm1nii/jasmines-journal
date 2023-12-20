<?php

    namespace JasminesJournal\Core\Model;

    use JasminesJournal\Core\Routine;
    use JasminesJournal\Core\Database;
    use JasminesJournal\Core\Controller\Mail;

    class EmailQueue extends Database {

        protected static string $db_name = 'admin';

        private int $sent_count = 0;
        private int $del_count = 0;

        private function setTable(): void {

            $this->table = $this->db_config['email_queue_table'];

        }

        public function add(
            ?string $subject = null,
            ?string $html_body = null,
            ?string $plaintext_body = null
        ): void {

            $this->setTable();

            $sql = $this->database->prepare(
                "INSERT INTO `{$this->table}`
                (`Date`, `Subject`, `HTML Message`, `Plaintext Message`)
                VALUES (current_timestamp(), :subject, :html, :plaintext)"
            );

            $sql->bindValue('subject', $subject);
            $sql->bindValue('html', $html_body);
            $sql->bindValue('plaintext', $plaintext_body);

            $sql->execute();

        }

        private function countAll(): ?int {

            $sql = $this->database->prepare(
                "SELECT COUNT(*)
                FROM `{$this->table}`"
            );

            $sql->execute();

            return $sql->fetchColumn();

        }

        private function retrieveAll(): ?array {

            $sql = $this->database->prepare(
                "SELECT `ID`, `Subject`,
                `HTML Message`, `Plaintext Message`
                FROM `{$this->table}`"
            );

            $sql->execute();
            $sql->setFetchMode(\PDO::FETCH_ASSOC);

            return $sql->fetchAll();

        }

        #[Routine]
        public function sendAll(
            ?bool $clear = false,
            ?bool $show_summary = true,
        ): void {
            
            $this->setTable();

            if ($this->countAll() == 0) {

                // echo "Nothing to send.\n";
                return;

            }

            $mail = new Mail;

            foreach ($this->retrieveAll() as $data) {

                try {

                    $mail->subject = $data['Subject'];
                    $mail->html_body = $data['HTML Message'];
                    $mail->plaintext_body = $data['Plaintext Message'];

                    $mail->sendMessage();

                    $this->sent_count++;

                } catch (\Exception $e) {

                    echo "#{$data['ID']} was not sent - {$e->getMessage()}\n";
                }

                if ($clear) {

                    $this->clearByID($data['ID']);

                }

            }

            if ($show_summary) {

                $this->showSummary();

            }

        }

        private function clearByID(int $id): void {

            try {

                $sql = $this->database->prepare(
                    "DELETE FROM `{$this->table}`
                    WHERE `ID` = :id"
                );

                $sql->bindParam('id', $id);
                $sql->execute();

                $this->del_count++;
            
            } catch (\Exception $e) {

                echo "#{$id} was not deleted - {$e->getMessage()}\n";

            }

        }

        public function clearAll(): void {

            $this->table ??= $this->setTable();

            $sql = $this->database->prepare(
                "TRUNCATE `{$this->table}`"
            );

            $sql->execute();

            $this->del_count++;

        }

        private function showSummary(): void {

            $sent_msg = ($this->sent_count == 1)
                ? "One email was sent"
                : "{$this->sent_count} emails were sent";

            $del_msg = ($this->del_count == 1)
                ? " and one queue item was deleted.\n"
                : " and {$this->del_count} queue items were deleted.\n";

            echo $sent_msg . $del_msg;

        }

    }
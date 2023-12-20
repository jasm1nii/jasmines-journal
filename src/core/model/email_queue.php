<?php

    namespace JasminesJournal\Core\Model;

    use JasminesJournal\Core\Routine;
    use JasminesJournal\Core\Database;
    use JasminesJournal\Core\Controller\Mail;

    class EmailQueue extends Database {

        protected static string $db_name = 'admin';

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

        private function count(): ?int {

            $sql = $this->database->prepare(
                "SELECT COUNT(*)
                FROM `{$this->table}`"
            );

            $sql->execute();

            return $sql->fetchColumn();

        }

        private function retrieve(): ?array {

            $this->setTable();

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
        public function send(?bool $clear = false): void {

            $mail = new Mail;

            $sent_count = 0;
            $del_count = 0;

            foreach ($this->retrieve() as $data) {

                try {

                    $mail->subject = $data['Subject'];
                    $mail->html_body = $data['HTML Message'];
                    $mail->plaintext_body = $data['Plaintext Message'];

                    $mail->sendMessage();
                    $sent_count++;

                } catch (\Exception $e) {

                    echo "#{$data['ID']} was not sent - {$e->getMessage()}\n";
                }

                if ($clear) {

                    try {

                        $sql = $this->database->prepare(
                            "DELETE FROM `{$this->table}`
                            WHERE `ID` = :id" 
                        );

                        $sql->bindParam('id', $data['ID']);
                        $sql->execute();

                        $del_count++;
                    
                    } catch (\Exception $e) {

                        echo "#{$data['ID']} was not deleted - {$e->getMessage()}\n";

                    }

                }

            }

            $sent_msg = ($sent_count == 1)
                ? "One email was sent"
                : "{$sent_count} emails were sent";

            $del_msg = ($del_count == 1)
                ? " and one queue item was deleted.\n"
                : " and {$del_count} queue items were deleted.\n";

            echo $sent_msg . $del_msg;

        }

    }
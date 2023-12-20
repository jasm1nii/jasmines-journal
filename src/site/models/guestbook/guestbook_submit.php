<?php

    namespace JasminesJournal\Site\Models;

    use JasminesJournal\Core\Model\EmailQueue;
    use JasminesJournal\Site\Models\GuestbookComments;
    use JasminesJournal\Site\RequestRouter;

    final class GuestbookPOST extends GuestbookComments {

        private string $sender_name;
        private string $sender_email;
        private string $sender_url;
        private string $sender_message;

        private object $mail;

        final public function processInput(): void {

            try {

                $this->sanitizeInput();
                $this->alterTable();
                $this->insertIntoTable();
                $this->queueEmail();

                RequestRouter\Guestbook::sendHeader('success');

            } catch (Exception) {

                RequestRouter\Guestbook::sendHeader('error');

            }

        }

        private function sanitizeInput(): void {

            if ($_POST['name'] == null) {

                $this->sender_name = 'Anonymous';

            } else {

                $this->sender_name = htmlspecialchars(
                    $_POST['name'], ENT_QUOTES | ENT_HTML401, 'UTF-8', true
                );

            }

            $this->sender_email = filter_var(
                $_POST['email'], FILTER_SANITIZE_EMAIL
            );

            $this->sender_url = filter_var(
                $_POST['website'], FILTER_SANITIZE_URL
            );

            $this->sender_message = htmlspecialchars(
                $_POST['message'], ENT_QUOTES | ENT_HTML401, 'UTF-8', true
            );

        }

        private function alterTable(): void {

           $sql = $this->database->prepare(
                "ALTER TABLE `{$this->table}` AUTO_INCREMENT = 0"
            );

            $sql->execute();

        }

        private function insertIntoTable(): void {

            $sql = $this->database->prepare(
                "INSERT INTO `{$this->table}`
                (`Date`, `Name`, `Email`, `Website`, `Comment`,
                `IP Address`, `Moderation Status`, `User Privilege`)
                VALUES (current_timestamp(), :name, :email, :url,
                :message, INET6_ATON(:ip), 'Pending', 'Guest')"
            );

            $sql->bindValue('name', $this->sender_name);
            $sql->bindValue('email', $this->sender_email);
            $sql->bindValue('url', $this->sender_url);
            $sql->bindValue('message', $this->sender_message);
            $sql->bindValue('ip', $_SERVER['REMOTE_ADDR']);

            $sql->execute();

        }

        private function queueEmail(): void {

            $subject = "guestbook message received!";

            $name       = "Name: {$this->sender_name}";
            $email      = "Email: {$this->sender_email}";
            $url        = "URL: {$this->sender_url}";
            $message    = "Message: {$this->sender_message}";

            $html = "<ul><li>{$message}</li>";
            $html .= "<li>{$email}</li>";
            $html .= "<li>{$url}</li>";
            $html .= "<li>{$message}</li></ul>";

            $plaintext = "{$name} - {$email} - {$url} - {$message}";

            $queue = new EmailQueue;
            $queue->add(
                subject: $subject,
                html_body: $html,
                plaintext_body: $plaintext
            );

        }

    }
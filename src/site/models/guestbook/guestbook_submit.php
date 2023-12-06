<?php

    namespace JasminesJournal\Site\Models;

    use JasminesJournal\Core\Controller\Mail;
    use JasminesJournal\Site\Models\Guestbook;
    use JasminesJournal\Site\RequestRouter;

    final class GuestbookPOST extends Guestbook {

        private string $sender_name;
        private string $sender_email;
        private string $sender_url;
        private string $sender_message;

        private object $mail;

        final public function processInput(): void {

            try {

                $this->sanitizeInput();
                $this->sendToDB();

                $this->composeEmail();
                $this->sendEmail();

            } catch (Exception) {

                RequestRouter\Guestbook::sendHeader('error');

            }

        }

        private function sanitizeInput(): void {

            if ($_POST['name'] == null) {
                
                $this->sender_name = 'Anonymous';

            } else {

                $this->sender_name = htmlspecialchars($_POST['name'], ENT_QUOTES | ENT_HTML401, 'UTF-8', true);

            }

            $this->sender_email
                = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            $this->sender_url
                = filter_var($_POST['website'], FILTER_SANITIZE_URL);

            $this->sender_message
                = htmlspecialchars($_POST['message'], ENT_QUOTES | ENT_HTML401, 'UTF-8', true);

        }

        private function sendToDB(): void {

            $sql_incr = $this->database->prepare(
                "ALTER TABLE `{$this->table}` AUTO_INCREMENT=0"
            );

            $sql_incr->execute();

            $sql_post = $this->database->prepare(
                "INSERT INTO `{$this->table}` (`ID`, `Date`, `Name`, `Email`, `Website`, `Comment`, `IP Address`, `Moderation Status`, `User Privilege`)
                VALUES (NULL, current_timestamp(), :name, :email, :url, :message, INET6_ATON(:ip), 'Pending', 'Guest')"
            );

            $sql_post->bindParam(':name', $this->sender_name);
            $sql_post->bindParam(':email', $this->sender_email);
            $sql_post->bindParam(':url', $this->sender_url);
            $sql_post->bindParam(':message', $this->sender_message);
            $sql_post->bindParam(':ip', $_SERVER['REMOTE_ADDR']);

            $sql_post->execute();

        }

        private function composeEmail(): void {

            $this->mail = new Mail();

            $this->mail->subject = "guestbook message received!";

            $this->mail->html_body =
                "<ul>
                    <li>Name: {$this->sender_name}</li>
                    <li>Email: {$this->sender_email}</li>
                    <li>URL: {$this->sender_url}</li>
                    <li>Message: {$this->sender_message}</li>
                </ul>";
                    
            $this->mail->plaintext_body =
                "Name: {$this->sender_name} - Email: {$this->sender_email} - URL: {$this->sender_url} - Message: {$this->sender_message}";
            
        }

        private function sendEmail(): void {

            try {

                $this->mail->sendMessage();
                
                RequestRouter\Guestbook::sendHeader('success');
                
            } catch (Exception) {

                RequestRouter\Guestbook::sendHeader('exception');

            }
            
        }

    }

?>
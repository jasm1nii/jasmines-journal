<?php

    namespace JasminesJournal\Site\Models;

    use JasminesJournal\Site\Models\GuestbookConn;
    use JasminesJournal\Site\RequestRouter;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    final class GuestbookPOST extends GuestbookConn {

        private string $sender_name;
        private string $sender_email;
        private string $sender_url;
        private string $sender_message;

        final public function __construct() {

            $this->sanitizeInput();
            $this->sendToDB();
            $this->notifySystem();

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

            $guestbook_post = parent::connect();
            $table = parent::getTable();

            $sql_incr = $guestbook_post->prepare("ALTER TABLE `$table`AUTO_INCREMENT=0");
            $sql_incr->execute();

            $sql_post = $guestbook_post->prepare(
                "INSERT INTO `$table` (`ID`, `Date`, `Name`, `Email`, `Website`, `Comment`, `IP Address`, `Moderation Status`, `User Privilege`)
                VALUES (NULL, current_timestamp(), :name, :email, :url, :message, INET6_ATON(:ip), 'Pending', 'Guest')"
            );

            $sql_post->bindParam(':name', $this->sender_name);
            $sql_post->bindParam(':email', $this->sender_email);
            $sql_post->bindParam(':url', $this->sender_url);
            $sql_post->bindParam(':message', $this->sender_message);
            $sql_post->bindParam(':ip', $_SERVER['REMOTE_ADDR']);

            $sql_post->execute();

            $guestbook_post = null;

        }

        private function notifySystem(): void {

            $ini = parse_ini_file(ENV_CONF, true)['email'];
            $mail = new PHPMailer(true);

            try {

                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->CharSet = "UTF-8";

                $mail->Host = $ini['host'];
                $mail->Port = $ini['port'];
                $mail->Username = $ini['user'];
                $mail->Password = $ini['password'];

                $mail->setFrom($ini['user'], $ini['from_name']);
                $mail->addAddress($ini['to'], $ini['to_name']);
                $mail->isHTML(true);

                $mail->Subject = "guestbook message received!";
                $mail->Body =
                    "<ul>
                        <li>Name: {$this->sender_name}</li>
                        <li>Email: {$this->sender_email}</li>
                        <li>URL: {$this->sender_url}</li>
                        <li>Message: {$this->sender_message}</li>
                    </ul>";
                $mail->AltBody = "Name: {$this->sender_name} - Email: {$this->sender_email} - URL: {$this->sender_url} - Message: {$this->sender_message}";
                
                $mail->send();

                RequestRouter\Guestbook::sendHeader('success');
                
            } catch (Exception) {

                RequestRouter\Guestbook::sendHeader('exception');

                return;

            }
            
        }

    }

?>
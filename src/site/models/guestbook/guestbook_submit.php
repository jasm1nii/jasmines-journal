<?php

    namespace JasminesJournal\Site\Models;

    use JasminesJournal\Site\Models\GuestbookConn;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class GuestbookPOST extends GuestbookConn {

        private $sender_name;
        private $sender_email;
        private $sender_url;
        private $sender_message;

        public function __construct() {

            if ($_POST['name'] == null) {
                
                $this->sender_name = 'Anonymous';

            } else {

                $this->sender_name = htmlspecialchars($_POST['name'], ENT_QUOTES | ENT_HTML401, 'UTF-8', true);

            }

            $this->sender_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            $this->sender_url = filter_var($_POST['website'], FILTER_SANITIZE_URL);
            
            $this->sender_message = htmlspecialchars($_POST['message'], ENT_QUOTES | ENT_HTML401, 'UTF-8', true);

            $this->sendToDB();
            $this->notifySystem();

        }

        private function sendToDB() {

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

        private function notifySystem() {

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
                
            } catch (Exception $e) {

                header('Location: /guestbook/success/exception');
                return;

            }

            header('Location: /guestbook/success');

        }

    }

?>
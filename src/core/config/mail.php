<?php

    namespace JasminesJournal\Core\Controller;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    use JasminesJournal\Core\Config;

    class Mail {

        private readonly string $host;
        private readonly string $port;
        private readonly string $user;
        private readonly string $pass;

        private string $subject;
        private string $html_body;
        private string $plaintext_body;

        final public function __construct(string $subject, string $html_body, string $plaintext_body) {

            $this->subject = $subject;
            $this->html_body = $html_body;
            $this->plaintext_body = $plaintext_body;

            $this->sendMessage();

        }

        private function parseConfig(): void {

            $ini = Config::getSettings('email');

            $this->host = $ini['host'];
            $this->port = $ini['port'];
            $this->user = $ini['user'];
            $this->pass = $ini['password'];

            $this->sender_addr = $ini['user'];
            $this->sender_name = $ini['from_name'];
            $this->recipient_addr = $ini['to'];
            $this->recipient_name = $ini['to_name'];

        }

        private function setupMailer(): object {

            $this->parseConfig();

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->isHTML(true);

            $mail->SMTPAuth     = true;
            $mail->SMTPSecure   = PHPMailer::ENCRYPTION_SMTPS;
            $mail->CharSet      = "UTF-8";

            $mail->Host     = $this->host;
            $mail->Port     = $this->port;
            $mail->Username = $this->user;
            $mail->Password = $this->pass;

            $mail->setFrom($this->sender_addr, $this->sender_name);
            $mail->addAddress($this->recipient_addr, $this->recipient_name);

            return $mail;

        }

        private function sendMessage(): void {

            $mail = $this->setupMailer();
            
            $mail->Subject  = $this->subject;
            $mail->Body     = $this->html_body;
            $mail->AltBody  = $this->plaintext_body;
            
            $mail->send();

        }

    }

?>
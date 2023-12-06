<?php

    namespace JasminesJournal\Core\Config;
    use JasminesJournal\Core\Config\Config;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Mail extends Config {

        private readonly string $host;
        private readonly string $port;
        private readonly string $user;
        private readonly string $pass;

        private function parseConfig(): void {

            $ini = parent::getSettings('email');

            $this->host = $ini['host'];
            $this->port = $ini['port'];
            $this->user = $ini['user'];
            $this->pass = $ini['password'];

            $this->sender_addr = $ini['user'];
            $this->sender_name = $ini['from_name'];
            $this->recipient_addr = $ini['to'];
            $this->recipient_name = $ini['to_name'];

        }

        final public function setupClient(): object {

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

            return $mail;

        }

    }

?>
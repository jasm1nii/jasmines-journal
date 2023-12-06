<?php

    namespace JasminesJournal\Core;
    use JasminesJournal\Core\Config;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    abstract class MailConfig extends Config {

        protected readonly array $settings;
        protected object $client;

        private readonly string $host;
        private readonly string $port;
        private readonly string $user;
        private readonly string $pass;

        private function parseConfig(): void {

            $this->host = $this->settings['host'];
            $this->port = $this->settings['port'];
            $this->user = $this->settings['user'];
            $this->pass = $this->settings['password'];

        }

        private function setupClient(): void {

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

            $this->client = $mail;
        }

        final protected function initialize(): void {

            $this->settings = parent::getSettings('email');

            $this->parseConfig();
            $this->setupClient();

        }

    }

?>
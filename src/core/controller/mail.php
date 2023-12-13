<?php

    namespace JasminesJournal\Core\Controller;

    use JasminesJournal\Core\MailConfig;

    class Mail extends MailConfig {

        public string $from_addr;
        public string $from_name;
        public string $to_addr;
        public string $to_name;

        public string $subject;
        public string $html_body;
        public string $plaintext_body;

        final public function __construct() {

            $this->initialize();

            $this->from_addr = $this->settings['user'];
            $this->from_name = $this->settings['from_name'];

            $this->to_addr = $this->settings['to'];
            $this->to_name = $this->settings['to_name'];

        }

        final public function sendMessage(): void {

            $mail = $this->client;

            $mail->setFrom($this->from_addr, $this->from_name);
            $mail->addAddress($this->to_addr, $this->to_name);
            
            $mail->Subject  = $this->subject;
            $mail->Body     = $this->html_body;
            $mail->AltBody  = $this->plaintext_body;
            
            $mail->send();

        }

    }
<?php

    namespace JasminesJournal\Core\Controller;

    use JasminesJournal\Core\Config;

    class Mail {

        public string $subject;
        public string $html_body;
        public string $plaintext_body;

        final public function sendMessage(): void {

            $config = new Config\Mail();
            $mail = $config->setupClient();

            $mail->setFrom($this->sender_addr, $this->sender_name);
            $mail->addAddress($this->recipient_addr, $this->recipient_name);
            
            $mail->Subject  = $this->subject;
            $mail->Body     = $this->html_body;
            $mail->AltBody  = $this->plaintext_body;
            
            $mail->send();

        }

    }

?>
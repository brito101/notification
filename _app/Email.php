<?php

namespace Notification;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email {

    private $mail = \stdClass::class;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        //Server settings
        $this->mail->SMTPDebug = '2';                      // Enable verbose debug output
        $this->mail->isSMTP();                                            // Send using SMTP
        $this->mail->Host = 'smtp.live.com';                    // Set the SMTP server to send through
        $this->mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $this->mail->Username = 'rodrigobrito101@hotmail.com';                     // SMTP username
        $this->mail->Password = '**********';                               // SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $this->mail->Port = 587;
        $this->mail->CharSet = 'utf8';
        $this->mail->setLanguage('br');
        $this->mail->isHTML(true);
        //Recipients
        $this->mail->setFrom('rodrigobrito101@hotmail.com', 'Rodrigo Brito');
    }

    public function sendEmail($subject, $body, $replyEmail, $replyName, $addressEmail, $addressName) {
        $this->mail->Subject = (string) $subject;
        $this->mail->Body = $body;
        $this->mail->addReplyTo($replyEmail, $replyName);
        $this->mail->addAddress($addressEmail, $addressName);
        try {
            $this->mail->send();
        } catch (Exception $ex) {
            echo "Erro ao enviar o e-mail: {$this->mail->ErrorInfo} {$ex->getMessage()}";
        }
    }

}

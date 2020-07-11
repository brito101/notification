<?php

namespace Notification;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email {

    private $mail = \stdClass::class;

    public function __construct($smtpDebug, $host, $user, $pass, $port, $setFromEmail, $setFromName) {
        $this->mail = new PHPMailer(true);
        //Server settings
        $this->mail->SMTPDebug = $smtpDebug;                      // Enable verbose debug output
        $this->mail->isSMTP();                                                              // Send using SMTP
        $this->mail->Host = $host;                                                       // Set the SMTP server to send through
        $this->mail->SMTPAuth = true;                                             // Enable SMTP authentication
        $this->mail->Username = $user;                                           // SMTP username
        $this->mail->Password = $pass;                                              // SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $this->mail->Port = $port;
        $this->mail->CharSet = 'utf8';
        $this->mail->setLanguage('br');
        $this->mail->isHTML(true);
        //Recipients
        $this->mail->setFrom($setFromEmail, $setFromName);
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

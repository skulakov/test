<?php
    /**
     * Created by PhpStorm.
     * User: SK
     * Date: 09.01.2019
     * Time: 11:00
     */

    namespace lib;


    use lib\PHPMailer\PHPMailer;

    class Email {

        public function sendRemindTest() { // Прет в спам
            $to = 's.culackow@gmail.com';
            $subject = 'Изменение пароля';
            $message = 'Test';

            $headers = 'To: Sergei <s.culackow@gmail.com>' . "\r\n" .
                'From: webmaster@example.com' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
        }

        public function sendRemind($to, $toName, $code) {
            $subject = 'Изменение пароля';
            $message = "Новый пароль {$code}";

            return $this->send($subject, $to, $toName, $message);
        }

        private function send($subject, $email, $userName, $message) {
            $mail = new PHPMailer(true);
            $mail->CharSet = "UTF-8";

            // STMP
            $mail->SMTPDebug = 0;         // Enable verbose debug output
            $mail->isSMTP();              // Set mailer to use SMTP
            $mail->Host = SMTP_HOST;      // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;       // Enable SMTP authentication
            $mail->Username = SMTP_USER;  // SMTP username
            $mail->Password = SMTP_PASS;  // SMTP password
            $mail->SMTPSecure = 'tls';    // Enable TLS encryption, `ssl` also accepted
            $mail->Port = SMTP_PORT;      // TCP port to connect to

            //Recipients
            $mail->setFrom(SMTP_USER, 'info');
            $mail->addAddress($email, $userName);     // Add a recipient
                      // Name is optional
            $mail->addReplyTo(SMTP_USER, 'admin');

            //Content
            $mail->isHTML(true);    // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = $message;;

            return $mail->send() ? true : false;

        }
    }
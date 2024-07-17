<?php

    require './conn.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "./PHPMailer/src/Exception.php";
    require "./PHPMailer/src/PHPMailer.php";
    require "./PHPMailer/src/SMTP.php";

    function sendMail($receiver, $subject, $body) {
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "araujofid5@gmail.com";
            $mail->Password = "gdkkwahwuvwxvwcf";

            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;

            $mail->setFrom("araujofid5@gmail.com", "Your Name"); // Set your name here
            $mail->addAddress($receiver);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function generatePassword() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        $length = 8;

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $password;
    }

?>
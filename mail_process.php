<?php

// creates object
function send_mail($emails, $subjects, $messages, $text_messages)
{

    $mail = new PHPMailer(true);

    $email = $emails;
    $message = $messages;
    $subject =  $subjects;
    $text_message    = $text_messages;

    try {
        $mail->IsSMTP();
        $mail->isHTML(true);
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port        = '465';
        $mail->AddAddress($email);
        $mail->Username   = "chinhtruongba@gmail.com";
        $mail->Password   = "Anhchinh123";
        $mail->SetFrom('chinhtruongba@gmail.com', 'Truong Ba Chinh');
        $mail->AddReplyTo("chinhtruongba@gmail.com", "Truong Ba Chinh");
        $mail->Subject    = $subject;
        $mail->Body    = $message;
        $mail->AltBody    = $message;

        if ($mail->Send()) {

            $msg = "Hi, Your mail successfully sent to" . $email . " ";
        }
    } catch (phpmailerException $ex) {
        $msg = "<div class='alert alert-warning'>" . $ex->errorMessage() . "</div>";
    }
}

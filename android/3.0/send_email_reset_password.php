<?php
require '../connection.php';
$email = mysqli_real_escape_string($connection, $_POST['email']);
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    //$mail->SMTPDebug = 10;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP                                   
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'tugaskita.com@gmail.com';         // SMTP username
    $mail->Password = 'tugasandaprioritaskami';           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                   // TCP port to connect to

    //Recipients
    $mail->setFrom('tugaskita.com@gmail.com', 'TugasKita.id');
    $mail->addAddress($email);     // Add a recipient
    // $mail->addAddress('fotografi.erwinyonata@gmail.com');                         // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Reset Password';
    $mail->Body    = '<a href="http://tugaskita.epizy.com/tugaskita/web/change-password.php?email='.$email.'">Change Password Click This!</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $ind['success'] = "1";
    $ind['message'] = "Message has been sent";
    echo json_encode($ind);
    exit();
} catch (Exception $e) {
    $ind['success'] = "0";
    $ind['message'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
    echo json_encode($ind);
    exit();
}
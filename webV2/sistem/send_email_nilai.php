<?php
session_start();
require 'connection.php';
$email = mysqli_real_escape_string($connection, $_GET['email']);
$namapaket = mysqli_real_escape_string($connection, $_GET['namapaket']);
$nilai = mysqli_real_escape_string($connection, $_GET['nilai']);
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
    $mail->Host = 'mail.sibercenter.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'tugaskitaindonesia@sibercenter.com';         // SMTP username
    $mail->Password = '#indrapura32';           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    //Recipients
    $mail->setFrom('tugaskitaindonesia@sibercenter.com', 'TugasKita');
    $mail->addAddress($email);     // Add a recipient
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Laporan Nilai "'.$namapaket.'"';
    $mail->Body    = '<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
    <style type="text/css">
      #sambutan {
        font-family: \'Nunito\', sans-serif;
      }
      #header {
        font-family: \'Asap\', sans-serif;
      }
    </style>
  </head>
  <body>
      <h1 id="header"><img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_180/v1571068816/tugaskita/assets/ico.png" width="70"> TugasKita <small class="text-info">CBTL</small></h1>
      <div class="card">
        <div class="card-body">
          <span id="sambutan">Terima kasih telah mengikuti TugasKita CBTL paket "'.$namapaket.'". Anda mendapatkan nilai: <u>'.$nilai.'</u></span><br>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>';
    $mail->AltBody = 'Terima kasih telah mengikuti TugasKita CBTL paket "'.$namapaket.'". Anda mendapatkan nilai: '.$nilai;
    $mail->send();
    header("Location: ../cbt-dashboard");
    exit();
} catch (Exception $e) {
    echo $mail->ErrorInfo;
}
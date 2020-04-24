<?php
require '../connection.php';
date_default_timezone_set('Asia/Jakarta');
$info = getdate(date("U"));
$date = $info['mday']; // 2
$date_n = $info['weekday']; // TUESDAY
$month = $info['mon']; // 1
$month_n = $info['month']; // JANUARY
$year = $info['year'];
$hour = $info['hours'];
$min = $info['minutes'];
$sec = $info['seconds'];
$email = mysqli_real_escape_string($connection, $_GET['email']);
if (isset($_POST['namalengkap'])) {
  $namalengkap = mysqli_real_escape_string($connection, $_POST['namalengkap']);
} else {
  $namalengkap = "User";
}
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    // $mail->SMTPDebug = 10;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP                                   
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'tugaskita.com@gmail.com';         // SMTP username
    $mail->Password = 'tugasandaprioritaskami';           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('tugaskitaindonesia@mailjet.com', 'TugasKita.id');
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
    $mail->Subject = 'Change Password Confirmed!';
    $mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Neopolitan Confirm Email</title>
  <!-- Designed by https://github.com/kaytcat -->
  <!-- Robot header image designed by Freepik.com -->

  <style type="text/css">
  @import url(http://fonts.googleapis.com/css?family=Droid+Sans);

  /* Take care of image borders and formatting */

  img {
    max-width: 600px;
    outline: none;
    text-decoration: none;
    -ms-interpolation-mode: bicubic;
  }

  a {
    text-decoration: none;
    border: 0;
    outline: none;
    color: #bbbbbb;
  }

  a img {
    border: none;
  }

  /* General styling */

  td, h1, h2, h3  {
    font-family: Helvetica, Arial, sans-serif;
    font-weight: 400;
  }

  td {
    text-align: center;
  }

  body {
    -webkit-font-smoothing:antialiased;
    -webkit-text-size-adjust:none;
    width: 100%;
    height: 100%;
    color: #37302d;
    background: #ffffff;
    font-size: 16px;
  }

   table {
    border-collapse: collapse !important;
  }

  .headline {
    color: #ffffff;
    font-size: 36px;
  }

 .force-full-width {
  width: 100% !important;
 }

 .force-width-80 {
  width: 80% !important;
 }
  </style>

  <style type="text/css" media="screen">
      @media screen {
         /*Thanks Outlook 2013! http://goo.gl/XLxpyl*/
        td, h1, h2, h3 {
          font-family: "Droid Sans", "Helvetica Neue", "Arial", "sans-serif" !important;
        }
      }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class="w320"] {
        width: 320px !important;
      }

      td[class="mobile-block"] {
        width: 100% !important;
        display: block !important;
      }


    }
  </style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table align="center" cellpadding="0" cellspacing="0" class="force-full-width" height="100%" >
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"  width="100%">
      <center>
        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="600" class="w320">
          <tr>
            <td align="center" valign="top">
                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" style="margin:0 auto;">
                  <tr>
                    <td style="font-size: 30px; text-align:center;">
                      <br>
                        Hey, '.explode(" ", $namalengkap)[0].'
                      <br>
                      <br>
                    </td>
                  </tr>
                </table>
                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#4dbfbf">
                  <tr>
                    <td>
                    <br>
                      <img src="https://www.filepicker.io/api/file/carctJpuT0exMaN8WUYQ" width="224" height="240" alt="robot picture">
                    </td>
                  </tr>
                  <tr>
                    <td class="headline">
                      Success
                    </td>
                  </tr>
                  <tr>
                    <td>

                      <center>
                        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="60%">
                          <tr>
                            <td style="color:#187272;">
                            <br>
                             Password anda berhasil diubah! 
                            <br>
                            <br>
                            </td>
                          </tr>
                        </table>
                      </center>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div><!--[if mso]>
                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:50px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#178f8f">
                          <w:anchorlock/>
                        </v:roundrect>
                      <![endif]--></div>
                      <br>
                      <br>
                    </td>
                  </tr>
                </table>
                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#f5774e">
                  <tr>
                    <td style="background-color:#f5774e;">
                    <center>
                      <table style="margin:0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
                        <tr>
                          <td  class="mobile-block" >
                          <br>
                          <br>
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="color:#ffffff; background-color:#ac4d2f; padding: 10px 0px;">
                                  Tanggal Ubah Password
                                </td>
                              </tr>
                              <tr>
                                <td style="color:#933f24; padding:10px 0px; background-color: #f7a084;">
                                '.$date_n.", ".$date." ".$month_n." ".$year.'
                                </td>
                              </tr>
                            </table>
                            <br>
                          </td>
                        </tr>
                      </table>
                      <table style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
                        <tr>
                          <td style="text-align:left; color:#933f24;">
                          <br>
                            Terima kasih atas memberi kepercayaan kepada kami, Anda telah menggunakan TugasKita Indonesia sebagai aplikasi manajemen Anda.
                          <br>
                          <br>
                          -TugasKita
                          <br>
                          <br>
                          <br>
                          </td>
                        </tr>
                      </table>
                    </center>
                    </td>
                  </tr>
                </table>
                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#414141" style="margin: 0 auto">
                  <tr>
                    <td style="color:#FFF; font-size:12px;">
                        <br><br>
                       Remember All Things
                       <br><br><br>
                    </td>
                  </tr>
                  <tr>
                    <td style="color:#bbbbbb; font-size:12px;">
                       © '.$year.' TugasKita Indonesia
                       <br>
                       <br>
                    </td>
                  </tr>
                </table>
            </td>
          </tr>
        </table>
    </center>
    </td>
  </tr>
</table>
</body>
</html>';
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
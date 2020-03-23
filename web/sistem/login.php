<?php
    session_start();
    require 'connection.php';
    if ($_SERVER['REQUEST_METHOD']=='POST') {        
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $email = strtolower($email);
        if(strpos($email, "@") !== false){
            # CONTAINS
        } else{
            # NOT CONTAINS
            echo "error! email invalid...";
            mysqli_close($connection);  
            exit();  
        }
        $pwd = mysqli_real_escape_string($connection, $_POST['password']);

        $SQL = "SELECT * FROM akun WHERE user_email='$email';";
        $RES = mysqli_query($connection, $SQL);
        $result = array();
        $result['login'] = array();
        if(mysqli_num_rows($RES) === 1) {
            $FET = mysqli_fetch_assoc($RES);
            if(password_verify($pwd, $FET['user_password'])) {
                // SESSION STORAGE
                $_SESSION['user_id'] = $FET['user_id'];
                $_SESSION['user_namalengkap'] = $FET['user_namalengkap'];
                $_SESSION['user_nama'] = $FET['user_nama'];
                $_SESSION['user_email'] = $FET['user_email'];
                $_SESSION['user_avatar'] = "https://res.cloudinary.com/dizwvnwu0/image/upload/v1526631738/icon/reading_ebook-512.png";
                if ($FET['user_avatar'] != null) {
                    $_SESSION['user_avatar'] = "https://res.cloudinary.com/dizwvnwu0/image/upload/c_lfill,h_500,w_500/v1525499092/tugaskita/profile/".$FET['user_avatar'].".png";
                }
                header("Location: ../dashboard");
                mysqli_close($connection);
                exit();
            } else {
                echo "error! you entered invalid data...";
                mysqli_close($connection);
                exit();
            }
        } else {
            echo "error! akun yang Anda cari belum terdaftar di database kami...";
            mysqli_close($connection);
            exit();
        }
    }
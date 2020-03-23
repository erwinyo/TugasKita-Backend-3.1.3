<?php
    session_start();
    require 'connection.php';     
    if (isset($_GET['email']) && isset($_GET['password'])) {
        $email = mysqli_real_escape_string($connection, $_GET['email']);
        $pwd = mysqli_real_escape_string($connection, $_GET['password']);
    }else { 
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $pwd = mysqli_real_escape_string($connection, $_POST['password']);
    }
    
    $email = strtolower($email);
    if(strpos($email, "@") != false){
        # CONTAINS
    } else{
        # NOT CONTAINS
        echo "error! email invalid...";
        mysqli_close($connection);  
        exit();  
    }

    $SQL = "SELECT * FROM akun WHERE user_email='$email';";
    $RES = mysqli_query($connection, $SQL);
    $result = array();
    $result['login'] = array();
    if(mysqli_num_rows($RES) === 1) {
        $FET = mysqli_fetch_assoc($RES);
        if(password_verify($pwd, $FET['user_password'])) {
            // SESSION STORAGE
            $_SESSION['userid'] = $FET['user_id'];
            $_SESSION['usernamalengkap'] = $FET['user_namalengkap'];
            $_SESSION['usernama'] = $FET['user_nama'];
            $_SESSION['useremail'] = $FET['user_email'];
            $_SESSION['userpoint'] = $FET['user_point'];

            if ((isset($_POST['type']) && $_POST['type'] == "cbt-siswa") || (isset($_GET['type']) && $_GET['type'] == "cbt-siswa")) {
                header("Location: ../cbt-start");
            } else {
                header("Location: ../dashboard");
            }
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
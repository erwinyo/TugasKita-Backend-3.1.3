<?php
    session_start();
    require 'connection.php';
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        # Convert to Capitalize words
        $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
        $fullname = ucwords(strtolower($fullname));

        # Convert to lowercase words AND check for space ' '
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $username = strtolower($username);
        if(strpos($username, " ") !== false){
            # CONTAINS
            echo "error! username invalid...";
            mysqli_close($connection);  
            exit(); 
        } else{
            # NOT CONTAINS
        }

        # Convert to lowercase words AND check '@' sign
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
        $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $RANDOMID = uniqid();

        $chkUsernameSQL = "SELECT * FROM akun WHERE user_nama='$username';";
        $chkUsernameRES = mysqli_query($connection, $chkUsernameSQL);
        $chkUsernameROW = mysqli_num_rows($chkUsernameRES);

		$chkEmailSQL = "SELECT * FROM akun WHERE user_email='$email';";
        $chkEmailRES = mysqli_query($connection, $chkEmailSQL);
        $chkEmailROW = mysqli_num_rows($chkEmailRES);
        if ($chkUsernameROW > 0) {
        	echo "error! username sudah diambil...";
            mysqli_close($connection);	
            exit();
        }
        if ($chkEmailROW > 0) {
        	echo "error! email sudah terdaftar...";
            mysqli_close($connection);	
            exit();
        }

        $sql = "INSERT INTO akun (user_id, user_namalengkap, user_nama, user_email, user_password) VALUES ('$RANDOMID', '$fullname', '$username', '$email', '$hashed_pwd')";
        if (mysqli_query($connection, $sql)) {
            $_SESSION['user_id'] = $RANDOMID;
            $_SESSION['user_name'] = $username;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_namalengkap'] = $fullname;
            $_SESSION['user_avatar'] = "https://res.cloudinary.com/dizwvnwu0/image/upload/v1526631738/icon/reading_ebook-512.png";

            header("Location: ../dashboard");
            mysqli_close($connection);
            exit();
        } else {
            echo "error! there is error while sending data...";
            mysqli_close($connection);	
            exit();
        }
    }
?>
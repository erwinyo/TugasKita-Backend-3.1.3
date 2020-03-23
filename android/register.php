<?php
    session_start();
    require 'connection.php';
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
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
        	$result["success"] = "001";
            $result["message"] = "error! username sudah diambil!";
            echo json_encode($result);
            mysqli_close($connection);	
            exit();
        }
        if ($chkEmailROW > 0) {
        	$result["success"] = "002";
            $result["message"] = "error! email sudah terdaftar!";

            echo json_encode($result);
            mysqli_close($connection);	
            exit();
        }

        $profile = array("boy", "boy_1", "girl", "girl_1", "man", "man_1", "man_2", "man_3", "man_4");
        $selectedProfile = $profile[rand(0, count($profile)-1)];

        $sql = "INSERT INTO akun (user_id, user_namalengkap, user_nama, user_email, user_password, user_cerita, user_avatar_alternative, user_point, user_notification) VALUES ('$RANDOMID', '$fullname', '$username', '$email', '$hashed_pwd', 'Hey, I\'m here at TugasKita','$selectedProfile','1000', '1')";
        if (mysqli_query($connection, $sql)) {
            $_SESSION['userid'] = $RANDOMID;
            $_SESSION['username'] = $username;
            $_SESSION['useremail'] = $email;
            $_SESSION['userpassword'] = $password;

            $result["success"] = "1";
            $result["message"] = "success";
            echo json_encode($result);
            mysqli_close($connection);
            exit();
        } else {
            $result["success"] = "0";
            $result["message"] = "error! DATABASE";
            echo json_encode($result);
            mysqli_close($connection);	
            exit();
        }
    }
?>
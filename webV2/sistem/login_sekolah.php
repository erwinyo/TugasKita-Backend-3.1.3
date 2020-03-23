<?php
	session_start();
	require 'connection.php';

	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$email = strtolower($email);
    if(strpos($email, "@") != false){
        # CONTAINS
    } else{
        # NOT CONTAINS
        echo "error! email invalid...";
        mysqli_close($connection);  
        exit();  
    }
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	$SQL = "SELECT * FROM sekolah WHERE email='$email';";
	$RES = mysqli_query($connection, $SQL);
	$ROW = mysqli_num_rows($RES);

	if ($ROW == 1) {
		$FET = mysqli_fetch_assoc($RES);
        if(password_verify($password, $FET['password'])) {
            // SESSION STORAGE
            $_SESSION['sekolah_id'] = $FET['id'];
            $_SESSION['sekolah_nama'] = $FET['nama'];
            $_SESSION['sekolah_alamat'] = $FET['alamat'];
            $_SESSION['sekolah_email'] = $FET['email'];
            $_SESSION['sekolah_password'] = $FET['password'];
            $_SESSION['sekolah_logo'] = $FET['logo'];

            header("Location: ../sekolah/home");
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
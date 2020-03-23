<?php
	session_start();
	require '../connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);
		$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);

		# SELECT AKUN
		$gSQL = "SELECT * FROM user_grup WHERE user_id='$userid' AND grup_id='$grupid';";
		$gRES = mysqli_query($connection, $gSQL);
		$gROW = mysqli_num_rows($gRES);

		if ($gROW == 1 ) {
			$result["success"] = "0";
		    $result["message"] = "Anda sudah bergabung!";
			echo json_encode($result);
			mysqli_close($connection);
			exit();
		} else {
			# WRITE TO 'user_grup' 
			$wSQL = "INSERT INTO user_grup (user_id, grup_id, status) VALUES ('$userid', '$grupid', 'ANGGOTA');";
			$wRES = mysqli_query($connection, $wSQL);
			if ($wRES) {
				$result["success"] = "1";
		        $result["message"] = "Anda telah bergabung!";
		        echo json_encode($result);
				mysqli_close($connection);
				exit();
			} else {
				$result["success"] = "0";
		        $result["message"] = "Error! DATABASE";
				echo json_encode($result);
				mysqli_close($connection);
				exit();
			}			
		}
	}



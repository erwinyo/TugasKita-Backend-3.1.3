<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);
		$usernama = mysqli_real_escape_string($connection, $_POST['usernama']);
		$newusernama = mysqli_real_escape_string($connection, $_POST['newusernama']);
		$newuseravatar = mysqli_real_escape_string($connection, $_POST['newuseravatar']);

		# CHECK IF USERNAMA DIFFERENT
		if ($usernama != $newusernama) {
			$chkUsernameSQL = "SELECT * FROM akun WHERE user_nama='$newusernama';";
	        $chkUsernameRES = mysqli_query($connection, $chkUsernameSQL);
	        $chkUsernameROW = mysqli_num_rows($chkUsernameRES);

	        if ($chkUsernameROW > 0) {
	        	$result["success"] = "0";
	            $result["message"] = "error! username sudah diambil!";
	            echo json_encode($result);
	            mysqli_close($connection);	
	            exit();
	        }
		}	

		if ($newuseravatar == "") {
			$SQL = "UPDATE akun SET user_nama='$newusernama' WHERE user_id='$userid';";
			$ind['upload'] = "0";
		} else {
			$SQL = "UPDATE akun SET user_nama='$newusernama', user_avatar='$newuseravatar' WHERE user_id='$userid';";
			$ind['upload'] = "1";
		}
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$ind['success'] = "1";
			$ind['message'] = "Successfulyy Updated!";
			echo json_encode($ind);
			mysqli_close($connection);
			exit();
		} else {
			$ind['success'] = "0";
			$ind['message'] = "Failed Updated!";
			echo json_encode($ind);
			mysqli_close($connection);
			exit();
		}
	}
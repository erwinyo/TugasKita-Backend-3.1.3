<?php
	session_start();
	require '../connection.php';

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);

		$SQL = "SELECT * FROM akun WHERE user_id='$userid';";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$FET = mysqli_fetch_assoc($RES);
			$avatar = $FET['user_avatar'];
			if ($avatar != "") {
				$ind['success'] = "1";
				$ind['message'] = "Successfully Retrived";
				mysqli_close($connection);
				echo json_encode($ind);
				exit();
			} else {
				$ind['success'] = "0";
				$ind['message'] = "Profile not setup yet";
				mysqli_close($connection);
				echo json_encode($ind);
				exit();
			}
		} else {
			$ind['success'] = "0";
			$ind['message'] = "Error SQL";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		}
	}
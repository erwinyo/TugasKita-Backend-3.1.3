<?php
	require '../connection.php';

	$userid = mysqli_real_escape_string($connection, $_POST['userid']);
	$token = mysqli_real_escape_string($connection, $_POST['token']);

	$SQL = "UPDATE akun SET user_fcm='$token' WHERE user_id='$userid';";
	$RES = mysqli_query($connection, $SQL);	
	if ($RES) {
		$ind['success'] = "1";
		$ind['message'] = "Success";
		mysqli_close($connection);
		echo json_encode($ind);
		exit();
	} else {
		$ind['success'] = "0";
		$ind['message'] = "Failed";
		mysqli_close($connection);
		echo json_encode($ind);
		exit();
	}
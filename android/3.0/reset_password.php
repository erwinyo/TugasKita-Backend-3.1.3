<?php
	session_start();
	require '../connection.php';

	$userid = mysqli_real_escape_string($connection, $_POST['userid']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	$hashed = password_hash($password, PASSWORD_DEFAULT);

	$SQL = "UPDATE akun SET user_password = '$hashed' WHERE user_id='$userid';";
	$RES = mysqli_query($connection, $SQL);
	if ($RES) {
		$ind['success'] = "1";
		$ind['message'] = "Successfully Change Password";
		mysqli_close($connection);
		echo json_encode($ind);
		exit();
	} else {
		$ind['success'] = "0";
		$ind['message'] = "Failed Change Password";
		mysqli_close($connection);
		echo json_encode($ind);
		exit();
	}
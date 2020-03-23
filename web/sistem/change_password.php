<?php
	require 'connection.php';

	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$newpassword = mysqli_real_escape_string($connection, $_POST['newpassword']);

	$newpasswordhashed = password_hash($newpassword, PASSWORD_DEFAULT);
	$SQL = "UPDATE akun SET user_password='$newpasswordhashed' WHERE user_email='$email';";
	$RES = mysqli_query($connection, $SQL);
	if ($RES) {
		echo "Success!";
		exit();
	} else {
		echo "Failed!";
		exit();
	}
<?php
	require 'connection.php';
	$userid = mysqli_real_escape_string($connection, $_GET['userid']);
	$grupid = mysqli_real_escape_string($connection, $_GET['grupid']);

	$SQL = "SELECT * FROM user_grup WHERE user_id='$userid' AND grup_id='$grupid';";
	$RES = mysqli_query($connection, $SQL);
	if ($RES) {
		$FET = mysqli_fetch_assoc($RES);
		$index['success'] = "1";
		$index['message'] = $FET['status'];
	} else {
		$index['success'] = "0";
		$index['message'] = "Error!";
	}
	echo json_encode($index);
	mysqli_close($connection);
	exit();
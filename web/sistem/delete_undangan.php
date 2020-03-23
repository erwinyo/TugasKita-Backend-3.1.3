<?php
	session_start();
	require 'connection.php';
	$fromid = mysqli_real_escape_string($connection, $_POST['fromid']);
	$toid = $_SESSION['user_id'];
	$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);

	$IG_SQL = "DELETE FROM invite_grup WHERE invite_to_grup='$grupid' AND invite_from='$fromid' AND invite_to='$toid';";
	$IG_RES = mysqli_query($connection, $IG_SQL);
	if ($IG_RES) {
		$outcome['success'] = "1";
		$outcome['message'] = "Successfully Deleted...";
		header("Location: load_undangan_masuk");
		mysqli_close($connection);
		exit();
	} else {
		$outcome['success'] = "0";
		$outcome['message'] = "Failed Deleted...";
		echo "Failed Deleted!";
		mysqli_close($connection);
		exit();
	}
	
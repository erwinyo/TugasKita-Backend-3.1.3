<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$fromid = mysqli_real_escape_string($connection, $_POST['fromid']);
		$toid = mysqli_real_escape_string($connection, $_POST['toid']);
		$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);

		$IG_SQL = "DELETE FROM invite_grup WHERE invite_to_grup='$grupid' AND invite_from='$fromid' AND invite_to='$toid';";
		$IG_RES = mysqli_query($connection, $IG_SQL);
		if ($IG_RES) {
			$outcome['success'] = "1";
			$outcome['message'] = "Successfully Deleted...";
			echo json_encode($outcome);
			mysqli_close($connection);
			exit();
		} else {
			$outcome['success'] = "0";
			$outcome['message'] = "Failed Deleted...";
			echo json_encode($outcome);
			mysqli_close($connection);
			exit();
		}
	}
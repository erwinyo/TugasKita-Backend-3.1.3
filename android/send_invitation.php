<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);
		$guestid = mysqli_real_escape_string($connection, $_POST['guestid']);
		$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);
		$as_status = mysqli_real_escape_string($connection, $_POST['as_status']);

		$SQL = "INSERT INTO invite_grup (invite_from, invite_to, invite_to_grup, as_status) VALUES ('$userid', '$guestid', '$grupid', '$as_status');";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$ind['success'] = "1";
			$ind['message'] = "Invitation Successfully Sended!";
			echo json_encode($ind);
			mysqli_close($connection);
			exit();
		} else {
			$ind['success'] = "0";
			$ind['message'] = "Invitation Failed Sended!";
			echo json_encode($ind);
			mysqli_close($connection);
			exit();
		}
	}
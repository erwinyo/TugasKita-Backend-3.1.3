<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$tugasid = mysqli_real_escape_string($connection, $_POST['tugasid']);

		$SQL = "DELETE FROM tugas WHERE tugas_id='$tugasid';";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$ind['success'] = "1";
			$ind['message'] = "Successfully Deleted!";
			header("Location: load_tugas");
			mysqli_close($connection);
			exit();
		} else {
			$ind['success'] = "0";
			$ind['message'] = "Failed Deleted!";
			echo json_encode($ind);
			mysqli_close($connection);
			exit();
		}
	}
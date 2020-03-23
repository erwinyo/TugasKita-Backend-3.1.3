<?php
	session_start();
	require '../connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);
		$day = mysqli_real_escape_string($connection, $_POST['day']);
		$data = mysqli_real_escape_string($connection, $_POST['data']);

		if ($day == "monday") {
			$SQL = "UPDATE grup_pelajaran SET pelajaran_monday='$data' WHERE pelajaran_grup='$grupid';";
		} else if ($day == "tuesday") {
			$SQL = "UPDATE grup_pelajaran SET pelajaran_tuesday='$data' WHERE pelajaran_grup='$grupid';";
		} else if ($day == "wednesday") {
			$SQL = "UPDATE grup_pelajaran SET pelajaran_wednesday='$data' WHERE pelajaran_grup='$grupid';";
		} else if ($day == "thursday") {
			$SQL = "UPDATE grup_pelajaran SET pelajaran_thursday='$data' WHERE pelajaran_grup='$grupid';";
		} else if ($day == "friday") {
			$SQL = "UPDATE grup_pelajaran SET pelajaran_friday='$data' WHERE pelajaran_grup='$grupid';";
		} else if ($day == "saturday") {
			$SQL = "UPDATE grup_pelajaran SET pelajaran_saturday='$data' WHERE pelajaran_grup='$grupid';";
		} else if ($day == "sunday") {
			$SQL = "UPDATE grup_pelajaran SET pelajaran_sunday='$data' WHERE pelajaran_grup='$grupid';";
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
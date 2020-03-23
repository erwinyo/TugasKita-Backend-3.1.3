<?php
	require '../connection.php';

	$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);

	$SQL = "SELECT * FROM grup_pelajaran WHERE pelajaran_grup='$grupid';";
	$RES = mysqli_query($connection, $SQL);
	if ($RES) {
		$FET = mysqli_fetch_assoc($RES);
		$ind['pelajaran_monday'] = $FET['pelajaran_monday'];
		$ind['pelajaran_tuesday'] = $FET['pelajaran_tuesday'];
		$ind['pelajaran_wednesday'] = $FET['pelajaran_wednesday'];
		$ind['pelajaran_thursday'] = $FET['pelajaran_thursday'];
		$ind['pelajaran_friday'] = $FET['pelajaran_friday'];
		$ind['pelajaran_saturday'] = $FET['pelajaran_saturday'];
		$ind['pelajaran_sunday'] = $FET['pelajaran_sunday'];

		$ind['success'] = "1";
		$ind['message'] = "Success Mata Pelajaran loaded!";
		mysqli_close($connection);
		echo json_encode($ind);
		exit();
	} else {
		$ind['success'] = "0";
		$ind['message'] = "Failed Mata Pelajaran loaded!";
		mysqli_close($connection);
		echo json_encode($ind);
		exit();
	}
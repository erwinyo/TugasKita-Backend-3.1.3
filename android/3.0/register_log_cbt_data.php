<?php
	require '../connection.php';
	$userid = mysqli_real_escape_string($connection, $_POST['userid']);
	$tanggal = mysqli_real_escape_string($connection, $_POST['tanggal']);
	$log = mysqli_real_escape_string($connection, $_POST['log']);
	$type = mysqli_real_escape_string($connection, $_POST['type']);

	$checkSQL = "SELECT * FROM log_cbt WHERE userid='$userid' AND tanggal='$tanggal';";
	$checkRES = mysqli_query($connection, $checkSQL);
	$checkROW = mysqli_num_rows($checkRES);
	if ($checkROW == 1) {
		// get last data
		$checkFET = mysqli_fetch_assoc($checkRES);
		$last_log = $checkFET['log'];

		if ($type == "live") {
			// under construction
			$new_log = $last_log.$log;
		} else if ($type == "write"){
			$new_log = $last_log.$log."#";
		}

		$SQL = "UPDATE log_cbt SET log='$new_log' WHERE userid='$userid' AND tanggal='$tanggal';";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$ind['success'] = "1";
			$ind['message'] = "successfully updated to database!";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		} else {
			$ind['success'] = "0";
			$ind['message'] = "something error while updating";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		}
	} else {
		$SQL = "INSERT INTO log_cbt (userid, tanggal, log) VALUES ('$userid', '$tanggal', '$log');";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$ind['success'] = "1";
			$ind['message'] = "successfully inserted to database!";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		} else {
			$ind['success'] = "0";
			$ind['message'] = "something error while inserting";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		}
	}

	
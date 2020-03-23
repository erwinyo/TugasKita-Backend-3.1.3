<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);
		$grupnama = mysqli_real_escape_string($connection, $_POST['grupnama']);
		$grupdeskripsi = mysqli_real_escape_string($connection, $_POST['grupdeskripsi']);
		# CREATE GROUP
		$RANDOMID = uniqid();
		$SQL = "INSERT INTO grup (grup_id, grup_nama, grup_cerita) VALUES ('$RANDOMID', '$grupnama', '$grupdeskripsi');";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			# CREATE NEW ROW FOR 'user_grup' DATABASE
			$nSQL = "INSERT INTO user_grup (user_id, grup_id, status) VALUES ('$userid','$RANDOMID', 'SUPER-ADMIN');";
			$nRES = mysqli_query($connection, $nSQL);
			if ($RES) {
				$mpSQL = "INSERT INTO grup_pelajaran(pelajaran_grup) VALUES('$RANDOMID');";
				mysqli_query($connection, $mpSQL);

				$result['success'] = "1";
				$result['message'] = "Successfully! Creating Group...";
				echo json_encode($result);
				mysqli_close($connection);
				exit();
			} else {
				$result['success'] = "0";
				$result['message'] = "Sorry! Error Creating 'user_grup' DATABASE!";
				echo json_encode($result);
				mysqli_close($connection);
				exit();
			}
		} else {
			$result['success'] = "0";
			$result['message'] = "Sorry! Error Creating 'grup' DATABASE!";
			echo json_encode($result);
			mysqli_close($connection);
			exit();
		}
	}
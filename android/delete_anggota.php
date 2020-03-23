<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userstatus = mysqli_real_escape_string($connection, $_POST['user_status']);
		$anggotaid = mysqli_real_escape_string($connection, $_POST['anggota_id']);
		$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);	

		if ($userstatus == "SUPER-ADMIN" || $userstatus == "ANGGOTA") {
			$SQL = "DELETE FROM user_grup WHERE user_id='$anggotaid' AND grup_id='$grupid';";
			$RES = mysqli_query($connection, $SQL);
			if ($RES) {
				$ind['success'] = "1";
				$ind['message'] = "Anggota terhapus!";
				echo json_encode($ind);
				mysqli_close($connection);
				exit();
			} else {
				$ind['success'] = "0";
				$ind['message'] = "SQL error!";
				echo json_encode($ind);
				mysqli_close($connection);
				exit();
			}	
		} else {
			$ind['success'] = "0";
			$ind['message'] = "ANGGOTA tidak bisa mengeluarkan!";
			echo json_encode($ind);
			mysqli_close($connection);
			exit();
		}
	}
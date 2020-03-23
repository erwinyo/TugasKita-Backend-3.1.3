<?php
	session_start();
	require 'connection.php';

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userstatus = mysqli_real_escape_string($connection, $_POST['userstatus']);
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);
		$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);

		if ($userstatus != "SUPER-ADMIN") {
			$SQL = "DELETE FROM user_grup WHERE user_id='$userid' AND grup_id='$grupid';";
				$RES = mysqli_query($connection, $SQL);
				if ($RES) {
					$ind['success'] = "1";
					$ind['message'] = "Anda berhasil dikeluarkan!";
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
			$ind['message'] = "SUPER-ADMIN tidak keluar dari GRUP!";
			echo json_encode($ind);
			mysqli_close($connection);
			exit();
		}
	}
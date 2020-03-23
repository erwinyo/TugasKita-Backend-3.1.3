<?php
	session_start();
	require '../connection.php';

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);
		$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);

		$SQL = "SELECT * FROM user_grup WHERE grup_id='$grupid';";
		$RES = mysqli_query($connection, $SQL);
		$list = array();
		$list['anggota'] = array();
		if ($RES) {
			while ($FET = mysqli_fetch_assoc($RES)) {
			// SHOW JUST ADMIN DAN ANGGOTA
				if ($userid != $FET['user_id']) {
					$ind['user_status'] = $FET['status'];
					$id = $FET['user_id'];
					$akunSQL = "SELECT * FROM akun WHERE user_id='$id';";
					$akunRES = mysqli_query($connection, $akunSQL);
					while ($akunFET = mysqli_fetch_assoc($akunRES)) {
						$ind['user_id'] = $akunFET['user_id'];
						$ind['user_namalengkap'] = $akunFET['user_namalengkap'];
						$ind['user_nama'] = $akunFET['user_nama'];
						$ind['user_cerita'] = $akunFET['user_cerita'];
						$ind['user_avatar'] = $akunFET['user_avatar'].".png";
						$ind['user_avatar_alternative'] = $akunFET['user_avatar_alternative'];
						array_push($list['anggota'], $ind);
					}
				} else {
					$list['user_status_in_grup'] = $FET['status'];
				}
			}
			$list['success'] = "1";
			$list['message'] = "Successfully Loaded!";
			echo json_encode($list);
			mysqli_close($connection);
			exit();
		} else {
			$list['success'] = "0";
			$list['message'] = "Error Occured!";
			echo json_encode($list);
			mysqli_close($connection);
			exit();
		}
	}
	
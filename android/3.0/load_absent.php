<?php
	session_start();
	require '../connection.php';
	date_default_timezone_set('Asia/Jakarta');
	$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];

	$formatedDate = str_pad($date, 2, "0", STR_PAD_LEFT);
	$formatedMonth = str_pad($month, 2, "0", STR_PAD_LEFT);
	$curDate = $formatedDate."-".$formatedMonth."-".$year;

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);

		$SQLanggota = "SELECT * FROM user_grup WHERE grup_id='$grupid';";
		$RESanggota = mysqli_query($connection, $SQLanggota);
		$ROWanggota = mysqli_num_rows($RESanggota);

		$list = array();
		$list['absent'] = array();

		if ($RESanggota) {
			while ($FETanggota = mysqli_fetch_assoc($RESanggota)) {
				$user_id_anggota = $FETanggota['user_id'];

				// select userid anggota in absent database
				$SQLabsent = "SELECT * FROM absent WHERE absent_grup='$grupid' AND absent_date='$curDate' AND absent_user='$user_id_anggota';";
				$RESabsent = mysqli_query($connection, $SQLabsent);
				$ROWabsent = mysqli_num_rows($RESabsent);

				if ($ROWabsent == 0) {
					// check if user has absented or not
					// just not absented user
					$SQLakun = "SELECT * FROM akun WHERE user_id='$user_id_anggota';";
					$RESakun = mysqli_query($connection, $SQLakun);
					$FETakun = mysqli_fetch_assoc($RESakun);

					$ind['user_id'] = $FETakun['user_id'];
					$ind['user_name'] = $FETakun['user_name'];
					$ind['user_namalengkap'] = $FETakun['user_namalengkap'];
					$ind['user_avatar'] = $FETakun['user_avatar'];
					$ind['user_avatar_alternative'] = $FETakun['user_avatar_alternative'];
					$ind['user_story'] = $FETakun['user_story'];
					array_push($list['absent'], $ind);
					
				}
			}
			if (count($list['absent']) == 0) {
				$list['success'] = "2";
				$list['message'] = "All absented for today";
				echo json_encode($list);
				mysqli_close($connection);
				exit();
			} else {
				$list['success'] = "1";
				$list['message'] = "Successfully Loaded!";
				echo json_encode($list);
				mysqli_close($connection);
				exit();
			}
		} else {
			$list['success'] = "0";
			$list['message'] = "Failed Loaded!";
			echo json_encode($list);
			mysqli_close($connection);
			exit();
		}
	}

	
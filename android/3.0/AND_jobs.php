<?php
	require '../connection.php';
	date_default_timezone_set('Asia/Jakarta');
	$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];

	$userid = mysqli_real_escape_string($connection, $_POST['userid']);
	$jobs = array();
	$jobs['data'] = array();

	// Check user_grup
	$UG_SQL = "SELECT * FROM user_grup WHERE user_id='$userid';";
	$UG_RES = mysqli_query($connection, $UG_SQL);
	if ($UG_RES) {
		$UG_ROW = mysqli_num_rows($UG_RES);
		if ($UG_ROW > 0) {
			while ($UG_FET = mysqli_fetch_assoc($UG_RES)) {
				$UG_grupid = $UG_FET['grup_id'];

				$SQL = "SELECT * FROM tugas WHERE tugas_posisi='$UG_grupid';";
				$RES = mysqli_query($connection, $SQL);
				if ($RES) {
					$dn = strtotime($date."-".$month."-".$year);
					while ($FET = mysqli_fetch_assoc($RES)) {
						$dt = strtotime($FET['tugas_waktu']);
						$dv = $dt - $dn;
						if ($dv < 0) {
							continue;
						} else {
							$dg = $dv / 86400;
							if ($dg == 1) {
								array_push($jobs['data'], $FET);
							}
						}
					}
					$jobs['success'] = "1";
					$jobs['message'] = "Success";
					mysqli_close($connection);
					echo json_encode($jobs);
					exit();
				} else {
					$ind['success'] = "0";
					$ind['message'] = "Failed";
					mysqli_close($connection);
					echo json_encode($ind);
					exit();
				}
			}
		}
	}

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

	$array = array();
	$array['groups'] = array();

	// Check user_grup
	$UG_SQL = "SELECT * FROM user_grup WHERE user_id='$userid';";
	$UG_RES = mysqli_query($connection, $UG_SQL);
	if ($UG_RES) {
		$UG_ROW = mysqli_num_rows($UG_RES);
		if ($UG_ROW > 0) {
			while ($UG_FET = mysqli_fetch_assoc($UG_RES)) {
				$UG_grupid = $UG_FET['grup_id'];
				$job_rows_in_group = 0;
				// Check tugas
				$TG_SQL = "SELECT * FROM tugas WHERE tugas_posisi='$UG_grupid';";
				$TG_RES = mysqli_query($connection, $TG_SQL);
				if ($TG_RES) {
					$TG_ROW = mysqli_num_rows($TG_RES);
					if ($TG_ROW > 0) {
						while ($TG_FET = mysqli_fetch_assoc($TG_RES)) {
							$dg = 0;
							$dt = strtotime($TG_FET['tugas_waktu']);
							$dn = strtotime($date."-".$month."-".$year);
							$dv = $dt - $dn;
							if ($dv < 0) {
								continue;
							} else {
								$dg = $dv / 86400;
								if ($dg >= 0) {
									$job_rows_in_group++;
								}
							}
						}
					} 
					// store just online job
					array_push($array['groups'], $UG_grupid."-".strval($job_rows_in_group));
				} else {
					$ind['success'] = "0";
					$ind['message'] = "failed tugas query";
					mysqli_close($connection);
					echo json_encode($ind);
					exit();
				}
			}
			// output
			$array['success'] = "1";
			$array['message'] = "successfully loaded";
			mysqli_close($connection);
			echo json_encode($array);
			exit();
		}
	} else {
		$ind['success'] = "0";
		$ind['message'] = "failed user_grup query";
		mysqli_close($connection);
		echo json_encode($ind);
		exit();
	}
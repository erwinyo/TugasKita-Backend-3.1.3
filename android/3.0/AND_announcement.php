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

	$SQL = "SELECT * FROM tugaskita";
	$RES = mysqli_query($connection, $SQL);

	$announcement = array();
	$announcement['data'] = array();

	if ($RES) {
		$announcement['success'] = "1";
		$announcement['message'] = "Successfully announcement";

		while ($FET = mysqli_fetch_assoc($RES)) {
			$dn = strtotime($date."-".$month."-".$year);		
			$dg_waktu = 0;
			$dt_waktu = strtotime($FET['waktu']);
			$dv_waktu = $dt_waktu - $dn;

			if ($dv_waktu < 0) {
				continue;
			} else {
				$dg_waktu = $dv_waktu / 86400;
				if ($dg_waktu >= 0) {
					if ($dt_waktu == $dn) {
						array_push($announcement["data"], $FET); // second - last index is data
					}
				}
			}

		}

		mysqli_close($connection);
		echo json_encode($announcement);
		exit();
	} else {
		$announcement['success'] = "0";
		$announcement['message'] = "Failed announcement";
		mysqli_close($connection);
		echo json_encode($announcement);
		exit();
	}
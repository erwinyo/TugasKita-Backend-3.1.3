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

	$SQL = "SELECT * FROM invite_grup WHERE invite_to='$userid';";
	$RES = mysqli_query($connection, $SQL);
	$invitation = array();
	$invitation['data'] = array();
	if ($RES) {
		$ROW = mysqli_num_rows($RES);
		if ($ROW > 0) {
			$invitation['success'] = "1";
			$invitation['message'] = "Successfully invitation";
			while ($FET = mysqli_fetch_assoc($RES)) {
				array_push($invitation["data"], $FET); // second - last index is data
			}
		} else {
			$invitation['success'] = "0";
			$invitation['message'] = "Nothing new";
		}
		mysqli_close($connection);
		echo json_encode($invitation);
		exit();
	} else {
		$invitation['success'] = "0";
		$invitation['message'] = "Failed invitation";
		mysqli_close($connection);
		echo json_encode($invitation);
		exit();
	}
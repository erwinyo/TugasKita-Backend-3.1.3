<?php
	require '../connection.php';

	$userid = mysqli_real_escape_string($connection, $_POST['userid']);

	$array = array();
	$array['coupon'] = array();

	$SQL = "SELECT * FROM user_coupon WHERE coupon_user='$userid';";
	$RES = mysqli_query($connection, $SQL);
	if ($RES) {
		while ($FET = mysqli_fetch_assoc($RES)) {
			// check if coupon active or not
			if ($FET['coupon_active'] == "1") {
				$ind['coupon_id'] = $FET['coupon_id'];
				$ind['coupon_point'] = $FET['coupon_point'];
				$ind['coupon_user'] = $FET['coupon_user'];
				$ind['coupon_date'] = $FET['coupon_date'];
				$ind['coupon_active'] = $FET['coupon_active'];
				array_push($array['coupon'], $ind);
			}
		}
		$array['success'] = "1";
		$array['message'] = "Query Success!";
		mysqli_close($connection);
		echo json_encode($array);
		exit();
	} else {
		$array['success'] = "0";
		$array['message'] = "Query Failed!";
		mysqli_close($connection);
		echo json_encode($array);
		exit();
	}
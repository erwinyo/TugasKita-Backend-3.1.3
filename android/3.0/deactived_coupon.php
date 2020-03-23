<?php
	require '../connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$couponid = mysqli_real_escape_string($connection, $_POST['couponid']);

		$SQL = "UPDATE user_coupon SET coupon_active='0' WHERE coupon_id='$couponid';";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$ind['success'] = "1";
			$ind['message'] = "Query Deactived Coupon Success";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		} else {
			$ind['success'] = "0";
			$ind['message'] = "Query Deactived Coupon Fail";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		}
	}
<?php
	require '../connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$couponid = mysqli_real_escape_string($connection, $_POST['couponid']);

		$SQL = "SELECT * FROM user_coupon WHERE coupon_id='$couponid';";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$ROW = mysqli_num_rows($RES);
			if ($ROW == 1) {
				$FET = mysqli_fetch_assoc($RES);
				$ind['coupon_id'] = $FET['coupon_id'];
				$ind['coupon_point'] = $FET['coupon_point'];
				$ind['coupon_user'] = $FET['coupon_user'];
				$ind['coupon_date'] = $FET['coupon_date'];
				$ind['coupon_active'] = $FET['coupon_active'];

				if ($ind['coupon_active'] == "0") {
					$ind['success'] = "002";
					$ind['message'] = "Coupon already used!";
					mysqli_close($connection);
					echo json_encode($ind);
					exit();
				} else {
					$ind['success'] = "1";
					$ind['message'] = "Loaded Coupon!";
					mysqli_close($connection);
					echo json_encode($ind);
					exit();
				}
			} else {
				$ind['success'] = "001";
				$ind['message'] = "No Coupon!";
				mysqli_close($connection);
				echo json_encode($ind);
				exit();
			}
		} else {
			$ind['success'] = "0";
			$ind['message'] = "Query Coupon fail!";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		}
	}

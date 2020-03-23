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
	$harga = intval(mysqli_real_escape_string($connection, $_POST['harga']));
	$point = mysqli_real_escape_string($connection, $_POST['point']);

	$SSQL = "SELECT * FROM akun WHERE user_id='$userid';";
	$SRES = mysqli_query($connection, $SSQL);
	$SFET = mysqli_fetch_assoc($SRES);

	$cur_user_point = intval($SFET['user_point']);
	$new_user_point = $cur_user_point - $harga;

	if (true) {
		$ind['success'] = "0";
		$ind['message'] = "Fitur ini dalam tahap pengembangan. Tidak bisa digunakan sekarang!";
		mysqli_close($connection);
		echo json_encode($ind);
		exit();
	}
	// check jika point mencukupi untuk pembelian
	else if ($new_user_point < 0) {
		$ind['success'] = "0";
		$ind['message'] = "Saldo tidak mencukupi!";
		mysqli_close($connection);
		echo json_encode($ind);
		exit();
	} else {
		// Update point akun
		$WSQL = "UPDATE akun SET user_point='$new_user_point' WHERE user_id='$userid';";
		$WRES = mysqli_query($connection, $WSQL);
		if ($WRES) {
			// insert new coupon
			$id = uniqid();
			$dateVal = $date."-".$month."-".$year;
			$SQL = "INSERT INTO user_coupon(coupon_id, coupon_point, coupon_user, coupon_date, coupon_active) VALUES ('$id', '$point', '$userid', '$dateVal', '1');";
			$RES = mysqli_query($connection, $SQL);
			
			$ind['success'] = "1";
			$ind['message'] = "Success!";
			$ind['new_userpoint'] = $new_user_point;
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		} else {
			$ind['success'] = "0";
			$ind['message'] = "Akun Update error!";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		}
	}
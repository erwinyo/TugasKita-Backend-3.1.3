<?php
	require '../connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);
		$point = intval(mysqli_real_escape_string($connection, $_POST['point']));

		$getSQL = "SELECT * FROM akun WHERE user_id='$userid';";
		$getRES = mysqli_query($connection, $getSQL);
		if ($getRES) {
			$getFET = mysqli_fetch_assoc($getRES);

			$last_points = intval($getFET['user_point']);

			$points = $last_points + $point;

			$writeSQL = "UPDATE akun SET user_point = '$points' WHERE user_id = '$userid';";
			$writeRES = mysqli_query($connection, $writeSQL);
			if ($writeRES) {
				$ind['success'] = "1";
				$ind['message'] = "Successfully Updated!";
				mysqli_close($connection);
				echo json_encode($ind);
				exit();
			} else {
				$ind['success'] = "0";
				$ind['message'] = "Write Query Fail";
				mysqli_close($connection);
				echo json_encode($ind);
				exit();
			}
		} else {
			$ind['success'] = "0";
			$ind['message'] = "Get Query Fail";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		}
	}
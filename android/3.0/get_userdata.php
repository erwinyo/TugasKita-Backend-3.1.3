<?php
	require '../connection.php';

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);

		$SQL = "SELECT * FROM akun WHERE user_id='$userid';";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$ROW = mysqli_fetch_assoc($RES);
			$ind['user_id'] = $ROW['user_id'];
			$ind['user_namalengkap'] = $ROW['user_namalengkap'];
			$ind['user_nama'] = $ROW['user_nama'];
			$ind['user_email'] = $ROW['user_email'];
			$ind['user_avatar'] = $ROW['user_avatar'];
			$ind['user_avatar_alternative'] = $ROW['user_avatar_alternative'];
			
			$ind['success'] = "1";
			$ind['message'] = "Successfully Retrieved";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		} else {
			$ind['success'] = "0";
			$ind['message'] = "Failed Retrieved";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		}
	}
		

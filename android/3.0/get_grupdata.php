<?php
	require '../connection.php';

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);

		$SQL = "SELECT * FROM grup WHERE grup_id='$grupid';";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$ROW = mysqli_fetch_assoc($RES);
			$ind['grup_id'] = $ROW['grup_id'];
			$ind['grup_nama'] = $ROW['grup_nama'];
			$ind['grup_cerita'] = $ROW['grup_cerita'];
			$ind['grup_avatar'] = $ROW['grup_avatar'];
			$ind['grup_total'] = $ROW['grup_total'];
			
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
		

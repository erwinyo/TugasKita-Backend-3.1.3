<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		# CONVERT 'username' to 'id'
		$vertSQL = "SELECT * FROM akun WHERE user_nama='$username';";
		$vertRES = mysqli_query($connection, $vertSQL);
		$vertFET = mysqli_fetch_assoc($vertRES);
		
		$id = $vertFET['user_id'];
		$SQL = "SELECT * FROM akun WHERE user_id='$id';";
		$RES = mysqli_query($connection, $SQL);
		$ROW = mysqli_num_rows($RES);
		if ($ROW == 1) {
			$FET = mysqli_fetch_assoc($RES);
			$result["id"] = $FET['user_id'];
	        $result["namalengkap"] = $FET['user_namalengkap'];
	        $result["username"] = $FET['user_nama'];
	        $result['avatar'] = $FET['user_avatar'].".png";
	        $result['avatar_alternative'] = $FET['user_avatar_alternative'];
	        $result["success"] = "1";
	        $result["message"] = "FOUNDED!";
	        echo json_encode($result);
	        mysqli_close($connection);
	        exit();
		} else {
			$result["success"] = "0";
	        $result["message"] = "not found";
	        echo json_encode($result);
	        mysqli_close($connection);
	        exit();
		}
	}
<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);
		$list = array();
		$list['listoffriends'] = array();

		# CHECK THE FIRST ROW
		$SQL1 = "SELECT * FROM user_teman WHERE user_id='$userid';";
		$RES1 = mysqli_query($connection, $SQL1);
		$ROW1 = mysqli_num_rows($RES1);
		if ($ROW1 > 0) {
			while ($r = mysqli_fetch_assoc($RES1)) {
				// GATHER INFOMARTION ABOUT FRIEND FROM akun DATABASE
				$id=$r['teman_id'];
				$tempSQL = "SELECT * FROM akun WHERE user_id='$id';";
				$tempRES = mysqli_query($connection, $tempSQL);
				while ($tempR = mysqli_fetch_assoc($tempRES)) {
					$ind['user_id'] = $tempR['user_id'];
					$ind['user_namalengkap'] = $tempR['user_namalengkap'];
					$ind['user_nama'] = $tempR['user_nama'];
					$ind['user_avatar'] = "https://res.cloudinary.com/dizwvnwu0/image/upload/c_thumb,h_500,w_500/v1525499092/tugaskita/profile/".$tempR['user_avatar'].".png";
					array_push($list['listoffriends'], $ind);
				}
			}
		} 
		# CHECK THE SECOND ROW
		$SQL2 = "SELECT * FROM user_teman WHERE teman_id='$userid';";
		$RES2 = mysqli_query($connection, $SQL2);
		$ROW2 = mysqli_num_rows($RES2);
		if ($ROW2 > 0) {
			while ($r = mysqli_fetch_assoc($RES2)) {
				// GATHER INFOMARTION ABOUT FRIEND FROM akun DATABASE
				$id=$r['user_id'];
				$tempSQL = "SELECT * FROM akun WHERE user_id='$id';";
				$tempRES = mysqli_query($connection, $tempSQL);
				while ($tempR = mysqli_fetch_assoc($tempRES)) {
					$ind['user_id'] = $tempR['user_id'];
					$ind['user_namalengkap'] = $tempR['user_namalengkap'];
					$ind['user_nama'] = $tempR['user_nama'];
					$ind['user_avatar'] = "https://res.cloudinary.com/dizwvnwu0/image/upload/c_thumb,h_500,w_500/v1525499092/tugaskita/profile/".$tempR['user_avatar'].".png";
					array_push($list['listoffriends'], $ind);
				}
			}
		} 
		if ($list['listoffriends'] == null) {
			$list['success'] = "0";
			$list['message'] = "You don't have any friend!";
		} else {
			$list['success'] = "1";
			$list['message'] = "Successfully loaded";
		}
		echo json_encode($list);
		mysqli_close($connection);
		exit();
	}
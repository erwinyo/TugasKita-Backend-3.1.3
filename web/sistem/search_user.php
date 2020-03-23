<?php
	session_start();
	require 'connection.php';
	$userid = $_SESSION['user_id'];

	$username = mysqli_real_escape_string($connection, $_POST['username']);
	# CONVERT 'username' to 'id'
	$vertSQL = "SELECT * FROM akun WHERE user_nama='$username';";
	$vertRES = mysqli_query($connection, $vertSQL);
	$vertFET = mysqli_fetch_assoc($vertRES);
	
	$id = $vertFET['user_id'];
	# CHECK IF USER SEARCH FOR HIMSELF
	if ($userid != $id) {
		$SQL = "SELECT * FROM akun WHERE user_id='$id';";
		$RES = mysqli_query($connection, $SQL);
		$ROW = mysqli_num_rows($RES);
		if ($ROW == 1) {
			$FET = mysqli_fetch_assoc($RES);
			$result["id"] = $FET['user_id'];
	        $result["namalengkap"] = $FET['user_namalengkap'];
	        $result["username"] = $FET['user_nama'];
	        $result["success"] = "1";
	        $result["message"] = "FOUNDED!";
	        $_SESSION['search_teman_val'] = json_encode($result);
		} else {
			$result["success"] = "0";
	        $result["message"] = "not found";
	        $_SESSION['search_teman_val'] = json_encode($result);
		}
	} else {
		$result["success"] = "0";
        $result["message"] = "You cannot register yourself";
        $_SESSION['search_teman_val'] = json_encode($result);
	}
	mysqli_close($connection);
    header("Location: load_teman");
    exit();
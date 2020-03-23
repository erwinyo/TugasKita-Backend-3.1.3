<?php
	session_start();
	require 'connection.php';
	$userid = $_SESSION['userid'];
	$temanusername = mysqli_real_escape_string($connection, $_POST['temanusername']);

	# CONVERT 'username' to 'id'
	$vertSQL = "SELECT * FROM akun WHERE user_nama='$temanusername';";
	$vertRES = mysqli_query($connection, $vertSQL);
	$vertFET = mysqli_fetch_assoc($vertRES);
	
	$temanid = $vertFET['user_id'];
	$result = array();	
	# CHECK DATABASE
	$alreadySQL1 = "SELECT * FROM user_teman WHERE user_id='$userid' AND teman_id='$temanid' AND status='TEMAN';";
	$alreadyRES1 = mysqli_query($connection, $alreadySQL1);
	$alreadyROW1 = mysqli_num_rows($alreadyRES1);
	#CHCK DATABASE
	$alreadySQL2 = "SELECT * FROM user_teman WHERE user_id='$temanid' AND teman_id='$userid' AND status='TEMAN';";
	$alreadyRES2 = mysqli_query($connection, $alreadySQL2);
	$alreadyROW2 = mysqli_num_rows($alreadyRES2);
	
	if ($alreadyROW1 == 0 && $alreadyROW2 == 0) {
			# WRITE TO 'user_teman' 
			$wSQL = "INSERT INTO user_teman (user_id, teman_id, status) VALUES ('$userid', '$temanid', 'TEMAN');";
			$wRES = mysqli_query($connection, $wSQL);
			if ($wRES) {
				$result["success"] = "1";
		        $result["message"] = "Sucessfuly Added!";
		        $_SESSION['search_teman_status'] = $result;
		        header("Location: ../dashboard");
				mysqli_close($connection);
				exit();
			} else {
				$result["success"] = "0";
		        $result["message"] = "Error! DATABASE";
		        $_SESSION['search_teman_status'] = $result;
		        header("Location: ../dashboard");
				mysqli_close($connection);
				exit();
			}
	} else {
		$result["success"] = "0";
	    $result["message"] = $temanusername.' Already Your Friend!';
		$_SESSION['search_teman_status'] = $result;
		header("Location: ../dashboard");
		mysqli_close($connection);
		exit();
	}	
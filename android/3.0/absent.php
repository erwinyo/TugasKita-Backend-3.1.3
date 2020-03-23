<?php
	require '../connection.php';

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);
		$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);
		$date = mysqli_real_escape_string($connection, $_POST['date']); // 01-10-2019
		$time = mysqli_real_escape_string($connection, $_POST['time']);
		$type = mysqli_real_escape_string($connection, $_POST['type']);
		
		$checkuserSQL = "SELECT * FROM user_grup WHERE user_id='$userid' AND grup_id='$grupid';";
		$checkuserRES = mysqli_query($connection, $checkuserSQL);
		$checkuserROW = mysqli_num_rows($checkuserRES);
		if ($checkuserROW > 0) {
			# Check sudah check in apa belum
			$checkSQL = "SELECT * FROM absent WHERE absent_user='$userid' AND absent_grup='$grupid';";
			$checkRES = mysqli_query($connection, $checkSQL);
			$checkROW = mysqli_num_rows($checkRES);

			// Check if already user used once
			if ($checkROW > 0) {
				$temp = array();
				while ($checkFET = mysqli_fetch_assoc($checkRES)) {
					array_push($temp, $checkFET);
				}

				$checkDATE = explode("-", $temp[count($temp)-1]["absent_date"]);
				$checkTIME = $temp[count($temp)-1]['absent_time'];

				$getDATE = explode("-", $date);

				if ($checkDATE[0] == $getDATE[0] && $checkDATE[1] == $getDATE[1] && $checkDATE[2] == $getDATE[2]) {
					$ind['success'] = "002";
					$ind['message'] = "Already Absented";
					mysqli_close($connection);
					echo json_encode($ind);
					exit();
				} else {
					# Write to DATABASE
					$writeSQL = "INSERT INTO absent(absent_user, absent_grup, absent_date, absent_time, absent_type) VALUES('$userid', '$grupid', '$date', '$time', '$type');";
					$writeRUN = mysqli_query($connection, $writeSQL);

					if ($writeRUN) {
						$ind['success'] = "1";
						$ind['message'] = "Successfully Absented";
						mysqli_close($connection);
						echo json_encode($ind);
						exit();
					} else {
						$ind['success'] = "001";
						$ind['message'] = "Query Error";
						mysqli_close($connection);
						echo json_encode($ind);
						exit();
					}
				}
			} else {
				# Write to DATABASE
				$writeSQL = "INSERT INTO absent(absent_user, absent_grup, absent_date, absent_time, absent_type) VALUES('$userid', '$grupid', '$date', '$time', '$type');";
				$writeRUN = mysqli_query($connection, $writeSQL);

				if ($writeRUN) {
					$ind['success'] = "1";
					$ind['message'] = "Successfully Absented";
					mysqli_close($connection);
					echo json_encode($ind);
					exit();
				} else {
					$ind['success'] = "001";
					$ind['message'] = "Query Error";
					mysqli_close($connection);
					echo json_encode($ind);
					exit();
				}
			}
		} else {
			$ind['success'] = "001";
			$ind['message'] = "You can't absent on this barcode!";
			mysqli_close($connection);
			echo json_encode($ind);
			exit();
		}
	}